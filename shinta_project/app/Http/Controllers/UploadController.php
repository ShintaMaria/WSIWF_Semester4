<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'keterangan' => 'required',
        ]);

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
    public function viewresize()
    {
        return view('upload_resize');
    }
    public function resize_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'keterangan' => 'required',
        ]);

        // Membuat instance ImageManager dengan driver GD
        $imageManager = new ImageManager(new Driver()); // Jika mau Imagick, ganti Driver() jadi Imagick\Driver()

        // Tentukan path lokasi upload
        $path = public_path('img/logo');

        // Jika folder belum ada, buat folder
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Ambil file dari form
        $file = $request->file('file');

        // Buat nama file unik
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Baca gambar dan resize
        $image = $imageManager->read($file->getRealPath());
        $resizedImage = $image->cover(200, 200);

        // Simpan gambar hasil resize
        file_put_contents($path . '/' . $fileName, $resizedImage->toJpeg());

        return redirect()->route('upload.resize.view')->with('success', 'Data berhasil ditambahkan!');
    }
        public function dropzone()
        {
            return view('dropzone'); 
        }

        public function dropzoneStore(Request $request)
        {
            if ($request->hasFile('file')) {
                $uploadedFiles = []; // Array untuk menyimpan nama file

                foreach ($request->file('file') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('img/dropzone'), $imageName);
                    $uploadedFiles[] = $imageName;
                }

                return response()->json(['success' => 'Files uploaded successfully', 'files' => $uploadedFiles]);
            }

            return response()->json(['error' => 'No files uploaded'], 400);
        }

            public function pdf_upload()
        {
            return view('pdf_upload');
        }

        public function pdf_store(Request $request)
        {
            // Pastikan ada file yang diunggah
            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'Tidak ada file yang diunggah'], 400);
            }

            $files = $request->file('file'); // Bisa berupa array atau file tunggal
            $uploadedFiles = [];
            $path = public_path('pdf/dropzone');

            // Cek apakah folder penyimpanan ada, jika tidak buat baru
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Jika banyak file dikirim, proses satu per satu
            if (is_array($files)) {
                foreach ($files as $file) {
                    $pdfName = 'pdf_' . time() . '_' . uniqid() . '.' . $file->extension();
                    $file->move($path, $pdfName);
                    $uploadedFiles[] = $pdfName;
                }
            } else { // Jika hanya satu file
                $pdfName = 'pdf_' . time() . '_' . uniqid() . '.' . $files->extension();
                $files->move($path, $pdfName);
                $uploadedFiles[] = $pdfName;
            }

            return response()->json(['success' => $uploadedFiles]);
        }

}
