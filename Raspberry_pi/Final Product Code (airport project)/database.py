import sqlite3

DATABASE_NAME = "airport_logs.db"


def create_database():

    connection = sqlite3.connect(
        DATABASE_NAME
    )

    cursor = connection.cursor()

    cursor.execute("""
        CREATE TABLE IF NOT EXISTS event_log (

            id INTEGER PRIMARY KEY AUTOINCREMENT,

            timestamp TEXT,

            event_type TEXT,

            description TEXT
        )
    """)

    connection.commit()

    connection.close()


def add_event(
    event_type,
    description
):

    connection = sqlite3.connect(
        DATABASE_NAME
    )

    cursor = connection.cursor()

    cursor.execute("""
        INSERT INTO event_log
        (
            timestamp,
            event_type,
            description
        )
        VALUES
        (
            datetime('now'),
            ?,
            ?
        )
    """,
    (
        event_type,
        description
    ))

    connection.commit()

    connection.close()