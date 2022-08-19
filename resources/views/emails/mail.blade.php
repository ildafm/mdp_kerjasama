<!DOCTYPE html>
<html>

<head>
    <title>Kegiatan Baru</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <a href="{{ url('notification_kegiatan') }}">Kegiatan</a>
    <p>Thank you</p>
</body>

</html>
