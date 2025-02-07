<!DOCTYPE html>
<html lang="id">
<head>
    <!-- mendefinisikan charset sebagai utf-8 untuk mendukung karakter indonesia -->
    <meta charset="UTF-8">
    <!-- mengatur viewport agar responsif di perangkat mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shinta Belajar</title>
    <style>
        /* gaya untuk elemen body */
        body {
            font-family: Arial, sans-serif; /* jenis font yang digunakan */
            display: flex; /* menggunakan flexbox untuk tata letak */
            justify-content: center; /* mengatur agar konten berada di tengah secara horizontal */
            align-items: center; /* mengatur agar konten berada di tengah secara vertikal */
            height: 100vh; /* tinggi body mengisi seluruh viewport */
            background-color: #48D1CC; /* warna latar belakang tubuh */
        }
        /* gaya untuk container */
        .container {
            display: flex; /* menggunakan flexbox untuk tata letak */
            flex-direction: column; /* mengatur konten di dalam container secara vertikal */
            align-items: center; /* menyelaraskan konten secara horizontal di tengah */
            position: relative; /* menambahkan posisi relatif agar elemen lain bisa diposisikan berdasarkan ini */
        }
        /* gaya untuk logo */
        .logo {
            width: 150px; /* lebar logo */
            height: 150px; /* tinggi logo */
            object-fit: cover; /* memastikan logo tidak terdistorsi */
            position: absolute; /* logo diposisikan secara absolut */
            top: -150px; /* menggeser logo ke atas agar tidak menutupi konten */
        }
        /* gaya untuk card */
        .card {
            background: white; /* latar belakang */
            padding: 20px; /*jarak di dalam card */
            border-radius: 10px; /* sudut card*/
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* bayangan card */
            text-align: center; /* teks di dalam card agar di tengah*/
            max-width: 600px; /* lebar maksimal card */
            position: relative; /* posisi card relatif terhadap elemen lainnya */
            margin-top: 50px; /*jarak antara card dan logo */
        }
        /* gaya untuk judul (h2) */
        h2 {
            color: #333; /* warna teks judul */
        }
        /* gaya untuk paragraf (p) */
        p {
            font-size: 18px; /* ukuran font */
            margin: 10px 0; /* jarak atas dan bawah */
            color: #555; /* warna teks */
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
        <div class="card">
            <h2>Belajar Dasar Routing dan Route Parameter</h2>
            <p><strong>Nama: </strong> {{ $nama }}</p>
            <p><strong>NIM : </strong> {{ $nim }}</p>
            <p><strong>Prodi :</strong> {{ $prodi }}</p>
        </div>
    </div>
</body>
</html>
