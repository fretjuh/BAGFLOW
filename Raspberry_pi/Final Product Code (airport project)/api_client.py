import requests

from config import API_BASE_URL


def get_baggage():

    response = requests.get(
        f"{API_BASE_URL}/bagage",
        verify=False
    )

    return response.json()


def get_gates():

    response = requests.get(
        f"{API_BASE_URL}/gates",
        verify=False
    )

    return response.json()


def get_machines():

    response = requests.get(
        f"{API_BASE_URL}/machines",
        verify=False

)

    return response.json()


def get_flight_schedules():

    response = requests.get(
        f"{API_BASE_URL}/vluchtschemas",
        verify=False
    )

    return response.json()