<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Vote Count</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 30px;
            align-items: flex-start;
            justify-content: space-between;
        }

        .panel {
            width: 50%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #2c3e50;
            color: #ffffff;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #eef3f7;
        }

        .badge {
            background-color: #27ae60;
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
        }

        .footer {
            text-align: right;
            margin-top: 10px;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- KING (LEFT) -->
    <div class="panel">
        <h1>👑 King Voting Results</h1>

        <table>
            <thead>
                <tr>
                    <th>Selection ID</th>
                    <th>Name</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data->where('gender','M') as $row)
                    <tr>
                        <td>{{ $row->sel_id }}</td>
                        <td>{{ $row->name }}</td>
                        <td><span class="badge">{{ $row->count }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No king votes available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- QUEEN (RIGHT) -->
    <div class="panel">
        <h1>👑 Queen Voting Results</h1>

        <table>
            <thead>
                <tr>
                    <th>Selection ID</th>
                    <th>Name</th>
                    <th>Votes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data->where('gender','F') as $row)
                    <tr>
                        <td>{{ $row->sel_id }}</td>
                        <td>{{ $row->name }}</td>
                        <td><span class="badge">{{ $row->count }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No queen votes available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
