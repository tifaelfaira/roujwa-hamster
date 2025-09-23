<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        // Data pribadi
        $name = "Roujwa Tifaelfaira"; // ganti sesuai kebutuhan
        $birthdate = Carbon::create(2003, 5, 12); // contoh tanggal lahir
        $my_age = $birthdate->age;

        // Hobi (minimal 5 item)
        $hobbies = [
            "Membaca Buku",
            "Menulis",
            "Ngoding",
            "Olahraga",
            "Traveling"
        ];

        // Tanggal harus wisuda
        $tgl_harus_wisuda = Carbon::create(2026, 7, 1);

        // Hitung sisa hari dari sekarang ke tanggal wisuda
        $today = Carbon::now();
        $time_to_study_left = $today->diffInDays($tgl_harus_wisuda, false);

        // Semester saat ini
        $current_semester = 5;

        // Pesan sesuai semester
        $message = ($current_semester < 3)
            ? "Masih Awal, Kejar TAK"
            : "Jangan main-main, kurang-kurangi main game!";

        // Cita-cita
        $future_goal = "Menjadi Software Engineer yang bermanfaat";

        // Kirim data ke view
        return view('pegawai.index', compact(
            'name',
            'my_age',
            'hobbies',
            'tgl_harus_wisuda',
            'time_to_study_left',
            'current_semester',
            'message',
            'future_goal'
        ));
    }
}
