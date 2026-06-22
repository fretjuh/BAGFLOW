import os
import sys
import time
import requests
import logging
import threading
import random
import urllib3

urllib3.disable_warnings(
    urllib3.exceptions.InsecureRequestWarning
)
from datetime import datetime, timedelta
API_URL = "https://192.168.130.4/api/v1"

# API_URL = "http://127.0.0.1:8000/api/v1"

# Zorgt ervoor dat ook al zit je in een submap je nogsteeds de root connection kan aangroepen.
_SCRIPT_DIR = os.path.dirname(__file__)
_PROJECT_ROOT = os.path.abspath(os.path.join(_SCRIPT_DIR, ".."))

if _PROJECT_ROOT not in sys.path:
    sys.path.insert(0, _PROJECT_ROOT)

from connection import client
from Zone_0.inputValuesC import ALL_CONVEYORS
from Zone_0.resetZone0 import reset_zone0
from Zone_0.inputValuesM import *
from Zone_0.inputValuesS import *
from Zone_0.inputValuesE import *

# ==================================================
# LOGGING - Interaction with the system and API/database
# ==================================================

LOG_FILE = os.path.join(
    _PROJECT_ROOT,
    "bhs.log"
)

logging.basicConfig(
    filename=LOG_FILE,
    level=logging.INFO,
    format="%(asctime)s | %(levelname)s | %(message)s"
)

def log(message):
    print(message)
    logging.info(message)
    
# ==================================================
# WORKER THREADS
# ==================================================
running_gates = {}

rfid_counter = None

def initialize_rfid_counter():

    global rfid_counter

    try:

        response = requests.get(
            f"{API_URL}/bagage/latest-rfid",
            timeout=5,
            verify=False
        )

        if response.status_code == 200:

            data = response.json()

            rfid_counter = int(data["rfid"])

            log(
                f"RFID counter initialized at {rfid_counter}"
            )

        else:

            rfid_counter = 1000

            log(
                "Failed to retrieve latest RFID. Using 1000."
            )

    except Exception as e:

        rfid_counter = 1000

        log(
            f"RFID initialization failed: {e}"
        )
        
station_rfid = {
    "TL": None,
    "TR": None,
    "BL": None,
    "BR": None
}

station_container = {
    "TL": None,
    "TR": None,
    "BL": None,
    "BR": None
}

def station_worker(gate_id, config):

    log(
        f"Worker started for {config['name']}"
    )

    while running_gates.get(gate_id, False):

        process_station(
            gate_id,
            config,
            config["name"],
            config["scale_weight"],
            config["scale_forward"],
            config["bag_emitter"],
            config["box_emitter"],
            config["pnp_x"],
            config["pnp_z"],
            config["pnp_grab"]
        )

        time.sleep(0.1)
# ==================================================
# STATION STATES
# ==================================================

closing_gates = {}

def get_open_gates():

    try:

        response = requests.get(
            f"{API_URL}/gates",
            timeout=5,
            verify=False
        )

        if response.status_code != 200:

            log(
                f"API Error: {response.status_code}"
            )

            return []

        payload = response.json()

        gates = payload["data"]

        open_gate_ids = [
            gate["id"]
            for gate in gates
            if gate["is_open"] == 1
        ]

        # log(
        #     f"Open gates: {open_gate_ids}"
        # )

        return open_gate_ids

    except Exception as e:

        log(
            f"API Connection Error: {e}"
        )

        return []

station_has_box = {
    "TL": False,
    "TR": False,
    "BL": False,
    "BR": False
}

