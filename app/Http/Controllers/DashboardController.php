<?php

namespace App\Http\Controllers;

use App\Models\MenuMakanan;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function homeView()
    {
        return view('components.dashboard.home');
    }

    public function listMenuView()
    {
        return view('components.dashboard.list-menu', [
            'menu' => MenuMakanan::get()
        ]);
    }

    public function addMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_menu' => 'required|string',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $sessionFolder = session()->get('folder');
        $sessionFilename = session()->get('filename');

        // temporary file
        $temporaryFile = TemporaryFile::where('folder', $sessionFolder)->first();
        $foto = $temporaryFile->filename;

        MenuMakanan::create([
            'user_id' => Auth::user()->id,
            'nama_menu' => $request->input('nama_menu'),
            'harga' => $request->input('harga'),
            'kategori' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $foto,
        ]);

        // delete temporary file
        $temporaryFile->delete();

        return response()->json([
            'status' => '00',
            'message' => 'Menu berhasil ditambahkan'
        ], 200);
    }

    public function uploadFoto(Request $request)
    {
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = $foto->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $path = $foto->move(public_path('foto-makanan'), $filename);

            session()->put('folder', $folder);
            session()->put('filename', $filename);

            TemporaryFile::create([
                'filename' => $filename,
                'folder' => $folder
            ]);

            return response()->json([
                'status' => '00',
                'message' => 'Foto berhasil diupload',
                'data' => ['foto' => $path]
            ], 200);
        }
    }

    public function deleteFoto(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'filename' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $filename = $request->input('filename');
        $filepath = public_path('foto/' . $filename); #

        // Cek apakah file ada
        if (file_exists($filepath)) {
            // Hapus file
            if (unlink($filepath)) {
                return response()->json([
                    'status' => '00',
                    'message' => 'Foto berhasil dihapus'
                ], 200);
            } else {
                return response()->json([
                    'status' => '02',
                    'message' => 'Gagal menghapus foto'
                ], 500);
            }
        } else {
            return response()->json([
                'status' => '03',
                'message' => 'File tidak ditemukan'
            ], 404);
        }
    }
}
