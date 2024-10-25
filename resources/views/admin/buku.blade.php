<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Buku</title>
</head>
    <style>
        /* Custom styling for better UI/UX */
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-nav .nav-link {
            font-size: 18px;
            font-weight: 500;
            margin-right: 30px;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
        }
        .form-control {
            padding: 10px 15px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #e9ecef;
        }
        .table thead th {
            text-align: center;
        }
        .btn {
            border-radius: 5px;
            padding: 5px 15px;
        }
        /* Center content in the specific columns */
        .text-center {
            text-align: center;
        }
        .image-center {
            display: flex;
            justify-content: center;
        }
    </style>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Keamanan Sistem Informasi</a>
        </div>
    </nav>

    <!-- Selamat Datang dan Logout -->
    <div class="container">
        <div class="row mt-3 align-items-center">
            <div class="col">
                <h4 class="text-secondary">Selamat Datang, {{ Auth::user()->name }}</h4>
            </div>
            <div class="col text-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-light bg-danger text-white">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Navbar Kedua (Navigasi) -->
    <div class="container mt-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.buku')}}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.peminjaman')}}">Peminjaman</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="container mt-3">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::get('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    
    <div class="row mt-4">
        <div class="col"></div>
        <div class="col-6">
            <form action="{{ route('admin.buku') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="search" name="search" class="form-control rounded" placeholder="Cari nama buku"aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">search</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
    
    <div class="row mt-5">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col-2">
            <a class="btn btn-success" href="{{route('admin.tambahBuku') }}" style="text-decoration: none; margin-left:30px">Tambah Data+</a>
        </div>
    </div>
    
    <table class="table" style="margin-top: 10px">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Gambar</th>
                <th scope="col" class="text-center">Kode Buku</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Penulis</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($data as $index => $buku)
            <tr>
                <td scope="row" class="text-center">{{ $index + $data->firstItem()}}</td>
                <td class="text-center image-center">
                    <img style="width: 50px" src="{{ asset('/images/' . $buku->gambar) }}" alt="cover buku">
                </td>
                <td class="text-center">{{ $buku->kode_buku }}</td>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td>{{ $buku->kategori }}</td>
                <td>{{ $buku->tahun_terbit }}</td>
                <td>
                    <a class="btn btn-outline-warning" href="/admin/editBuku/{{ $buku->id }}">Edit</a>
                    <a class="btn btn-outline-danger" href="/admin/deleteBuku/{{ $buku->id }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table><br>
    
    {{ $data->links() }}
    </div><br><br><br>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