GATE_CONFIGS = {
    1: {
        "name": "TL",
        "conveyors": ALL_CONVEYORS[0:6],
        "scale_weight": Z0_TL_SC1_Weight,
        "scale_forward": Z0_TL_SC1_Forward,
        "bag_emitter": Z0_TL_BAG_EM1,
        "box_emitter": Z0_TL_BOX_EM1,
        "pnp_x": Z0_TL_PNP1_X,
        "pnp_z": Z0_TL_PNP1_Z,
        "pnp_grab": Z0_TL_PNP1_Grab,
        "pnp_detected": Z0_TL_PNP1_Detected,
        
        "rfid_command": Z0_TL_RFID1_Command,
        "rfid_write_data": Z0_TL_RFID1_Write_Data,
        "rfid_memory_index": Z0_TL_RFID1_Memory_Index,
        "rfid_execute_command": Z0_TL_RFID1_Execute_Command,
        
        "rfid_command_id": Z0_TL_RFID1_Command_ID,
        "rfid_status": Z0_TL_RFID1_Status,
        "rfid_read_data": Z0_TL_RFID1_Read_Data,
        
        "rrs": Z0_TL_RRS1,
    },
    2: {
        "name": "TR",
        "conveyors": ALL_CONVEYORS[10:16],
        "scale_weight": Z0_TR_SC2_Weight,
        "scale_forward": Z0_TR_SC2_Forward,
        "bag_emitter": Z0_TR_BAG_EM1,
        "box_emitter": Z0_TR_BOX_EM1,
        "pnp_x": Z0_TR_PNP2_X,
        "pnp_z": Z0_TR_PNP2_Z,
        "pnp_grab": Z0_TR_PNP2_Grab,
        "pnp_detected": Z0_TR_PNP2_Detected,
        
        "rfid_command": Z0_TR_RFID2_Command,
        "rfid_write_data": Z0_TR_RFID2_Write_Data,
        "rfid_memory_index": Z0_TR_RFID2_Memory_Index,
        
        "rfid_execute_command": Z0_TR_RFID2_Execute_Command,
        "rfid_command_id": Z0_TR_RFID2_Command_ID,
        "rfid_status": Z0_TR_RFID2_Status,
        "rfid_read_data": Z0_TR_RFID2_Read_Data,
        
        "rrs": Z0_TR_RRS2,
    },
    3: {
        "name": "BL",
        "conveyors": ALL_CONVEYORS[6:10],
        "scale_weight": Z0_BL_SC3_Weight,
        "scale_forward": Z0_BL_SC3_Forward,
        "bag_emitter": Z0_BL_BAG_EM1,
        "box_emitter": Z0_BL_BOX_EM1,
        "pnp_x": Z0_BL_PNP3_X,
        "pnp_z": Z0_BL_PNP3_Z,
        "pnp_grab": Z0_BL_PNP3_Grab,
        "pnp_detected": Z0_BL_PNP3_Detected,
        "rfid_command": Z0_BL_RFID3_Command,
        
        "rfid_write_data": Z0_BL_RFID3_Write_Data,
        "rfid_memory_index": Z0_BL_RFID3_Memory_Index,
        "rfid_execute_command": Z0_BL_RFID3_Execute_Command,
        
        "rfid_command_id": Z0_BL_RFID3_Command_ID,
        "rfid_status": Z0_BL_RFID3_Status,
        "rfid_read_data": Z0_BL_RFID3_Read_Data,
        
        "rrs": Z0_BL_RRS3,
    },
    4: {
        "name": "BR",
        "conveyors": ALL_CONVEYORS[16:20],
        "scale_weight": Z0_BR_SC4_Weight,
        "scale_forward": Z0_BR_SC4_Forward,
        "bag_emitter": Z0_BR_BAG_EM1,
        "box_emitter": Z0_BR_BOX_EM1,
        "pnp_x": Z0_BR_PNP4_X,
        "pnp_z": Z0_BR_PNP4_Z,
        "pnp_grab": Z0_BR_PNP4_Grab,
        "pnp_detected": Z0_BR_PNP4_Detected,
        "rfid_command": Z0_BR_RFID4_Command,
        
        "rfid_write_data": Z0_BR_RFID4_Write_Data,
        "rfid_memory_index": Z0_BR_RFID4_Memory_Index,
        "rfid_execute_command": Z0_BR_RFID4_Execute_Command,
        
        "rfid_command_id": Z0_BR_RFID4_Command_ID,
        "rfid_status": Z0_BR_RFID4_Status,
        "rfid_read_data": Z0_BR_RFID4_Read_Data,
        
        "rrs": Z0_BR_RRS4,
    },
}


