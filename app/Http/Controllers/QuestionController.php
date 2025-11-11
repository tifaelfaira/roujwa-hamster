<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama'       => 'required|max:20',
            'email'      => ['required', 'email'],
            'pertanyaan' => 'required|max:300|min:3',
        ]);

        $data['nama']       = $request->nama;
        $data['email']      = $request->email;
        $data['pertanyaan'] = $request->pertanyaan;

        //return view('home-question-respon', $data);

        // Redirect ke route yang memiliki alias 'home'
        return redirect()->route('home')->with('info', 'Terimakasih atas pertanyaannya <b> ' .$data['nama'].'! </b>
        Silahkan cek email anda di <b>' .$data['email'].'</b> untuk respon lebih lanjut');

        // //Redirect ke halaman sebelumnya
        // return redirect()->back();

        // // Redirect ke URL eksternal
        //  return redirect()->away('https://www.tokopedia.com');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //tes
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
