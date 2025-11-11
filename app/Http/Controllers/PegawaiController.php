<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data['name']              = 'Arini Zahira Putri';
        $data['my_age']            = date('Y') - date('Y', strtotime('2005-09-07'));
        $data['hobbies']           = ['Membaca', 'Olahraga', 'Main game', 'Nonton film', 'Traveling'];
        $data['tgl_harus_wisuda']  = '2026-11-01';
        $data['time_to_study_left']= (strtotime('2026-08-01') - time()) / 60 / 60 / 24;
        $data['current_semester']  = 2;
        $data['semester_info']     = $data['current_semester'] < 3
                                        ? 'Masih Awal, Kejar TAK'
                                        : 'Jangan main-main, kurang-kurangi main game!';
        $data['future_goal']       = 'Menjadi Software Engineer';

        return view('pegawai', $data);
    }
}
