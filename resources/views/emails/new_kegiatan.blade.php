<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai <b>{{ $details['user_name'] }}</b>, anda ditugaskan pada kegiatan
        '<b>{{ $details['bentuk_kegiatan'] }}</b>',
        yang dimulai pada tanggal <b>{{ $details['tanggal_mulai'] }}</b> sampai dengan tanggal
        <b>{{ $details['tanggal_sampai'] }}</b>, silahkan klik link di bawah untuk melihat lebih detail.
    </p>

    <a href="{{ url('notification_kegiatan') }}">Kegiatan Baru</a>
    <p>Thank you</p>
</body>

</html>
