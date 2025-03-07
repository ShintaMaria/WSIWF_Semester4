<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // menampilkan informasi file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';
        echo 'File Size: ' . $file->getSize() . '<br>';
        echo 'File Mime Type: ' . $file->getMimeType() . '<br>';

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = public_path('data_file');

        // cek jika folder tidak ada, maka buat foldernya
        if (!File::isDirectory($tujuan_upload)) {
            File::makeDirectory($tujuan_upload, 0777, true);
        }

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }

    public function resize_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image', // validasi agar hanya menerima file gambar
            'keterangan' => 'required',
        ]);

        // tentukan path lokasi upload
        $path = public_path('images');

        // jika folder belum ada, buat folder
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // mengambil file image dari form
        $file = $request->file('file');

        // membuat nama file dari gabungan tanggal dan unique ID
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // membuat canvas sebesar dimensi 200x200
        $canvas = Image::canvas(200, 200);

        // resize image sesuai dimensi dengan mempertahankan rasio
        $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        // memasukkan image yang telah di-resize ke dalam canvas
        $canvas->insert($resizeImage, 'center');

        // simpan image ke folder
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect(route('upload'))->with('error', 'Data gagal ditambahkan!');
        }
    }
}
