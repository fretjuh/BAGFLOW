import time

from serial_sender import send_data

from api_client import (
    get_gates, 
    get_machines,
    get_baggage,
    get_flight_schedules
)

from logger import write_log

from validation import validate_system

from database import (
    create_database,
    add_event
)

from kpi import *

from performance import *

from times import *

from target import *

from config import (
    UPDATE_INTERVAL,
    ERROR_LOG_FILE,
    VALIDATION_LOG_FILE,

    ACTIVE_STATUS,
    INACTIVE_STATUS,
    MAINTENANCE_STATUS,
    ERROR_STATUS,

    BAG_UNDERWAY_STATUS,
    BAG_DELIVERED_STATUS,
    BAG_STORED_STATUS,
    BAG_LOST_STATUS,

    TARGET_PROCESSING_TIME
)

create_database()

while True:

    try:

        gate_data = get_gates()
        machine_data = get_machines()
        baggage_data = get_baggage()
        flight_data = get_flight_schedules()

        add_event(
            "API",
            f"Gates:{len(gate_data['data'])} "
            f"Machines:{len(machine_data['data'])} "
            f"Baggage:{len(baggage_data['data'])} "
            f"Flights:{len(flight_data['data'])}"
        )

        #
        # GATES
        #

        open_gates = 0
        closed_gates = 0

        for gate in gate_data["data"]:

            if gate["is_open"] == 1:
                open_gates += 1

            else:
                closed_gates += 1

        total_gates = open_gates + closed_gates

        #
        # MACHINES
        #

        active = 0
        inactive = 0
        maintenance = 0
        errors = 0

        for machine in machine_data["data"]:

            status = machine["status"]["naam"].lower()

            if status == ACTIVE_STATUS:
                active += 1

            elif status == INACTIVE_STATUS:
                inactive += 1

            elif status == MAINTENANCE_STATUS:
                maintenance += 1

            elif status == ERROR_STATUS:
                errors += 1

        total_machines = len(
            machine_data["data"]
        )

        #
        # BAGGAGE
        #

        underway = 0
        delivered = 0
        stored = 0
        lost = 0

        for bag in baggage_data["data"]:

            status = bag["status"]["naam"].lower()

            if status == BAG_UNDERWAY_STATUS:
                underway += 1

            elif status == BAG_DELIVERED_STATUS:
                delivered += 1

            elif status == BAG_STORED_STATUS:
                stored += 1

            elif status == BAG_LOST_STATUS:
                lost += 1

        total_bags = len(
            baggage_data["data"]
        )

        #
        # FLIGHTS
        #

        delayed_flights = 0

        for flight in flight_data["data"]:

            if flight["vertraging"] > 0:
                delayed_flights += 1

        total_flights = len(
            flight_data["data"]
        )

        #
        # KPI CALCULATIONS
        #

        availability = machine_availability(
            active,
            total_machines
        )

        usage = gate_usage(
            open_gates,
            total_gates
        )

        accuracy = sorting_accuracy(
            total_bags,
            lost
        )

        completion = completion_rate(
            delivered,
            stored,
            total_bags
        )

        delay = delay_rate(
            delayed_flights,
            total_flights
        )

        health = system_health(
            completion,
            accuracy,
            availability,
            delay
        )

        current_bottleneck = bottleneck(
            availability,
            completion,
            accuracy,
            delay
        )

        average_time, best_time, worst_time = (
            calculate_times(
                baggage_data["data"]
            )
        )

        target = target_score(
            average_time,
            TARGET_PROCESSING_TIME
        )

        #
        # VALIDATION
        #

        validation_result = validate_system(
            total_bags,
            underway,
            delivered,
            stored,
            lost
        )

        write_log(
            VALIDATION_LOG_FILE,
            validation_result
        )

        add_event(
            "VALIDATION",
            validation_result
        )

        #
        # OUTPUT
        #

        print("\n===================================")
        print("AIRPORT MONITOR")
        print("===================================")

        print("\nHOME")
        print("----")

        print("Validation:", validation_result)
        print("System Health:", health, "%")
        print("Bottleneck:", current_bottleneck)
        print("Total Baggage:", total_bags)
        print("Total Flights:", total_flights)

        print("\nMACHINES")
        print("--------")

        print("Active:", active)
        print("Inactive:", inactive)
        print("Maintenance:", maintenance)
        print("Errors:", errors)
        print("Availability:", availability, "%")

        print("\nGATES")
        print("-----")

        print("Open:", open_gates)
        print("Closed:", closed_gates)
        print("Gate Usage:", usage, "%")

        print("\nBAGGAGE")
        print("-------")

        print("Underway:", underway)
        print("Delivered:", delivered)
        print("Stored:", stored)
        print("Lost:", lost)
        print("Sorting Accuracy:", accuracy, "%")
        print("Completion Rate:", completion, "%")

        print("\nFLIGHTS")
        print("-------")

        print("Total Flights:", total_flights)
        print("Delayed Flights:", delayed_flights)
        print("Delay Rate:", delay, "%")

        print("\nPERFORMANCE")
        print("-----------")

        print("System Health:", health, "%")
        print("Availability:", availability, "%")
        print("Accuracy:", accuracy, "%")
        print("Completion:", completion, "%")
        print("Delay Rate:", delay, "%")
        print("Bottleneck:", current_bottleneck)

        print("\nTIMES")
        print("-----")

        print("Average Time:", average_time, "hours")
        print("Best Time:", best_time, "hours")
        print("Worst Time:", worst_time, "hours")
        print("Target Score:", target, "%")

        send_data(
            health,
            open_gates,
            total_flights,
            active,
            round(average_time, 2),
            round(target, 1),
            round(availability, 1),
            round(accuracy, 1),
            round(completion, 1),
            round(delay, 1),
            current_bottleneck
        )
        
        time.sleep(
            UPDATE_INTERVAL
        )

    except Exception as error:

        print(error)

        write_log(
            ERROR_LOG_FILE,
            str(error)
        )

        add_event(
            "ERROR",
            str(error)
        )

        time.sleep(
            UPDATE_INTERVAL
        )
        