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
//Route::get('/user', 'UserController@index');
Route::get ('/user', [UserController::class,'index']);

    // Route::get($uri, $callback);
    // Route::post($uri, $callback);
    // Route::put($uri, $callback);
    // Route::patch($uri, $callback);
    // Route::delete($uri, $callback);
    // Route::options($uri, $callback);

    Route::redirect('/coba','/sini');

    Route::get('/profile', function () {
        return view('profile', [
            'nama'  => 'Shinta Maria',
            'nim'   => 'E41231404',
            'prodi' => 'Teknik Informatika'
        ]);
    });

    Route::get('/userrr/{name?}',function($name=null){
        return $name ? "Hello, $name!" : "Hello, Guest!";
    });

    Route::get('/users/{name?}',function($name='shinta'){
        return $name ? "Hello, $name!" : "Hello, Guest!";
    });
