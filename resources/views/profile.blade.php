<!DOCTYPE html>
<html>
<head>
    <title>Profile Mahasiswa</title>
</head>
<body>
    <h1>Profile Mahasiswa</h1>

    <p>Nama: <?= $name; ?></p>
    <p>Umur: <?= $my_age; ?> tahun</p>

    <p>Hobi:</p>
    <ul>
        <?php foreach ($hobbies as $hobi): ?>
            <li><?= $hobi; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Tanggal Harus Wisuda: <?= $tgl_harus_wisuda; ?></p>
    <p>Sisa Waktu Belajar: <?= $time_to_study_left; ?> hari</p>
    <p>Semester Saat Ini: <?= $current_semester; ?></p>
    <p>Info Semester: <?= $semester_info; ?></p>
    <p>Cita-cita: <?= $future_goal; ?></p>
</body>
</html>
