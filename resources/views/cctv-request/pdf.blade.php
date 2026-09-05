<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan Permintaan Rekaman CCTV</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        .header-logo {
            width: 100px;
            height: auto;
        }
        .content-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }
        .bg-gray {
            background-color: #e0e0e0;
            font-weight: bold;
            font-style: italic;
        }
        .signature-table td {
            border: 1px solid #000;
            text-align: center;
            vertical-align: top;
            height: 100px;
        }
        .signature-title {
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid #000;
        }
        .footer {
            font-size: 10px;
            font-style: italic;
            margin-top: 10px;
        }
        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            text-align: center;
            line-height: 12px;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td rowspan="2" style="width: 20%;">
                <!-- As requested, using public_path for local image in DomPDF -->
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
                @else
                    <div style="height: 50px; display: flex; align-items: center; justify-content: center;">[LOGO]</div>
                @endif
                <div style="font-size: 10px; margin-top: 5px;">KUSUMA AGROWISATA GROUP</div>
            </td>
            <td style="width: 25%; font-weight: bold; font-size: 14px;">DIREKSI</td>
            <td style="width: 25%; font-weight: bold; font-size: 14px;">FORMULIR</td>
            <td rowspan="2" style="width: 30%; font-size: 10px; text-align: left; padding-left: 10px;">
                Nomor &nbsp;&nbsp;&nbsp;: {{ $data->nomor_formulir }}<br><br>
                Tanggal &nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_formulir)->translatedFormat('d F Y') }}<br><br>
                Revisi &nbsp;&nbsp;&nbsp;&nbsp;: 01<br><br>
                Halaman : Halaman 1 dari 1
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold; font-size: 12px;">
                SURAT PENGAJUAN PERMINTAAN<br>REKAMAN CCTV OLEH KLIEN
            </td>
        </tr>
    </table>

    <h2 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">FORM PENGAJUAN PERMINTAAN REKAMAN CCTV OLEH KLIEN</h2>

    <table class="content-table">
        <tr>
            <td colspan="2" class="bg-gray">*diisi oleh Security</td>
        </tr>
        <tr>
            <td style="width: 30%;">Nama Klien</td>
            <td style="width: 70%;">: {{ $data->nama_klien }}</td>
        </tr>
        <tr>
            <td>No. KTP</td>
            <td>: {{ $data->no_ktp }}</td>
        </tr>
        <tr>
            <td>No. Handphone</td>
            <td>: {{ $data->no_hp }}</td>
        </tr>
        <tr>
            <td>Alamat Klien</td>
            <td>: {{ $data->alamat }}</td>
        </tr>
        <tr>
            <td>Alasan & Kronologi</td>
            <td>: {{ $data->alasan_kronologi }}</td>
        </tr>
        <tr>
            <td>Tanggal & Waktu Kejadian</td>
            <td>: {{ \Carbon\Carbon::parse($data->tanggal_kejadian)->translatedFormat('d F Y') }} / {{ \Carbon\Carbon::parse($data->waktu_kejadian)->format('H:i') }}</td>
        </tr>
        <tr>
            <td>Posisi CCTV yang Diminta</td>
            <td>: {{ $data->posisi_cctv }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>
                <div class="checkbox">&#10003;</div> Lampiran KTP (Foto)<br><br>
                @if($data->foto_ktp && file_exists(storage_path('app/public/'.$data->foto_ktp)))
                    <img src="{{ storage_path('app/public/'.$data->foto_ktp) }}" style="max-width: 250px; border: 1px solid #ccc;">
                @else
                    [Tidak ada foto KTP terlampir]
                @endif
            </td>
        </tr>
    </table>

    <table class="content-table">
        <tr>
            <td class="bg-gray">*diisi oleh IT Direksi</td>
        </tr>
        <tr>
            <td style="padding-top: 15px; padding-bottom: 15px;">
                Keputusan (*coret salah satu) : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;diijinkan / ditolak
            </td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td class="signature-title" style="width: 25%;">IT Direksi</td>
            <td class="signature-title" style="width: 25%;">Security</td>
            <td class="signature-title" style="width: 25%;">HOD</td>
            <td class="signature-title" style="width: 25%;">Klien</td>
        </tr>
        <tr>
            <td style="height: 80px; border-bottom: none;">
                <!-- Signature space -->
            </td>
            <td rowspan="2" style="height: 100px;"></td>
            <td rowspan="2" style="height: 100px;"></td>
            <td rowspan="2" style="height: 100px;"></td>
        </tr>
        <tr>
            <td style="text-align: left; padding: 5px; font-size: 10px; border-top: 1px solid #000; height: 20px;">
                Kabiro IT Direksi
            </td>
        </tr>
    </table>

    <div class="footer">
        Human Resource Development Direksi - System & Procedure
    </div>

</body>
</html>
