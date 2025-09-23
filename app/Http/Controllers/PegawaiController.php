<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
     public function index()
    {
       $data ['name']        = 'Roujwa';
    $data ['my_age']      = $this->calculateAge('2006-05-31');
    $data ['hobbies'] = ['Menggambar','Nonton Drakor','Berenang', 'Travelling'];
    $data ['tgl_harus_wisuda'] = ['2028-10-19'];
    $data ['time_to_study_left'] =  $this->calculateStudyTimeLeft($data['tgl_harus_wisuda']);
    $data ['current_semester'] = ['4'];

    if ($data['current_semester'] < 3) {
            $data['semester_message'] = 'Masih Awal, Kejar TAK';
        } else {
            $data['semester_message'] = 'Jangan main-main, kurang-kurangi main game!';
        }

        // Cita-cita
        $data['future_goal'] = 'Desainer';

        // Menampilkan data ke view 'home'
        return view('home', $data);
    }

     private function calculateAge($dob)
    {
        $dob = new DateTime($dob);
        $now = new DateTime();
        $age = $now->diff($dob);
        return $age->y; // Mengembalikan umur dalam tahun
    }

    // Fungsi untuk menghitung sisa waktu hingga wisuda
    private function calculateStudyTimeLeft($graduation_date)
    {
        $graduation_date = new DateTime($graduation_date);
        $now = new DateTime();
        $interval = $now->diff($graduation_date);
        return $interval->format('%y tahun, %m bulan, %d hari'); // Format sisa waktu
    }
}

