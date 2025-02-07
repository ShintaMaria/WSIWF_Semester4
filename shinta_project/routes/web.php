<?php
    // mengimpor kelas Route dari Laravel untuk mendefinisikan rute aplikasi
    use Illuminate\Support\Facades\Route;

    // mendefinisikan rute untuk URL '/' (root) dengan metode GET
    Route::get('/', function () {
        // mengembalikan view 'profile'
        return view('profile', [
            'nama'  =>  ' Shinta Maria',
            'nim' => '  E41231404',
            'prodi' => 'Teknik Informatika'
        ]);
    });
