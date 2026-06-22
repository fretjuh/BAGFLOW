# ==========================================
# COIL ADDRESSES FOR MACHINES {41 t/m 80}
# INPUTS ADDRESSES FOR MACHINES {1 t/m 20}
# ==========================================
# Z [Zone Number] = Welke zone het betreft | Zoals: Z0 = Zone 0, Z1 = Zone 1, etc. |
# XX [Positie van de Machine] = Welke machine het betreft | TL = Top Left, TR = Top Right, BL = Bottom Left, BR = Bottom Right, etc. |
# PNP + [Nummer] = Uniek nummer voor elke Two Axis Pick and Place | Zoals: PPL1, PPL2, etc. |
# X = X-as beweging | Z = Z-as beweging | Grap = Grap item| RCW = Rotate Clockwise | D = Detectie | XM = X-as Moving | ZM = Z-as Moving | R = Reset | GripCW = Gripper Clockwise | RCCW = Rotate Counterclockwise | GripCCW = Gripper Counterclockwise | GripR = Gripper Rotate |
# ==========================================

# Zone 0 Top Left Two Axis Pick and Place 1
Z0_TL_PNP1_X = 41               # Actuator
Z0_TL_PNP1_Z = 42               # Actuator
Z0_TL_PNP1_Grab = 43            # Actuator
Z0_TL_PNP1_Rotate_CW = 44       # Actuator
Z0_TL_PNP1_Gripper_CW = 45      # Actuator
Z0_TL_PNP1_Rotate_CCW = 46      # Actuator
Z0_TL_PNP1_Gripper_CCW = 47     # Actuator

Z0_TL_PNP1_Detected = 1         # Sensor
Z0_TL_PNP1_X_Moving = 2         # Sensor
Z0_TL_PNP1_Z_Moving = 3        # Sensor
Z0_TL_PNP1_Rotate = 4          # Sensor
Z0_TL_PNP1_Gripper_Rotate = 5  # Sensor

# Zone 0 Top Right Two Axis Pick and Place 2
Z0_TR_PNP2_X = 48               # Actuator
Z0_TR_PNP2_Z = 49               # Actuator
Z0_TR_PNP2_Grab = 50            # Actuator
Z0_TR_PNP2_Rotate_CW = 51       # Actuator
Z0_TR_PNP2_Gripper_CW = 52      # Actuator
Z0_TR_PNP2_Rotate_CCW = 53      # Actuator
Z0_TR_PNP2_Gripper_CCW = 54     # Actuator

Z0_TR_PNP2_Detected = 6        # Sensor
Z0_TR_PNP2_X_Moving = 7        # Sensor
Z0_TR_PNP2_Z_Moving = 8        # Sensor
Z0_TR_PNP2_Rotate = 9          # Sensor
Z0_TR_PNP2_Gripper_Rotate = 10  # Sensor

# Zone 0 Left Bottem Two Axis Pick and Place 3
Z0_BL_PNP3_X = 55               # Actuator
Z0_BL_PNP3_Z = 56               # Actuator
Z0_BL_PNP3_Grab = 57            # Actuator
Z0_BL_PNP3_Rotate_CW = 58       # Actuator
Z0_BL_PNP3_Gripper_CW = 59      # Actuator
Z0_BL_PNP3_Rotate_CCW = 60      # Actuator
Z0_BL_PNP3_Gripper_CCW = 61     # Actuator

Z0_BL_PNP3_Detected = 11       # Sensor
Z0_BL_PNP3_X_Moving = 12        # Sensor
Z0_BL_PNP3_Z_Moving = 13        # Sensor
Z0_BL_PNP3_Rotate = 14          # Sensor
Z0_BL_PNP3_Gripper_Rotate = 15  # Sensor

# Zone 0 Bottom Right Two Axis Pick and Place 4
Z0_BR_PNP4_X = 62               # Actuator
Z0_BR_PNP4_Z = 63               # Actuator
Z0_BR_PNP4_Grab = 64            # Actuator
Z0_BR_PNP4_Rotate_CW = 65       # Actuator
Z0_BR_PNP4_Gripper_CW = 66      # Actuator
Z0_BR_PNP4_Rotate_CCW = 67      # Actuator
Z0_BR_PNP4_Gripper_CCW = 68     # Actuator

Z0_BR_PNP4_Detected = 16        # Sensor
Z0_BR_PNP4_X_Moving = 17        # Sensor
Z0_BR_PNP4_Z_Moving = 18        # Sensor
Z0_BR_PNP4_Rotate = 19          # Sensor
Z0_BR_PNP4_Gripper_Rotate = 20  # Sensor