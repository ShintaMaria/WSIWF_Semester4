<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload File Dengan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Upload File Dengan Laravel</h2>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Menampilkan pesan sukses atau error --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Peringatan Jika Ada Error --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                        @endforeach
                    </div>
                @endif

                {{-- Form Upload --}}
                <form action="{{ route('upload.resize') }}" method="POST" enctype="multipart/form-data">

                    @csrf  {{-- CSRF Token Laravel --}}

                    <div class="form-group">
                        <label><b>File Gambar</b></label>
                        <input type="file" name="file" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label><b>Keterangan</b></label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
