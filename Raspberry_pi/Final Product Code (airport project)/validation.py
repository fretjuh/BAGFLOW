def validate_system(
    total_bags,
    underway_bags,
    delivered_bags,
    stored_bags,
    lost_bags
):

    if total_bags == (
        underway_bags
        + delivered_bags
        + stored_bags
        + lost_bags
    ):
        return "SUCCESS"

    return "MISMATCH"