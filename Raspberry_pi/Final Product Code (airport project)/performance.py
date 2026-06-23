def system_health(
    completion_rate,
    sorting_accuracy,
    machine_availability,
    delay_rate
):

    score = (
        completion_rate * 0.35
        +
        sorting_accuracy * 0.30
        +
        machine_availability * 0.25
        +
        (100 - delay_rate) * 0.10
    )

    return round(
        score,
        1
    )


def bottleneck(
    machine_availability,
    completion_rate,
    sorting_accuracy,
    delay_rate
):

    values = {
        "Machines": machine_availability,
        "Completion": completion_rate,
        "Accuracy": sorting_accuracy,
        "Flights": 100 - delay_rate
    }

    return min(
        values,
        key=values.get
    )