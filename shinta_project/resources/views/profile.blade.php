<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shinta Belajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #48D1CC;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .logo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            position: absolute;
            top: -150px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 600px;
            position: relative;
            margin-top: 50px;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
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