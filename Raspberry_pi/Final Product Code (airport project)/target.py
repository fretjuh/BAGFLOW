def target_score(
    average_time,
    target_time
):

    if average_time == 0:
        return 0

    return round(
        (
            target_time
            /
            average_time
        ) * 100,
        1
    )