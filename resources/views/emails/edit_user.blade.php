<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        Hai {{ $details['user_name'] }}, Di informasikan bahwa telah terjadi perubahan password pada akun aplikasi mdp
        kerjasama anda, silahkan gunakan informasi dibawah ini untuk login ke aplikasi
    </p>
    <p>
        Email : {{ $details['user_email'] }} <br>
        Temporary Password : {{ $details['user_password'] }}
    </p>
    <p>
        Silahkan login menggunakan link dibawah ini. <br>
        <a href="{{ url('') }}">{{ url('') }}</a>
    </p>

    <p>Thank you</p>
</body>

</html>
