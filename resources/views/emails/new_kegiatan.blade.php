<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai <b>{{ $details['user_name'] }}</b>, anda ditugaskan pada kegiatan baru,
        yang dimulai pada tanggal <b>{{ $details['tanggal_mulai'] }}</b> sampai dengan tanggal
        <b>{{ $details['tanggal_sampai'] }}</b>, silahkan klik link di bawah untuk informasi lebih detail.
    </p>

    <p>
        <a href="{{ url('kegiatans', $details['id_kegiatan']) }}">Kegiatan Baru</a>
    </p>
    <p> Thank you </p>
</body>

</html>
