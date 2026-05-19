<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Wellbeing - {{ strtoupper(str_replace('_', ' ', $type)) }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
            line-height: 1.5;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #333333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1e3a8a;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #555555;
        }
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .meta-table td {
            padding: 6px 10px;
            font-size: 13px;
        }
        .meta-table td.label {
            font-weight: bold;
            color: #555555;
            width: 150px;
        }
        .meta-table td.value {
            border-bottom: 1px solid #e5e7eb;
        }
        .score-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        .score-box h2 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .score-value {
            font-size: 48px;
            font-weight: 800;
            color: #1d4ed8;
            margin-bottom: 5px;
        }
        .score-box p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }
        .interpretation-section {
            margin-bottom: 40px;
        }
        .interpretation-section h3 {
            font-size: 15px;
            color: #1e3a8a;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 5px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .interpretation-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
            font-weight: bold;
            color: #1e3a8a;
            line-height: 1.6;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .details-table th {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 10px;
            font-size: 12px;
            text-align: left;
            color: #475569;
            text-transform: uppercase;
        }
        .details-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            font-size: 12px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px dashed #cbd5e1;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Teman Sebayaku</h1>
        <p>Laporan Hasil Pengukuran Tingkat Kesejahteraan Psikologis (Wellbeing)</p>
    </div>

    <table class="meta-table">
        <tr>
            <td class="label">Nama Pengisi</td>
            <td class="value">: {{ $answer->konseli_name }}</td>
            <td class="label">Tipe Kuesioner</td>
            <td class="value">: {{ strtoupper(str_replace('_', ' ', $type)) }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pengisian</td>
            <td class="value">: {{ $answer->completed_at->format('d F Y') }}</td>
            <td class="label">Waktu Selesai</td>
            <td class="value">: {{ $answer->completed_at->format('H:i') }} WIB</td>
        </tr>
    </table>

    <div class="score-box">
        <h2>Total Skor Hasil Tes</h2>
        <div class="score-value">{{ $answer->total_score }}</div>
        <p>Total Skor maksimal yang mungkin diraih adalah {{ $answer->details->count() * 4 }} Poin</p>
    </div>

    <div class="interpretation-section">
        <h3>Hasil Analisis & Interpretasi</h3>
        <div class="interpretation-box">
            {{ $answer->interpretation->description ?? 'Deskripsi interpretasi tidak ditemukan.' }}
        </div>
    </div>

    <h3>Rincian Jawaban Butir Kuesioner</h3>
    <table class="details-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 55%;">Pertanyaan / Pernyataan</th>
                <th style="width: 30%;">Jawaban Terpilih</th>
                <th style="width: 10%; text-align: center;">Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answer->details as $index => $detail)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $detail->question->text }}</td>
                    <td>{{ $detail->selectedOption->label }}</td>
                    <td style="text-align: center; font-weight: bold; color: #1d4ed8;">{{ $detail->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Laporan ini dihasilkan secara otomatis oleh sistem layanan konseling sebaya Teman Sebayaku.<br>
        &copy; {{ date('Y') }} Teman Sebayaku. Hak Cipta Dilindungi Undang-Undang.
    </div>
</body>
</html>
