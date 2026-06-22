# ==========================================
# COIL ADDRESSES FOR SENSORS AND ACTUATORS {70 t/m 125}
# INPUTS ADDRESSES FOR SENSORS {21 t/m 50}
# ==========================================
# Z [Zone Number] = Welke zone het betreft | Zoals: Z0 = Zone 0, Z1 = Zone 1, etc. |
# XX [Positie van de sensor/actuator] = Welke sensor/actuator het betreft | TL = Top Left, TR = Top Right, BL = Bottom Left, BR = Bottom Right, etc. |
# N [Nummer] = Uniek nummer voor elke sensor/actuator | Zoals: N1, N2, etc. |
# ==========================================

#=========================
# RFID Sensors and Actuators
#=========================
# Zone 0 Top Left RFID 1
Z0_TL_RFID1_Command = 1             # Actuator  | Holding Reg
Z0_TL_RFID1_Write_Data = 2          # Actuator  | Holding Reg
Z0_TL_RFID1_Memory_Index = 3        # Actuator  | Holding Reg
Z0_TL_RFID1_Execute_Command = 70    # Actuator  | Coil

Z0_TL_RFID1_Command_ID = 0          # Actuator  | Input Reg
Z0_TL_RFID1_Status = 1              # Sensor    | Input Reg
Z0_TL_RFID1_Read_Data = 2           # Sensor    | Input Reg

# Zone 0 Top Right RFID 2
Z0_TR_RFID2_Command = 4             # Actuator | Holding Reg
Z0_TR_RFID2_Write_Data = 5          # Actuator | Holding Reg
Z0_TR_RFID2_Memory_Index = 6        # Actuator | Holding Reg
Z0_TR_RFID2_Execute_Command = 71     # Actuator | Coil

Z0_TR_RFID2_Command_ID = 3          # Actuator  | Input Reg
Z0_TR_RFID2_Status = 4              # Sensor    | Input Reg
Z0_TR_RFID2_Read_Data = 5           # Sensor    | Input Reg

# Zone 0 Bottom Left RFID 3
Z0_BL_RFID3_Command = 7             # Actuator  | Input Reg
Z0_BL_RFID3_Write_Data = 8          # Actuator | Holding Reg
Z0_BL_RFID3_Memory_Index = 9        # Actuator | Holding Reg
Z0_BL_RFID3_Execute_Command = 72     # Actuator | Coil

Z0_BL_RFID3_Command_ID = 6          # Actuator | Input Reg
Z0_BL_RFID3_Status = 7              # Sensor   | Input Reg
Z0_BL_RFID3_Read_Data = 8          # Sensor    | Input Reg

# Zone 0 Bottom Right RFID 4
Z0_BR_RFID4_Command = 10             # Actuator | Holding Reg
Z0_BR_RFID4_Write_Data = 11          # Actuator | Holding Reg
Z0_BR_RFID4_Memory_Index = 12        # Actuator | Holding Reg
Z0_BR_RFID4_Execute_Command = 73     # Actuator | Coil

Z0_BR_RFID4_Command_ID = 9          # Actuator | Input Reg
Z0_BR_RFID4_Status = 10              # Sensor   | Input Reg
Z0_BR_RFID4_Read_Data = 11           # Sensor   | Input Reg

#=========================
# Retroreflective Sensors and Actuators
#=========================
# Zone 0 Top Left Retroreflective Sensor 1
Z0_TL_RRS1 = 13            # Sensor   | Input Reg

# Zone 0 Top Right Retroreflective Sensor 2
Z0_TR_RRS2 = 14             # Sensor   | Input Reg

# Zone 0 Bottom Left Retroreflective Sensor 3
Z0_BL_RRS3 = 15             # Sensor   | Input Reg

# Zone 0 Bottom Right Retroreflective Sensor 4
Z0_BR_RRS4 = 16             # Sensor   | Input Reg

#==========================
# Weighing Scales and Actuators
#==========================
# Zone 0 Top Left Weighing Scale 1
Z0_TL_SC1_Forward = 75          # Actuator
Z0_TL_SC1_Backward = 76         # Actuator

Z0_TL_SC1_Weight = 18           # Sensor

# Zone 0 Top Right Weighing Scale 2
Z0_TR_SC2_Forward = 77          # Actuator
Z0_TR_SC2_Backward = 78         # Actuator

Z0_TR_SC2_Weight = 19           # Sensor

# Zone 0 Bottom Left Weighing Scale 3
Z0_BL_SC3_Forward = 79          # Actuator
Z0_BL_SC3_Backward = 80         # Actuator

Z0_BL_SC3_Weight = 20          # Sensor

# Zone 0 Bottom Right Weighing Scale 4
Z0_BR_SC4_Forward = 81          # Actuator
Z0_BR_SC4_Backward = 82         # Actuator

Z0_BR_SC4_Weight = 21          # Sensor