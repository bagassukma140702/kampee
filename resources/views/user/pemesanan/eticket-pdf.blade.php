<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pemesanan - E-Ticket</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 30px;
            background-color: #f9fafb;
            color: #111827;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #111827;
        }

        .section {
            margin-bottom: 25px;
        }

        .row {
            display: flex;
            margin-bottom: 12px;
        }

        .label {
            width: 180px;
            font-weight: bold;
            color: #374151;
        }

        .value {
            color: #111827;
        }

        .image {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 20px;
        }

        .heading {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Detail Pemesanan</h1>

        {{-- Info Paket --}}
        <div class="section" style="display: flex;">
            @php
                $path = public_path('storage/' . $pemesanan->paket->gambar);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            @endphp

            <img src="{{ $base64 }}" alt="Gambar Wisata" class="image">

            <div>
                <div style="font-size: 18px; font-weight: bold;">{{ $pemesanan->paket->nama }}</div>
                <div style="color: #6b7280;">{{ $pemesanan->paket->lokasi }}</div>
            </div>
        </div>

        {{-- Rincian Pemesanan --}}
        <div class="section">
            <div class="heading">Rincian Pemesanan</div>
            <div class="row">
                <div class="label">Tanggal Keberangkatan:</div>
                <div class="value">
                    {{ \Carbon\Carbon::parse($pemesanan->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</div>
            </div>
            <div class="row">
                <div class="label">Jumlah Peserta:</div>
                <div class="value">{{ $pemesanan->jumlah }} orang</div>
            </div>
            <div class="row">
                <div class="label">Total Harga:</div>
                <div class="value">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</div>
            </div>
            <div class="row">
                <div class="label">Status:</div>
                <div class="value">{{ ucfirst($pemesanan->status) }}</div>
            </div>
            <div class="row">
                <div class="label">Order ID:</div>
                <div class="value">{{ $pemesanan->order_id }}</div>
            </div>
        </div>

        {{-- Data Pemesan --}}
        <div class="section">
            <div class="heading">Data Pemesan</div>
            <div class="row">
                <div class="label">Nama:</div>
                <div class="value">{{ $pemesanan->user->name }}</div>
            </div>
            <div class="row">
                <div class="label">Email:</div>
                <div class="value">{{ $pemesanan->user->email }}</div>
            </div>
        </div>

        <div class="footer">
            Tunjukkan e-ticket ini saat check-in.<br>
            Dicetak otomatis pada {{ now()->locale('id')->translatedFormat('d F Y, H:i') }}
        </div>
    </div>
</body>

</html>
