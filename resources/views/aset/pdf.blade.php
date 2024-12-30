<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Aset</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h2 {
            margin: 10px 0;
            color: #333;
        }
        .meta-info {
            margin-bottom: 20px;
        }
        .meta-info p {
            margin: 5px 0;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px 8px;
            text-align: left;
            font-size: 14px;
        }
        th { 
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 80px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DAFTAR ASET</h2>
        <p>PT. Bhakti Unggul Teknovasi</p>
    </div>

    <div class="meta-info">
        <p>Tanggal Cetak: {{ date('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $totalNilaiAset = 0; @endphp
            @foreach ($asets as $aset)
            @php 
                $total = $aset->harga * $aset->jumlah;
                $totalNilaiAset += $total;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aset->nama_aset }}</td>
                <td>Rp {{ number_format($aset->harga, 0, ',', '.') }}</td>
                <td>{{ $aset->satuan }}</td>
                <td>{{ $aset->jumlah }}</td>
                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5" style="text-align: right">Total Nilai Aset:</td>
                <td>Rp {{ number_format($totalNilaiAset, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Bandung, {{ date('d F Y') }}</p>
        <div class="signature">
            <p>Mengetahui,</p>
            <br><br>
            <p>( ______________ )</p>
            <p>General Manager</p>
        </div>
    </div>
</body>
</html> 