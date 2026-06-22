from pymodbus.client import ModbusTcpClient
import requests
import time

# ==========================================
# CONNECTION
# ==========================================

client = ModbusTcpClient('192.168.0.199', port=502)

if not client.connect():
    print("Failed to connect to the of site Bagage Handling System")
    exit()

print("Connected to of site Bagage Handling System")

# ==========================================
# API CONNECTION
# ==========================================

API_URL = "https://192.168.130.4/api/v1"

# API_URL = "http://127.0.0.1:8000/api/v1"

try:

    response = requests.get(
        f"{API_URL}/gates",
        timeout=5,
        verify=False
    )

    if response.status_code == 200:

        print(
            "[OK] Connected to "
            "Laravel API"
        )

    else:

        print(
            f"[ERROR] API returned "
            f"{response.status_code}"
        )

        exit()

except requests.exceptions.ConnectionError as e:
    print(f"[ERROR] Connection Error: {e}")

    print(
        "[ERROR] Could not connect "
        "to Laravel API"
    )

    exit()

except Exception as e:
    import traceback
    traceback.print_exc()

    print(
        f"[ERROR] API Error: {e}"
    )

    exit()
    
# # ==========================================
# # Gates Randomizer - Om de 5 minuten worden de gates geüpdatet in de database.
# # ==========================================
UPDATE_URL = "https://192.168.130.4/api/v1/gates/{id}"

while True:
    try:
        # Alle gates ophalen
        response = requests.get(f"{API_URL}/gates",
        verify=False)
        response.raise_for_status()

        gates = response.json()["data"]

        for gate in gates:
            gate_id = gate["id"]
            gate_name = gate["naam"]

            current_state = int(gate["is_open"])
            new_state = 0 if current_state == 1 else 1

            update_response = requests.put(
                f"{API_URL}/gates/{gate_id}",
                json={
                    "is_open": new_state
                },
                verify=False
            )

            update_response.raise_for_status()

            print(
                f"[OK] Gate {gate_name} ({gate_id}) "
                f"gewijzigd van {current_state} naar {new_state}"
            )

        print("Wachten 5 minuten...\n")
        time.sleep(300)

    except Exception as e:
        print(f"Fout: {e}")
        time.sleep(60)
    exit()