<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff5f9;
            font-family: "Poppins", sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(255, 182, 193, 0.3);
        }
        h2 {
            color: #ff69b4;
            font-weight: bold;
        }
        .info p {
            margin: 5px 0;
        }
        .badge-pink {
            background-color: #ff69b4;
        }
        .hobby-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        .hobby-item {
            background-color: #ffe4ec;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container my-5 d-flex justify-content-center">
        <div class="card text-center" style="max-width: 450px;">
            <h2 class="mb-3">{{ $name }}</h2>
            <div class="info text-start">
                <p><strong>Umur:</strong> {{ $my_age }} tahun</p>
                <p><strong>Semester:</strong> {{ $current_semester }}</p>
                <p><strong>Info Semester:</strong> <span class="badge badge-pink">{{ $semester_info }}</span></p>
                <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
                <p><strong>Sisa Waktu Studi:</strong> {{ $time_to_study_left }} hari</p>
                <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
            </div>

            <h5 class="mt-3">✨ Hobi ✨</h5>
            <div class="hobby-list">
                @foreach($hobbies as $hobi)
                    <span class="hobby-item">{{ $hobi }}</span>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
