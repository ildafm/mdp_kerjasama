<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai {{ $details['user_name'] }}, Di informasikan bahwa anda belum memberikan laporan terkait suatu kegiatan
    </p>
    <p>
        Silahkan klik link dibawah ini untuk menuju ke kegiatan. <br>
        <a href="{{ url('kegiatans', $details['id_kegiatan']) }}">Kegiatan belum ada laporan</a>
    </p>
    <p>Thank you</p>
</body>

</html>
