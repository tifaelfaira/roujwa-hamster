<?php

namespace App\Http\Controllers;

use App\Models\Multipleuploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MultipleUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required',
            'filename.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
            'ref_table' => 'required',
            'ref_id' => 'required|integer'
        ]);

        try {
            if ($request->hasfile('filename')) { 
                $files = [];
                foreach ($request->file('filename') as $file) {
                    if ($file->isValid()) {
                        $filename = time() . '-' . uniqid() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                        
                        // Store file
                        $file->move(public_path('storage/multiple_uploads'), $filename);
                        
                        $files[] = [
                            'filename' => $filename,
                            'ref_table' => $request->ref_table,
                            'ref_id' => $request->ref_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
                
                if (!empty($files)) {
                    Multipleuploads::insert($files);
                    return back()->with('success', count($files) . ' file berhasil diupload!');
                }
            }
            
            return back()->with('error', 'Tidak ada file yang valid untuk diupload.');
            
        } catch (\Exception $e) {
            Log::error('Upload error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat upload file: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $file = Multipleuploads::findOrFail($id);
            $filename = $file->filename;
            
            // Delete file from storage
            $filePath = public_path('storage/multiple_uploads/'.$filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            $file->delete();
            
            return back()->with('success', 'File ' . $filename . ' berhasil dihapus!');
            
        } catch (\Exception $e) {
            Log::error('Delete file error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus file.');
        }
    }
}