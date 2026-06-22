import serial

SERIAL_PORT = "/dev/ttyUSB0"
BAUDRATE = 115200

try:
    arduino = serial.Serial(
        SERIAL_PORT,
        BAUDRATE,
        timeout=1
    )
except Exception as error:
    print("Arduino niet gevonden:", error)
    arduino = None


def send_data(
    overall_score,
    gates_open,
    flights,
    active_machines,
    average_time,
    target_score,
    availability,
    accuracy,
    completion,
    delay_rate,
    bottleneck
):
    if arduino is None:
        return

    data = (
        f"{overall_score},"
        f"{gates_open},"
        f"{flights},"
        f"{active_machines},"
        f"{average_time},"
        f"{target_score},"
        f"{availability},"
        f"{accuracy},"
        f"{completion},"
        f"{delay_rate},"
        f"{bottleneck}\n"
    )

    arduino.write(
        data.encode("utf-8")
    )