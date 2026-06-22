import os
import sys
import time
import random
import logging
import requests

# ==================================================
# PATH SETUP
# ==================================================

_SCRIPT_DIR = os.path.dirname(__file__)
_PROJECT_ROOT = os.path.abspath(
    os.path.join(_SCRIPT_DIR, "..")
)

if _PROJECT_ROOT not in sys.path:
    sys.path.insert(0, _PROJECT_ROOT)

from connection import client

from Zone_1.inputValuesS import *
from Zone_1.inputValuesM import *

# ==================================================
# API
# ==================================================

API_URL = "http://127.0.0.1:8000/api/v1"

# ==================================================
# LOGGING
# ==================================================

LOG_FILE = os.path.join(
    _PROJECT_ROOT,
    "sorter.log"
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
# SORTERS
# ==================================================

SORTERS = {

    "LEFT": {

        "reader": RFID_READER_8_Read_Data,

        "plus": POPUP_WHEEL_SORTER_0_PLUS,
        "left": POPUP_WHEEL_SORTER_0_LEFT,
        "right": POPUP_WHEEL_SORTER_0_RIGHT,
    },

    "RIGHT": {

        "reader": RFID_READER_9_Read_Data,

        "plus": POPUP_WHEEL_SORTER_1_PLUS,
        "left": POPUP_WHEEL_SORTER_1_LEFT,
        "right": POPUP_WHEEL_SORTER_1_RIGHT,
    }
}

# ==================================================
# RFID
# ==================================================

def read_rfid(address):

    result = client.read_input_registers(
        address,
        count=1
    )

    if result.isError():
        return 0

    return result.registers[0]

def read_rfid(config):

    client.write_register(
        config["command"],
        1
    )

    client.write_register(
        config["memory_index"],
        0
    )

    client.write_coil(
        config["execute"],
        True
    )

    time.sleep(0.1)

    client.write_coil(
        config["execute"],
        False
    )

    time.sleep(0.1)

    result = client.read_input_registers(
        config["read_data"],
        count=1
    )

    if result.isError():
        return 0

    return result.registers[0]

# ==================================================
# DATABASE
# ==================================================

def update_status_by_rfid(
    rfid,
    status_id
):

    try:

        response = requests.patch(
            f"{API_URL}/bagage/rfid/{rfid}/status",
            json={
                "status_bagage_id": status_id
            },
            timeout=5
        )

        if response.status_code == 200:

            log(
                f"RFID {rfid} -> Status {status_id}"
            )

            return True

        log(
            f"Failed updating RFID {rfid}: {response.status_code}"
        )

        return False

    except Exception as e:

        log(
            f"Status update failed: {e}"
        )

        return False

# ==================================================
# DESTINATION
# ==================================================

def choose_destination():

    return random.choices(
        [
            (3, "OPGESLAGEN"),
            (4, "AFGELEVERD"),
            (5, "ZOEK")
        ],
        weights=[50, 40, 10],
        k=1
    )[0]

# ==================================================
# SORTER CONTROL
# ==================================================

def activate_sorter(config):

    direction = random.choice(
        [
            "LEFT",
            "STRAIGHT",
            "RIGHT"
        ]
    )

    log(
        f"Direction = {direction}"
    )

    # --------------------------
    # LEFT
    # --------------------------

    if direction == "LEFT":

        client.write_coil(
            config["plus"],
            True
        )

        client.write_coil(
            config["left"],
            True
        )

        time.sleep(1)

        client.write_coil(
            config["left"],
            False
        )

        client.write_coil(
            config["plus"],
            False
        )

    # --------------------------
    # RIGHT
    # --------------------------

    elif direction == "RIGHT":

        client.write_coil(
            config["plus"],
            True
        )

        client.write_coil(
            config["right"],
            True
        )

        time.sleep(1)

        client.write_coil(
            config["right"],
            False
        )

        client.write_coil(
            config["plus"],
            False
        )

    # --------------------------
    # STRAIGHT
    # --------------------------

    else:

        pass

# ==================================================
# MAIN
# ==================================================

def main():

    log(
        "Zone 1 Sorter Started"
    )

    last_seen = {
        "LEFT": None,
        "RIGHT": None
    }

    while True:

        for sorter_name, config in SORTERS.items():

            rfid = read_rfid(
                config["reader"]
            )

            log(
                f"{sorter_name} RFID Value = {rfid}"
            )

            if (
                rfid > 0
                and
                rfid != last_seen[sorter_name]
            ):

                log(
                    f"{sorter_name} detected RFID {rfid}"
                )

                status_id, status_name = (
                    choose_destination()
                )

                update_status_by_rfid(
                    rfid,
                    status_id
                )

                activate_sorter(
                    config
                )

                log(
                    f"RFID {rfid} -> {status_name}"
                )

                last_seen[sorter_name] = rfid

        time.sleep(0.1)

# ==================================================
# START
# ==================================================

if __name__ == "__main__":

    main()