<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 13px; line-height: 1.6; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 20px; }
        .kop h2, .kop h4 { margin: 0; }
        table.info td { padding: 2px 6px; vertical-align: top; }
        .ttd { margin-top: 60px; text-align: right; }
    </style>
</head>
<body>
    <div class="kop">
        <h4>PEMERINTAH DAERAH</h4>
        <h2>BADAN PERENCANAAN PEMBANGUNAN, PENELITIAN DAN PENGEMBANGAN DAERAH</h2>
        <p>(BAPELITBANGDA)</p>
    </div>

    <table class="info" style="width:100%; margin-bottom: 20px;">
        <tr>
            <td style="width:120px;">Nomor</td>
            <td>: {{ $surat->nomor_surat }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>: Surat Persetujuan Peminjaman {{ $booking->aula->nama }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: {{ $surat->tanggal_surat->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <p>Dengan ini menerangkan bahwa telah disetujui peminjaman aula dengan rincian sebagai berikut:</p>

    <table class="info" style="width:100%;">
        <tr><td style="width:180px;">Nama Aula</td><td>: {{ $booking->aula->nama }}</td></tr>
        <tr><td>Hari / Tanggal</td><td>: {{ $booking->tanggal->translatedFormat('l, d F Y') }}</td></tr>
        <tr><td>Waktu</td><td>: {{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB</td></tr>
        <tr><td>Keperluan</td><td>: {{ $booking->keperluan }}</td></tr>
        <tr><td>Jumlah Peserta</td><td>: {{ $booking->jumlah_peserta ?? '-' }} orang</td></tr>
        <tr><td>Pemohon</td><td>: {{ $booking->user->name }} ({{ $booking->user->unit_kerja ?? '-' }})</td></tr>
        <tr><td>Penanggung Jawab</td><td>: {{ $booking->pic_nama }} ({{ $booking->pic_hp }})</td></tr>
    </table>

    <p style="margin-top: 20px;">
        Demikian surat persetujuan ini dibuat untuk dipergunakan sebagaimana mestinya.
    </p>

    <div class="ttd">
        <p>{{ $surat->tanggal_surat->translatedFormat('d F Y') }}</p>
        <p>Kepala Bapelitbangda</p>
        <br><br><br>
        <p><u>( ......................................... )</u></p>
    </div>
</body>
</html>
