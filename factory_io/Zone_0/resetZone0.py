import os
import sys
import time

_SCRIPT_DIR = os.path.dirname(__file__)
_PROJECT_ROOT = os.path.abspath(
    os.path.join(_SCRIPT_DIR, "..")
)

if _PROJECT_ROOT not in sys.path:
    sys.path.insert(0, _PROJECT_ROOT)

from connection import client

from Zone_0.inputValuesC import ALL_CONVEYORS
from Zone_0.inputValuesE import *
from Zone_0.inputValuesM import *
from Zone_0.inputValuesS import *

# ==================================================
# ALL OUTPUTS
# ==================================================

ALL_OUTPUTS = [

    # ----------------------
    # Conveyors
    # ----------------------

    *ALL_CONVEYORS,

    # ----------------------
    # Emitters
    # ----------------------

    Z0_TL_BAG_EM1,
    Z0_TR_BAG_EM1,
    Z0_BL_BAG_EM1,
    Z0_BR_BAG_EM1,

    Z0_TL_BOX_EM1,
    Z0_TR_BOX_EM1,
    Z0_BL_BOX_EM1,
    Z0_BR_BOX_EM1,

    # ----------------------
    # PNP1
    # ----------------------

    Z0_TL_PNP1_X,
    Z0_TL_PNP1_Z,
    Z0_TL_PNP1_Grab,
    Z0_TL_PNP1_Rotate_CW,
    Z0_TL_PNP1_Gripper_CW,
    Z0_TL_PNP1_Rotate_CCW,
    Z0_TL_PNP1_Gripper_CCW,

    # ----------------------
    # PNP2
    # ----------------------

    Z0_TR_PNP2_X,
    Z0_TR_PNP2_Z,
    Z0_TR_PNP2_Grab,
    Z0_TR_PNP2_Rotate_CW,
    Z0_TR_PNP2_Gripper_CW,
    Z0_TR_PNP2_Rotate_CCW,
    Z0_TR_PNP2_Gripper_CCW,

    # ----------------------
    # PNP3
    # ----------------------

    Z0_BL_PNP3_X,
    Z0_BL_PNP3_Z,
    Z0_BL_PNP3_Grab,
    Z0_BL_PNP3_Rotate_CW,
    Z0_BL_PNP3_Gripper_CW,
    Z0_BL_PNP3_Rotate_CCW,
    Z0_BL_PNP3_Gripper_CCW,

    # ----------------------
    # PNP4
    # ----------------------

    Z0_BR_PNP4_X,
    Z0_BR_PNP4_Z,
    Z0_BR_PNP4_Grab,
    Z0_BR_PNP4_Rotate_CW,
    Z0_BR_PNP4_Gripper_CW,
    Z0_BR_PNP4_Rotate_CCW,
    Z0_BR_PNP4_Gripper_CCW,

    # ----------------------
    # RFID Execute
    # ----------------------

    Z0_TL_RFID1_Execute_Command,
    Z0_TR_RFID2_Execute_Command,
    Z0_BL_RFID3_Execute_Command,
    Z0_BR_RFID4_Execute_Command,

    # ----------------------
    # Scales
    # ----------------------

    Z0_TL_SC1_Forward,
    Z0_TL_SC1_Backward,

    Z0_TR_SC2_Forward,
    Z0_TR_SC2_Backward,

    Z0_BL_SC3_Forward,
    Z0_BL_SC3_Backward,

    Z0_BR_SC4_Forward,
    Z0_BR_SC4_Backward,
]
# ==================================================
# RFID RESET CONFIG
# ==================================================

RFID_CONFIGS = [
    {
        "command": Z0_TL_RFID1_Command,
        "write_data": Z0_TL_RFID1_Write_Data,
        "memory_index": Z0_TL_RFID1_Memory_Index,
        "execute": Z0_TL_RFID1_Execute_Command,
    },
    {
        "command": Z0_TR_RFID2_Command,
        "write_data": Z0_TR_RFID2_Write_Data,
        "memory_index": Z0_TR_RFID2_Memory_Index,
        "execute": Z0_TR_RFID2_Execute_Command,
    },
    {
        "command": Z0_BL_RFID3_Command,
        "write_data": Z0_BL_RFID3_Write_Data,
        "memory_index": Z0_BL_RFID3_Memory_Index,
        "execute": Z0_BL_RFID3_Execute_Command,
    },
    {
        "command": Z0_BR_RFID4_Command,
        "write_data": Z0_BR_RFID4_Write_Data,
        "memory_index": Z0_BR_RFID4_Memory_Index,
        "execute": Z0_BR_RFID4_Execute_Command,
    },
]
# ==================================================
# RESET
# ==================================================

def reset_zone0():

    print("Resetting Zone 0...")

    for output in ALL_OUTPUTS:

        try:
            client.write_coil(
                output,
                False
            )

        except Exception as e:

            print(
                f"Failed {output}: {e}"
            )

    print("Zone 0 Reset Complete")

def reset_zone0():

    print("Resetting Zone 0...")

    # ----------------------
    # Reset Outputs
    # ----------------------

    for output in ALL_OUTPUTS:

        try:
            client.write_coil(
                output,
                False
            )

        except Exception as e:

            print(
                f"Failed {output}: {e}"
            )

    # ----------------------
    # Reset RFID Registers
    # ----------------------

    for rfid in RFID_CONFIGS:

        try:

            # Clear registers
            client.write_register(
                rfid["command"],
                0
            )

            client.write_register(
                rfid["write_data"],
                0
            )

            client.write_register(
                rfid["memory_index"],
                0
            )

            # Execute write
            client.write_coil(
                rfid["execute"],
                True
            )

            time.sleep(0.1)

            client.write_coil(
                rfid["execute"],
                False
            )

            print(
                f"RFID reset completed for execute coil {rfid['execute']}"
            )

        except Exception as e:

            print(
                f"RFID reset failed: {e}"
            )

    print("Zone 0 Reset Complete")
if __name__ == "__main__":

    reset_zone0()