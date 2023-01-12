<!DOCTYPE html>
<html>

<head>
    <title>{{ $details['title'] }}</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>
        {{ $details['salam'] }} {{ $details['admin_name'] }}, Di informasikan bahwa terdapat usulan baru yang telah di
        input.
    </p>
    <p>
        Usulan : {{ $details['usulan'] }} <br>
        Bentuk Kerjasama : {{ $details['bentuk_kerjasama'] }} <br>
        Nama Pengusul : {{ $details['nama_pengusul'] }} <br>
        Kontak Kerjasama : {{ $details['kontak_kerjasama'] }}
    </p>
    <p>
        Silahkan klik link dibawah ini untuk informasi lebih detail. <br>
        <a href="{{ url('usulans', $details['id_usulan']) }}">Usulan Baru</a>
    </p>
    <p>Thank you</p>
</body>

</html>
