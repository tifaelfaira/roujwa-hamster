<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data['name']              = 'Roujwa Tifaelfaira Nihallubna';
        $data['my_age']            = date('Y') - date('Y', strtotime('2006-05-31'));
        $data['hobbies']           = ['Menggambar', 'Nonton Drakor', 'Berenang', 'Traveling'];
        $data['tgl_harus_wisuda']  = '2028-10-19';
        $data['time_to_study_left']= (strtotime('2028-08-10') - time()) / 60 / 60 / 24;
        $data['current_semester']  = 3;
        $data['semester_info']     = $data['current_semester'] < 3
                                        ? 'Masih Awal, Kejar TAK'
                                        : 'Jangan main-main, kurang-kurangi main game!';
        $data['future_goal']       = 'Menjadi Desainer and flogger terkenal';

        return view('pegawai', $data);
    }
}
