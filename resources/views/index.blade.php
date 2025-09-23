<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Umur:</strong> {{ $my_age }} tahun</p>

    <p><strong>Hobi:</strong></p>
    <ul>
        @foreach($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>

    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda->toDateString() }}</p>
    <p><strong>Sisa Hari Menuju Wisuda:</strong> {{ $time_to_study_left }} hari</p>
    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>
    <p><strong>Pesan:</strong> {{ $message }}</p>
    <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
</body>
</html>
