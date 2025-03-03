<?php
    // mengimpor kelas Route dari Laravel untuk mendefinisikan rute aplikasi
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\ManagementUserController;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\backend\PengalamanKerjaController;
    use App\Http\Controllers\backend\DashboardController;
    use App\Http\Controllers\backend\PenddikanController;
    use App\Http\Controllers\SessionController;
    use App\Http\Controllers\PegawaiController;
    use App\Http\Controllers\CobaController;

    // ACARA 3

    // mendefinisikan rute untuk URL '/' (root) dengan metode GET
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/foo', function () {
        return 'hello world';
    });

    Route::get('user/{id}', function ($id) {
        return 'user ' . $id;
    });

    //Route::get('/user', 'UserController@index');
    Route::get('/user', [UserController::class, 'index']);

    // Route::get($uri, $callback);
    // Route::post($uri, $callback);
    // Route::put($uri, $callback);
    // Route::patch($uri, $callback);
    // Route::delete($uri, $callback);
    // Route::options($uri, $callback);

    Route::redirect('/coba', '/sini');

    Route::get('/profile', function () {
        return view('profile', [
            'nama'  => 'Shinta Maria',
            'nim'   => 'E41231404',
            'prodi' => 'Teknik Informatika'
        ]);
    });

    Route::get('/userrr/{name?}', function ($name = null) {
        return $name ? "Hello, $name!" : "Hello, Guest!";
    });

    Route::get('/users/{name?}', function ($name = 'shinta') {
        return "Hello, $name!";
    });

    Route::get('user1/{name}', function ($name) {
        return "Hello, $name!";
    })->where('name', '[A-Za-z]+');

    Route::get('user2/{id}', function ($id) {
        return "User ID: $id";
    })->where('id', '[0-9]+');

    Route::get('user3/{id}/{name}', function ($id, $name) {
        return "User ID: $id, Name: $name";
    })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    Route::get('user4/{id}', function ($id) {
        return "User ID: $id"; // Only executed if {id} is numeric
    });

    Route::get('search/{search}', function ($search) {
        return $search;
    })->where('search', '.*');

    Route::get('user5/profile', function () {
        return "Ini adalah halaman profil user 5.";
    })->name('profile.user5');

    Route::get('user6/profile', [UserController::class, 'show'])->name('profile.user6');

    // ACARA 4

    // generate route ke route bersama
    Route::get('/user7/{id}/profile', function ($id) {
        return view('profile', ['id' => $id]);
    })->name('profile');

    Route::get('/redirect-profile', function () {
        return redirect()->route('profile', ['id' => 1]);
    });

    // ACARA 5

    // memeriksa rute saat ini
    Route::get('/user8/{id}/profile', function ($id) {
        return view('profile', ['id' => $id]);
    })->name('profile');

    // Middleware
    // Route::middleware(['first', 'second'])->group(function () {
    //     Route::get('/', function () {
    //         //
    //     });      

    //     Route::get('user9/profile', function () {
    //         //
    //     });
    // });

    // subdomain routing
    Route::domain('{account}.myapp.com')->group(function () {
        Route::get('user10/{id}', function ($account, $id) {
            //
        });
    });

    // route prefixes
    Route::domain('{account}.myapp.com')->group(function () {
        Route::get('user11', function () {
            //
        });
    });

    // route name prefixes
    Route::name('admin.')->group(function () {
        Route::get('users', function () {
            //
        })->name('users');
    });

    // Route::post('/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::match(['get', 'post'], '/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/user12', [ManagementUserController::class, 'index']);

    Route::resource('/user13', ManagementUserController::class);

    //ACARA 6
    Route::get("/home", function() {
        return view("home");
    });
    // Route::get('/home', [ManagementUserController::class, 'index']);
    
    //ACARA 7
    Route::group(['namespace'=>'App\Http\Controllers\frontend'],function()
    {
        Route::resource('/home',HomeController::class);
    });

    //ACARA 8
    Route::group(['namespace'=>'App\Http\Controllers\backend'],function()
    {
        Route::resource('/dashboard',DashboardController::class);
    });
Auth::routes();

Route::get('/home', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('home');
Route::post('/home', [App\Http\Controllers\LoginController::class, 'home']);

    //ACARA 13-16
    Route::group(['namespace' => 'App\Http\Controllers\backend'], function()  
{  
    Route::resource('/dashboard', DashboardController::class);  
    Route::resource('/pendidikan', PendidikanController::class);  
    Route::resource('/pengalaman_kerja', PengalamanKerjaController::class);  
});

// Route::group(['namespace'=>'App\Http\Controllers\backend'],function()
//     {
//         Route::resource('/pengalaman',PengalamanKerjaController::class);
//     });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    Route::get('/pengalaman-kerja', [PengalamanKerjaController::class, 'index'])->name('pengalaman_kerja.index');


// ACARA 17-18
Route::get('session/create', [SessionController::class, 'create']);

Route::get('session/show', [SessionController::class, 'show']);

Route::get('session/delete', [SessionController::class, 'delete']);

Route::get('/pegawai/{shinta}', [PegawaiController::class, 'index']);

Route::get('/formulir', [PegawaiController::class, 'formulir']);

Route::post('/formulir/proses', [PegawaiController::class, 'proses']);

//ACARA 19
Route::get('/cobaerror', [CobaController::class, 'index']);