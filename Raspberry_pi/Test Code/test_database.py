from database import (
    create_database,
    add_event
)

create_database()

add_event(
    "SYSTEM",
    "Database created"
)

print("Database created successfully")