# ==================================================
# Conveyor Functions
# ==================================================


def start_conveyors(conveyors):

    for coil in conveyors:
        client.write_coil(coil, True)

    log(
    f"Started conveyors: {conveyors}"
)

def stop_conveyors(conveyors):

    for coil in conveyors:
        client.write_coil(coil, False)

    log(
    f"Stopped conveyors: {conveyors}"
)

def prompt_gate_selection():

    while True:

        choice = input(
            "Select open gate (1=TL, 2=TR, 3=BL, 4=BR): "
        ).strip()

        if choice.isdigit() and int(choice) in GATE_CONFIGS:
            return int(choice)

        print(
            "Invalid gate. Please choose 1, 2, 3, or 4."
        )



#===================================================
#Test 
#===================================================

def update_machine_status(machine_id, status):
    try:
        response = requests.patch(
            f"{API_URL}/machines/{machine_id}/status",
            json={"status_id": status},
            timeout=5,
            verify=False
        )

        print("PATCH STATUS:", response.status_code)
        print("PATCH BODY:", response.text)

    except Exception as e:
        log(f"Status update failed: {e}")
# ==================================================
# SetUp Functions
# ==================================================

def pulse_coil(address, duration=0.25):
    client.write_coil(address, True)
    time.sleep(duration)
    client.write_coil(address, False)


def read_input(address):

    result = client.read_discrete_inputs(address, count=1)

    if result.isError():
        return False

    return result.bits[0]


def read_weight(address):

    result = client.read_input_registers(address, count=1)

    if result.isError():
        return 0

    return result.registers[0]


def spawn_box(emitter):

    pulse_coil(emitter)

    log(
        f"Spawned box on emitter {emitter}"
    )


def spawn_bag(emitter):

    pulse_coil(emitter)

    log(
        f"Spawned bag on emitter {emitter}"
    )

def create_bagage(rfid, omschrijving):

    random_status = random.randint(1, 5)

    inlevertijd = datetime.now()

    payload = {
        "rfid": str(rfid),
        "omschrijving": omschrijving,
        "status_bagage_id": random_status,
        "inlevertijd": inlevertijd.strftime(
            "%Y-%m-%d %H:%M:%S"
        )
    }

    # Alleen status 4 krijgt een aflevertijd
    if random_status == 4:

        aflevertijd = (
            inlevertijd +
            timedelta(
                minutes=random.randint(90, 120)
            )
        )

        payload["aflevertijd"] = aflevertijd.strftime(
            "%Y-%m-%d %H:%M:%S"
        )

    log(
        f"Creating RFID {rfid} with status {random_status}"
    )

    response = requests.post(
        f"{API_URL}/bagage",
        json=payload,
        timeout=5,
        verify=False
    )

    print("STATUS:", response.status_code)
    print("BODY:", response.text)

    return response.json()
def update_bagage_status(
    bagage_id,
    status_id
):

    try:

        requests.patch(
            f"{API_URL}/bagage/{bagage_id}/status",
            json={
                "status_bagage_id": status_id
            },
            timeout=5,
            verify=False
        )

        log(
            f"Bagage {bagage_id} -> Status {status_id}"
        )

    except Exception as e:

        log(
            f"Status update failed: {e}"
        )

# ==================================================
# Pick & Place
# ==================================================

