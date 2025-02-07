<?php
    // mengimpor kelas Route dari Laravel untuk mendefinisikan rute aplikasi
    use Illuminate\Support\Facades\Route;

    // mendefinisikan rute untuk URL '/' (root) dengan metode GET
    Route::get('/', function () {
        return view ('Welcome');
    });
    route::get('/foo', function () {
        return 'hello word';
    });
    route::get('user/{id}', function ($id) {
        return 'user '.$id;
    });
Route::get('/user', 'UserController@index');
//Route::get ('/user', [UserController::class,'index']);



            // mengembalikan view 'profile'
        // return view('profile', [
        //     'nama'  =>  ' Shinta Maria',
        //     'nim' => '  E41231404',
        //     'prodi' => 'Teknik Informatika'
        // ]);
    
