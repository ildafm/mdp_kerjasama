<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai <b>{{ $details['user_name'] }}</b>, diinformasikan bahwa anda telah ditugaskan pada sebuah kegiatan,
        yang dimulai pada tanggal <b>{{ $details['tanggal_mulai'] }}</b> sampai dengan tanggal
        <b>{{ $details['tanggal_sampai'] }}</b>
    </p>

    <p>
        Silahkan klik link di bawah untuk informasi lebih lanjut.
        <a href="{{ url('kegiatans', $details['id_kegiatan']) }}">Kegiatan Baru</a>
    </p>

    <p> Thank you </p>
</body>

</html>