def pnp_cycle(x, z, grab):
    # Down
    try:
        print("PNP -> DOWN (z)")
        client.write_coil(z, True)
    except Exception as e:
        print(f"Error writing z down: {e}")
    time.sleep(1)

    # Grab
    try:
        print("PNP -> GRAB (grab)")
        client.write_coil(grab, True)
    except Exception as e:
        print(f"Error writing grab: {e}")
    time.sleep(0.5)

    # Up
    try:
        print("PNP -> UP (z off)")
        client.write_coil(z, False)
    except Exception as e:
        print(f"Error writing z up: {e}")
    time.sleep(1)

    # Forward
    try:
        print("PNP -> FORWARD (x)")
        client.write_coil(x, True)
    except Exception as e:
        print(f"Error writing x forward: {e}")
    time.sleep(1.5)

    # Down
    try:
        print("PNP -> DOWN (z)")
        client.write_coil(z, True)
    except Exception as e:
        print(f"Error writing z down 2: {e}")
    time.sleep(1.5)

    # Release
    try:
        print("PNP -> RELEASE (grab off)")
        client.write_coil(grab, False)
    except Exception as e:
        print(f"Error releasing grab: {e}")
    time.sleep(0.5)

    # Up
    try:
        print("PNP -> UP (z off)")
        client.write_coil(z, False)
    except Exception as e:
        print(f"Error writing z up 2: {e}")
    time.sleep(1)

    # Back To Origin
    try:
        print("PNP -> ORIGIN (x off)")
        client.write_coil(x, False)
    except Exception as e:
        print(f"Error writing x origin: {e}")
    time.sleep(1)
# ==================================================
# RFID Logic
# ==================================================

def rfid_execute(config):

    pulse_coil(
        config["rfid_execute_command"],
        0.1
    )
def read_rrs(address):

    result = client.read_input_registers(
        address,
        count=1
    )

    if result.isError():
        return False

    return result.registers[0] > 0
  
def read_rfid(config):

    result = client.read_input_registers(
        config["rfid_read_data"],
        count=1
    )

    if result.isError():
        return None

    return result.registers[0]

def generate_rfid():

    global rfid_counter

    rfid_counter += 1

    return rfid_counter


def write_rfid(
    config,
    value
):

    client.write_register(
        config["rfid_command"],
        2
    )

    client.write_register(
        config["rfid_write_data"],
        value
    )

    client.write_register(
        config["rfid_memory_index"],
        0
    )

    rfid_execute(config)
    
    
# ==================================================
# Station Logic
# ==================================================
def machine_self_test(config):

    log(
        f"{config['name']} -> Starting self test"
    )

    try:

        pnp_cycle(
            config["pnp_x"],
            config["pnp_z"],
            config["pnp_grab"]
        )

        log(
            f"{config['name']} -> Self test passed"
        )

        return True

    except Exception as e:

        log(
            f"{config['name']} -> Self test failed: {e}"
        )

        return False

def process_station(
    gate_id,
    config,
    station_name,

    scale_weight,
    scale_forward,

    bag_emitter,
    box_emitter,

    pnp_x,
    pnp_z,
    pnp_grab,
):

    weight = read_weight(
        scale_weight
    )

    # ----------------------------------------
    # Spawn new box when empty
    # ----------------------------------------
    
    if station_container[station_name]:
        if read_rrs(config["rrs"]):

            container = station_container[station_name]

            update_bagage_status(
                container["id"],
                2
            )

            log(
                f"{station_name} container entered sorting system"
            )

            station_container[station_name] = None
            station_rfid[station_name] = None
            station_has_box[station_name] = False
        
    if (
        weight == 0
        and
        not station_has_box[station_name]
        and
        gate_id not in closing_gates
    ):

        print(
            f"{station_name}: "
            f"Spawning new box"
        )

        spawn_box(
            box_emitter
        )

        rfid = generate_rfid()

        station_rfid[station_name] = rfid

        write_rfid(
            config,
            rfid
        )
        BAGAGE_OMSCHRIJVINGEN = [
            "Grijze sporttas",
            "Kinderkoffer met stickers",
            "Rode reiskoffer",
            "Bruine lederen tas",
            "Blauwe handbagage",
            "Zilveren trolley",
            "Gele handbagage",
            "Zwarte Samsonite koffer",
            "Groene rugzak",
            "Zwarte weekendtas"
        ]
        omschrijving = random.choice(
            BAGAGE_OMSCHRIJVINGEN
        )

        response = create_bagage(
            rfid,
            omschrijving
        )

        if not response or not response.get("success"):

            log(
                f"{station_name} failed to create baggage"
            )

            return

        bagage_id = response["data"]["id"]
        
        station_container[station_name] = {
            "id": bagage_id,
            "rfid": rfid
        }

        log(
            f"{station_name} RFID created: {rfid}"
        )

        station_has_box[
            station_name
        ] = True

        time.sleep(2)

        return
        

