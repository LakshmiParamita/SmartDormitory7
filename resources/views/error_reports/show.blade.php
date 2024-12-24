<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Error - {{ $buildingName }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #fefefe;
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .actions button, .actions a {
            padding: 5px 10px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .actions .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .actions .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-add {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Error - {{ $buildingName }}</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>error-title</th>
                    <th>error-description</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($errorReports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->error_title }}</td>
                        <td>{{ $report->error_description }}</td>
                        <td class="actions">
                            <a href="{{ route('error_reports.edit', [$buildingName, $report->id]) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('error_reports.destroy', [$buildingName, $report->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('error_reports.create', $buildingName) }}" class="btn-add">Tambah Laporan</a>
    </div>

</body>
</html>
