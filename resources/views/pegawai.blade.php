<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fcfcfc;
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            background: #4786c0;
        }
        .header-pink {
            background-color: #69b7ff;
            color: rgb(0, 138, 192);
            padding: 20px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }
        .list-group-item {
            border: none;
            background-color: #7ac3c5;
            padding: 5px 10px; /* lebih kecil */
            font-size: 0.9rem; /* text lebih kecil */
        }
        .list-group {
            margin-top: 10px;
        }
        .badge-pink {
            background-color: #69c3ff;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="card shadow">
            <div class="header-pink">
                <h2>{{ $name }}</h2>
                <p class="mb-0">Profil Pegawai</p>
            </div>
            <div class="card-body">
                <p><strong>Umur:</strong> {{ $my_age }} tahun</p>
                <p><strong>Semester:</strong> {{ $current_semester }}</p>
                <p><strong>Info Semester:</strong>
                    <span class="badge badge-pink">{{ $semester_info }}</span>
                </p>
                <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
                <p><strong>Sisa Waktu Studi:</strong> {{ $time_to_study_left }} hari</p>
                <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>

                <h5 class="mt-3 mb-2">Hobi:</h5>
                <ul class="list-group small">
                    @foreach($hobbies as $hobi)
                        <li class="list-group-item">{{ $hobi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
