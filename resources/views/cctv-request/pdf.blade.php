<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan Permintaan Rekaman CCTV</title>
    <style>
        @page {
            margin: 25px 35px 25px 35px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            line-height: 1.2;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .header-table td {
            border: 1.5px solid #000;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
        }
        .header-logo {
            max-width: 90px;
            max-height: 48px;
            height: auto;
            display: block;
            margin: 0 auto 3px auto;
        }
        .header-company-name {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.5px;
            line-height: 1.1;
        }
        .content-table td {
            border: 1.5px solid #000;
            padding: 5px 8px;
            vertical-align: top;
            font-size: 11px;
        }
        .bg-gray {
            background-color: #d9d9d9;
            font-weight: bold;
            font-style: italic;
            padding: 4px 8px !important;
            font-size: 11px;
        }
        .signature-table td {
            border: 1.5px solid #000;
            text-align: center;
            vertical-align: top;
        }
        .signature-title {
            font-weight: bold;
            padding: 4px;
            font-size: 11px;
            height: 18px;
        }
        .signature-box {
            height: 60px;
        }
        .signature-footer {
            height: 20px;
            text-align: left;
            vertical-align: middle;
            padding: 3px 6px;
            font-size: 10px;
            font-weight: bold;
        }
        .disclaimer {
            font-size: 9px;
            font-style: italic;
            color: #333;
            margin-top: 10px;
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .footer {
            font-size: 9.5px;
            font-style: italic;
            font-weight: bold;
            color: #000;
        }
        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1.5px solid #000;
            text-align: center;
            line-height: 12px;
            font-size: 10px;
            font-weight: bold;
            margin-right: 4px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td rowspan="2" style="width: 22%;">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
                @else
                    <div style="height: 40px; line-height: 40px; font-weight: bold;">[LOGO]</div>
                @endif
                <div class="header-company-name">KUSUMA AGROWISATA GROUP</div>
            </td>
            <td style="width: 26%; font-weight: bold; font-style: italic; font-size: 13px;">DIREKSI</td>
            <td style="width: 24%; font-weight: bold; font-style: italic; font-size: 13px;">FORMULIR</td>
            <td rowspan="2" style="width: 28%; font-size: 10px; text-align: left; padding: 6px 8px; vertical-align: top; line-height: 1.6;">
                <strong>Nomor</strong> &nbsp;&nbsp;&nbsp;&nbsp;: {{ $data->nomor_formulir }}<br>
                <strong>Tanggal</strong> &nbsp;&nbsp;: {{ \Carbon\Carbon::parse($data->tanggal_formulir)->translatedFormat('d F Y') }}<br>
                <strong>Revisi</strong> &nbsp;&nbsp;&nbsp;&nbsp;: 01<br>
                <strong>Halaman</strong> : Halaman 1 dari 1
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold; font-size: 12px; padding: 8px 4px; line-height: 1.3;">
                SURAT PENGAJUAN PERMINTAAN<br>REKAMAN CCTV OLEH KLIEN
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-weight: bold; font-size: 12px; margin: 12px 0 10px 0; letter-spacing: 0.3px; line-height: 1.3;">
        FORM PENGAJUAN PERMINTAAN REKAMAN CCTV<br>OLEH KLIEN
    </div>

    <table class="content-table">
        <tr>
            <td colspan="2" class="bg-gray">*diisi oleh Security</td>
        </tr>
        <tr>
            <td style="width: 32%;">Nama Klien</td>
            <td style="width: 68%;">: {{ $data->nama_klien }}</td>
        </tr>
        <tr>
            <td>No KTP</td>
            <td>: {{ $data->no_ktp }}</td>
        </tr>
        <tr>
            <td>No Handphone</td>
            <td>: {{ $data->no_hp }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->alamat }}</td>
        </tr>
        <tr>
            <td>Alasan atau kronologi</td>
            <td>: {{ $data->alasan_kronologi }}</td>
        </tr>
        <tr>
            <td>Tanggal kejadian</td>
            <td>: {{ \Carbon\Carbon::parse($data->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Pukul/waktu kejadian</td>
            <td>: {{ \Carbon\Carbon::parse($data->waktu_kejadian)->format('H:i') }}</td>
        </tr>
        <tr>
            <td>Posisi CCTV</td>
            <td>: {{ $data->posisi_cctv }}</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 6px; padding-bottom: 6px;">
                <div style="margin-bottom: 6px;">
                    <span class="checkbox">X</span> <strong>Lampiran KTP (Foto) - terlampir</strong>
                </div>
                @if($data->foto_ktp && file_exists(storage_path('app/public/'.$data->foto_ktp)))
                    <div style="text-align: left; margin-top: 4px;">
                        <img src="{{ storage_path('app/public/'.$data->foto_ktp) }}" style="max-width: 220px; max-height: 120px; border: 1px solid #999;">
                    </div>
                @else
                    <div style="font-style: italic; color: #666; font-size: 10px;">[Tidak ada foto KTP terlampir]</div>
                @endif
            </td>
        </tr>
    </table>

    <table class="content-table" style="margin-bottom: 12px;">
        <tr>
            <td class="bg-gray">*diisi oleh IT Direksi</td>
        </tr>
        <tr>
            <td style="padding-top: 10px; padding-bottom: 10px;">
                Keputusan (*coret salah satu) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: diijinkan / ditolak
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
            <td class="signature-box"></td>
            <td class="signature-box"></td>
            <td class="signature-box"></td>
            <td class="signature-box"></td>
        </tr>
        <tr>
            <td class="signature-footer">Kabiro IT Direksi</td>
            <td class="signature-footer"></td>
            <td class="signature-footer"></td>
            <td class="signature-footer"></td>
        </tr>
    </table>

    <div class="disclaimer">
        * Rekaman CCTV ini bersifat rahasia dan hanya diperuntukkan untuk kepentingan internal perusahaan, serta tidak untuk disebarluaskan, digandakan, atau dipublikasikan kepada pihak lain tanpa izin tertulis dari pihak berwenang.
    </div>

    <div class="footer">
        Human Resource Development Direksi - System & Procedure
    </div>

</body>
</html>
