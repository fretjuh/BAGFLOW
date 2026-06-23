from datetime import datetime


def calculate_times(
    baggage_data
):

    durations = []

    for bag in baggage_data:

        if bag["aflevertijd"]:

            start = datetime.strptime(
                bag["inlevertijd"],
                "%Y-%m-%d %H:%M:%S"
            )

            end = datetime.strptime(
                bag["aflevertijd"],
                "%Y-%m-%d %H:%M:%S"
            )

            hours = (
                end - start
            ).total_seconds() / 3600

            durations.append(
                hours
            )

    if len(durations) == 0:

        return (
            0,
            0,
            0
        )

    average = round(
        sum(durations)
        /
        len(durations),
        2
    )

    best = round(
        min(durations),
        2
    )

    worst = round(
        max(durations),
        2
    )

    return (
        average,
        best,
        worst
    )