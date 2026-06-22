def calculate_percentage(part, total):

    if total == 0:
        return 0

    return round(
        (part / total) * 100,
        1
    )


def machine_availability(
    active,
    total
):

    return calculate_percentage(
        active,
        total
    )


def gate_usage(
    open_gates,
    total_gates
):

    return calculate_percentage(
        open_gates,
        total_gates
    )


def delay_rate(
    delayed,
    total
):

    return calculate_percentage(
        delayed,
        total
    )


def sorting_accuracy(
    total_bags,
    lost_bags
):

    if total_bags == 0:
        return 0

    return round(
        (
            (total_bags - lost_bags)
            /
            total_bags
        ) * 100,
        1
    )


def completion_rate(
    delivered,
    stored,
    total
):

    if total == 0:
        return 0

    return round(
        (
            (delivered + stored)
            /
            total
        ) * 100,
        1
    )