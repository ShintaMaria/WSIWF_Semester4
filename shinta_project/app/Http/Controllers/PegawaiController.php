<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PegawaiController extends Controller
{
    public function index($shinta) {
        return $shinta;
    }

    // Menampilkan halaman form
    public function formulir() {
        return view('formulir');
    }

    // Memproses data dari form
    public function proses(Request $request) {
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');

        return "Nama : " . $nama . ", Alamat : " . $alamat;
    }

}
