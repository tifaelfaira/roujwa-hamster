<!-- home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
</head>
<body>
    <h1>Profil Pegawai</h1>

    <p>Nama: {{ $my_name }}</p>
    <p>Umur: {{ $my_age }} tahun</p>
    <p>Hobi:</p>
    <ul>
        @foreach($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>
    <p>Tanggal Wisuda: {{ $tgl_harus_wisuda }}</p>
    <p>Sisa Waktu untuk Wisuda: {{ $time_to_study_left }}</p>
    <p>Semester Saat Ini: {{ $current_semester }}</p>
    <p>Pesan: {{ $semester_message }}</p>
    <p>Cita-cita: {{ $future_goal }}</p>
</body>
</html>

