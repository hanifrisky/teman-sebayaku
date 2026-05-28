<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Wellbeing - {{ strtoupper(str_replace('_', ' ', $type)) }}</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        
        /* Official Header / Kop Surat */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 70px;
            vertical-align: middle;
        }
        .kop-logo img {
            width: 60px;
            height: 60px;
            border-radius: 12px;
        }
        .kop-text {
            vertical-align: middle;
            padding-left: 15px;
        }
        .kop-title {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }
        .kop-subtitle {
            margin: 2px 0 0 0;
            font-size: 11px;
            color: #475569;
            font-weight: 500;
            letter-spacing: 0.2px;
        }
        .kop-divider-thick {
            height: 3px;
            background-color: #1e3a8a;
            margin-top: 10px;
        }
        .kop-divider-thin {
            height: 1px;
            background-color: #3b82f6;
            margin-top: 2px;
            margin-bottom: 25px;
        }

        /* Document Title */
        .doc-title {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        /* Metadata Grid */
        .meta-container {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 25px;
        }
        .meta-container td {
            padding: 10px 14px;
            font-size: 11px;
            vertical-align: top;
        }
        .meta-label {
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
            width: 130px;
        }
        .meta-val {
            color: #1e293b;
            font-weight: 600;
        }
        .meta-border-bottom {
            border-bottom: 1px solid #e2e8f0;
        }
        .meta-border-right {
            border-right: 1px solid #e2e8f0;
        }

        /* Results Overview Grid */
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .results-left {
            width: 33%;
            padding-right: 15px;
            vertical-align: top;
        }
        .results-right {
            width: 67%;
            padding-left: 15px;
            vertical-align: top;
        }

        /* Score Card Box */
        .score-card {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 16px;
            text-align: center;
            padding: 20px 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .score-card-title {
            margin: 0 0 8px 0;
            font-size: 11px;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .score-number {
            font-size: 44px;
            font-weight: 800;
            color: #1d4ed8;
            line-height: 1;
            margin-bottom: 8px;
        }
        .score-desc {
            margin: 0;
            font-size: 10px;
            color: #1e40af;
            font-weight: 600;
        }

        /* Interpretation Details */
        .interpretation-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 5px solid #1e3a8a;
            border-radius: 4px 16px 16px 4px;
            padding: 16px;
            min-height: 98px;
        }
        .interpretation-title {
            margin: 0 0 6px 0;
            font-size: 12px;
            font-weight: 800;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .interpretation-text {
            margin: 0;
            font-size: 11px;
            color: #334155;
            line-height: 1.6;
        }

        /* Table of Detailed Responses */
        .details-section-title {
            font-size: 13px;
            font-weight: 800;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .details-table th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #1e3a8a;
        }
        .details-table td {
            padding: 10px 12px;
            font-size: 10.5px;
            color: #334155;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .details-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .text-center {
            text-align: center;
        }

        /* Footer */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 15px;
        }
        .footer-text {
            font-size: 9px;
            color: #64748b;
            line-height: 1.5;
            text-align: center;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <!-- Header / Kop Surat -->
    <table class="kop-table">
        <tr>
            <td class="kop-logo">
                <img src="{{ public_path('image/logo-mark.png') }}" alt="Logo">
            </td>
            <td class="kop-text">
                <h1 class="kop-title">Teman Sebayaku</h1>
                <p class="kop-subtitle">Model Peer Counseling Berbantuan Digital Self-Help Bermuatan Nilai Kearifan Lokal</p>
            </td>
        </tr>
    </table>
    
    <div class="kop-divider-thick"></div>
    <div class="kop-divider-thin"></div>

    <!-- Document Title -->
    <div class="doc-title">
        Laporan Hasil Analisis Kesejahteraan Psikologis (Well-Being)
    </div>

    <!-- Metadata Grid -->
    <table class="meta-container">
        <tr>
            <td class="meta-label meta-border-bottom meta-border-right">Nama Pengisi</td>
            <td class="meta-val meta-border-bottom meta-border-right">{{ $answer->konseli_name }}</td>
            <td class="meta-label meta-border-bottom">Tipe Kuesioner</td>
            <td class="meta-val meta-border-bottom">{{ strtoupper(str_replace('_', ' ', $type)) }}</td>
        </tr>
        <tr>
            <td class="meta-label meta-border-right">Tanggal Pengisian</td>
            <td class="meta-val meta-border-right">{{ $answer->completed_at->format('d F Y') }}</td>
            <td class="meta-label">Waktu Selesai</td>
            <td class="meta-val">{{ $answer->completed_at->format('H:i') }} WIB</td>
        </tr>
    </table>

    <!-- Score & Interpretation Overview -->
    <table class="results-table">
        <tr>
            <td class="results-left">
                <div class="score-card">
                    <h2 class="score-card-title">Skor Diperoleh</h2>
                    <div class="score-number">{{ $answer->total_score }}</div>
                    <p class="score-desc">Total Skor Tes</p>
                </div>
            </td>
            <td class="results-right">
                <div class="interpretation-card">
                    <h3 class="interpretation-title">Hasil Analisis & Interpretasi</h3>
                    <p class="interpretation-text">
                        {{ $answer->interpretation->description ?? 'Deskripsi interpretasi tidak ditemukan.' }}
                    </p>
                </div>
            </td>
        </tr>
    </table>

    <!-- Detailed Responses Section -->
    <div class="details-section-title">
        Rincian Respon Butir Kuesioner
    </div>
    
    <table class="details-table">
        <thead>
            <tr>
                <th style="width: 8%; text-align: center;">No</th>
                <th style="width: 62%;">Pernyataan / Pertanyaan Instrumen</th>
                <th style="width: 30%;">Respon / Jawaban Terpilih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answer->details as $index => $detail)
                <tr>
                    <td class="text-center font-bold" style="color: #64748b;">{{ $index + 1 }}</td>
                    <td>{{ $detail->question->text }}</td>
                    <td class="font-semibold" style="color: #1e3a8a;">{{ $detail->selectedOption->label }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Summary -->
    <table class="footer-table">
        <tr>
            <td class="footer-text">
                Dokumen hasil pengukuran kesejahteraan psikologis (wellbeing) ini dihasilkan secara otomatis oleh sistem digital Teman Sebayaku.<br>
                Hak Cipta Dilindungi Undang-Undang &copy; {{ date('Y') }} Teman Sebayaku. All Rights Reserved.
            </td>
        </tr>
    </table>
</body>
</html>
