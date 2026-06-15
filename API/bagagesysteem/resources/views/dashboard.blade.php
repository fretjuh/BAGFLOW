<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Gates</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 24px
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 900px
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left
        }

        th {
            background: #f4f4f4
        }

        .none {
            color: #666;
            font-size: 0.95rem
        }
    </style>
</head>

<body>
    <h1>Gates Dashboard</h1>

    @if (isset($gates) && $gates->count())
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Positie</th>
                    <th>Omschrijving</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gates as $gate)
                    <tr>
                        <td>{{ $gate->naam ?? '-' }}</td>
                        <td>{{ $gate->positie ?? '-' }}</td>
                        <td>{{ $gate->omschrijving ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="none">No gates found.</p>
    @endif

    <p style="margin-top:18px"><a href="/">Back to home</a></p>
</body>

</html>
