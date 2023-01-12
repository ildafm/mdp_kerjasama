<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai {{ $details['nama_kaprodi'] }}, Di informasikan bahwa sudah lewat 30 hari dan ada kegiatan yang belum diberi
        laporan
    </p>
    <div>
        <b>Informasi Kegiatan</b> <br>
        Nama PIC : {{ $details['pic_name'] }} <br>
        Bentuk Kegiatan : {{ $details['bentuk_kegiatan'] }} <br>
        Tanggal Mulai Kegiatan : {{ $details['tanggal_mulai'] }} <br>
        Tanggal Berakhir Kegiatan : {{ $details['tanggal_sampai'] }} <br>
    </div>
    <hr>
    <p>
        Silahkan klik link dibawah ini untuk info lebih lanjut. <br>
        <a href="{{ url('kegiatans', $details['id_kegiatan']) }}">Kegiatan belum ada laporan</a>
    </p>
    <p>Thank you</p>
</body>

</html>
