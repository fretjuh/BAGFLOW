from datetime import datetime

def write_log(file_name, message):

    timestamp = datetime.now()

    with open(file_name, "a") as file:

        file.write(
            f"{timestamp} - {message}\n"
        )