# ----------------------------------------
# Fill box
# ----------------------------------------

    if gate_id in closing_gates:
        return

    TARGET_WEIGHT = 1000
    
    if station_has_box[
        station_name
    ]:

        weight = read_weight(
            scale_weight
        )

        print(
            f"{station_name}: "
            f"Current Weight = {weight}"
        )
        
        if weight < TARGET_WEIGHT:

            spawn_bag(
                bag_emitter
            )

            pnp_cycle(
                pnp_x,
                pnp_z,
                pnp_grab
            )

        else:

            print(
                f"{station_name}: "
                f"Weight reached {TARGET_WEIGHT}"
            )

            client.write_coil(
                scale_forward,
                True
            )

            time.sleep(1)

            client.write_coil(
                scale_forward,
                False
            )

            station_has_box[
                station_name
            ] = False

# ==================================================
# MAIN
# ==================================================

if __name__ == "__main__":

    log("Starting Zone 0")
    
    initialize_rfid_counter()

    print(f"RFID START = {rfid_counter}")

    reset_zone0()

    active_gates = {}

    while True:

        open_gates = get_open_gates()

        log(f"Processing gates: {open_gates}")
        # =================================
        # Activate newly opened gates
        # =================================

        for gate_id in open_gates:

            log(f"Checking gate {gate_id}")

            if gate_id not in GATE_CONFIGS:
                log(f"Gate {gate_id} not found in config")
                continue

            log(f"Gate {gate_id} found in config")

            if gate_id not in active_gates:

                log(f"Gate {gate_id} not active yet")

                config = GATE_CONFIGS[gate_id]

                passed = machine_self_test(config)

                log(f"Self test returned: {passed}")

                if passed:

                    update_machine_status(gate_id, 1)  # actief
                    
                    running_gates[gate_id] = True

                    start_conveyors(
                        config["conveyors"]
                    )

                    thread = threading.Thread(
                        target=station_worker,
                        args=(gate_id, config),
                        daemon=True
                    )

                    thread.start()

                    active_gates[
                        gate_id
                    ] = {
                        "config": config,
                        "thread": thread
                    }

                    log(
                        f"{config['name']} activated"
                    )
                else:

                    update_machine_status(gate_id, 4)
        # =================================
        # Deactivate closed gates
        # =================================
        
        closed = []

        for gate_id, station in list(active_gates.items()):

            config = station["config"]

            if gate_id not in open_gates and gate_id not in closing_gates:

                closing_gates[gate_id] = time.time()

                log(
                    f"{config['name']} entering drain mode"
                )

            if gate_id in closing_gates:

                elapsed = (
                    time.time()
                    - closing_gates[gate_id]
                )

                if elapsed >= 60:
                    
                    running_gates[gate_id] = False

                    station["thread"].join(timeout=2)

                    stop_conveyors(
                        config["conveyors"]
                    )
                    
                    update_machine_status(gate_id, 2)  # inactief

                    closed.append(gate_id)

                    log(
                        f"{config['name']} shutdown complete"
                    )

        for gate_id in closed:

            del active_gates[gate_id]

            if gate_id in running_gates:
                del running_gates[gate_id]

            if gate_id in closing_gates:
                del closing_gates[gate_id]
