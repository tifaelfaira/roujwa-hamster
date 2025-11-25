<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Multipleuploads;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['gender']; // Perbaiki penulisan 'Gender' menjadi 'gender'
        $searchTableColumns = ['first_name', 'last_name', 'email']; // Tambah kolom search
        
        $pageData['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
                    ->search($request, $searchTableColumns)
                    ->paginate(10)
                    ->withQueryString();
        
        return view('admin.pelanggan.index', $pageData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pesan = [
            'first_name.required' => 'First name wajib diisi.',
            'last_name.required'  => 'Last name wajib diisi.',
            'birthday.required'   => 'Birthday wajib diisi.',
            'birthday.date'       => 'Birthday harus berupa tanggal yang valid.',
            'gender.required'     => 'Gender wajib diisi.',
            'gender.in'           => 'Gender hanya boleh diisi dengan Male, Female, atau Other.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Email harus berupa alamat email yang valid.',
            'email.unique'        => 'Email sudah digunakan.',
            'phone.required'      => 'Phone wajib diisi.',
        ];

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'birthday'   => 'required|date',
            'gender'     => 'required|in:Male,Female,Other',
            'email'      => 'required|email|unique:pelanggan,email',
            'phone'      => 'required|string|max:20',
        ], $pesan);

        $data = $request->all();
        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $files = Multipleuploads::where('ref_table', 'pelanggan')
                               ->where('ref_id', $id)
                               ->get();
        
        return view('admin.pelanggan.show', compact('pelanggan', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pesan = [
            'first_name.required' => 'First name wajib diisi.',
            'last_name.required'  => 'Last name wajib diisi.',
            'birthday.required'   => 'Birthday wajib diisi.',
            'birthday.date'       => 'Birthday harus berupa tanggal yang valid.',
            'gender.required'     => 'Gender wajib diisi.',
            'gender.in'           => 'Gender hanya boleh diisi dengan Male, Female, atau Other.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Email harus berupa alamat email yang valid.',
            'email.unique'        => 'Email sudah digunakan.',
            'phone.required'      => 'Phone wajib diisi.',
        ];

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'birthday'   => 'required|date',
            'gender'     => 'required|in:Male,Female,Other',
            'email'      => 'required|email|unique:pelanggan,email,' . $id . ',pelanggan_id',
            'phone'      => 'required|string|max:20',
        ], $pesan);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        
        // Hapus file-file yang terkait dengan pelanggan
        $files = Multipleuploads::where('ref_table', 'pelanggan')
                               ->where('ref_id', $id)
                               ->get();
        
        foreach ($files as $file) {
            // Delete file from storage
            $filePath = public_path('storage/multiple_uploads/'.$file->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $file->delete();
        }
        
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus');
    }
}