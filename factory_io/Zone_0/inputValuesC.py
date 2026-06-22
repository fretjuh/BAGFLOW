# ==========================================
# COIL ADDRESSES FOR CONVEYORS {0 t/m 30}
# ==========================================
# Z [Zone Number] = Welke zone het betreft | Zoals: Z0 = Zone 0, Z1 = Zone 1, etc. |
# XX [Positie van de conveyor] = Welke conveyor het betreft | TL = Top Left, TR = Top Right, BL = Bottom Left, BR = Bottom Right, etc. |
# CV [Conveyor Number] = Uniek nummer voor elke conveyor | Zoals: CV1, CV2, etc. |
# CW = Clockwise | CCW = Counterclockwise | For corner conveyors, this indicates the direction of rotation |
# ==========================================

# Zone 0 Top Left Conveyor
Z0_TL_CV1 = 0
Z0_TL_CV2 = 1
Z0_TL_CV3 = 2
Z0_TL_CV4_CW = 3
Z0_TL_CV5 = 4
Z0_TL_CV6 = 5

# Zone 0 Bottom Left Conveyor
Z0_BL_CV1 = 6
Z0_BL_CV2 = 7
Z0_BL_CV3_CW = 8
Z0_BL_CV4 = 9

# Zone 0 Top Right Conveyor
Z0_TR_CV1 = 10
Z0_TR_CV2 = 11
Z0_TR_CV3 = 12
Z0_TR_CV4_CCW = 13
Z0_TR_CV5 = 14
Z0_TR_CV6 = 15
# Zone 0 Bottom Right Conveyor
Z0_BR_CV1 = 16
Z0_BR_CV2 = 17
Z0_BR_CV3_CCW = 18
Z0_BR_CV4 = 19


# Group the conveyors is easier to call them in the main program
ALL_CONVEYORS = [
    Z0_TL_CV1,
    Z0_TL_CV2,
    Z0_TL_CV3,
    Z0_TL_CV4_CW,
    Z0_TL_CV5,
    Z0_TL_CV6,

    Z0_BL_CV1,
    Z0_BL_CV2,
    Z0_BL_CV3_CW,
    Z0_BL_CV4,

    Z0_TR_CV1,
    Z0_TR_CV2,
    Z0_TR_CV3,
    Z0_TR_CV4_CCW,
    Z0_TR_CV5,
    Z0_TR_CV6,

    Z0_BR_CV1,
    Z0_BR_CV2,
    Z0_BR_CV3_CCW,
    Z0_BR_CV4,
]
