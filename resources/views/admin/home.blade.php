<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Dashboard Admin</title>

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
        </style>
    </head>
    <body>
        <!-- Navbar Utama -->
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
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.buku')}}">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.peminjaman')}}">Peminjaman</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Pemberitahuan Session -->
        <div class="container mt-3">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <!-- Form Pencarian -->
        <div class="container mt-4">
            <div class="row">
                <div class="col"></div>
                <div class="col-6">
                    <form action="{{ route('admin.home') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" class="form-control rounded" placeholder="Cari nama admin" aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <!-- Tabel Data Admin -->
        <div class="container mt-5">
            <div class="row">
                <div class="col text-end">
                    <a class="btn btn-success" href="{{ route('admin.tambah') }}">Tambah Data +</a>
                </div>
            </div>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $index => $userAdmin)
                        <tr>
                            <td>{{ $index + $data->firstItem() }}</td>
                            <td>{{ $userAdmin->name }}</td>
                            <td>{{ $userAdmin->email }}</td>
                            <td>{{ $userAdmin->jenis_kelamin }}</td>
                            <td>{{ $userAdmin->level }}</td>
                            <td class="text-center">
                                <a class="btn btn-warning btn-sm" href="/editAdmin/{{ $userAdmin->id }}">Edit</a> 
                                <a class="btn btn-danger btn-sm" href="/deleteAdmin/" onclick="confirmDelete('{{ $userAdmin->id }}')"{{ $userAdmin->id }}>Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>

        <!-- Bootstrap JS with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            function confirmDelete(id) {
                // Menampilkan dialog konfirmasi
                if (confirm('Apakah Anda yakin ingin menghapus admin ini?')) {
                    // Jika pengguna mengkonfirmasi, redirect ke URL penghapusan
                    window.location.href = '/deleteAdmin/' + id;
                }
            }
        </script>
    </body>
</html>
