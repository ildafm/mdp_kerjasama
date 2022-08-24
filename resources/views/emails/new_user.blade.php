<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        {{ $details['salam'] }}, Di informasikan bahwa email anda sudah di daftarkan pada aplikasi mdp kerjasama,
        gunakan informasi dibawah ini untuk lanjut ke proses aktivasi
    </p>
    <p>
        Email : {{ $details['user_email'] }} <br>
        Temporary Password : {{ $details['user_password'] }}
    </p>
    <p>
        Silahkan login menggunakan link dibawah ini. <br>
        <a href="{{ url('') }}">{{ ur }}l('')}}</a>
    </p>

    <p>Thank you</p>
</body>

</html>
