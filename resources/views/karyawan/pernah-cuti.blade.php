<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan Pernah Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    @include('navbar')

    @if (session()->has('success'))
    <div class="w-50 alert alert-success alert-dismissible col-lg-4 m-auto" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <table class="table caption-top">
                    <caption>Daftar Karyawan yang Pernah Cuti</caption>
                    <thead>
                        <tr>
                            <th scope="col">Nomor Induk</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah Cuti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use Carbon\Carbon;
                        ?>
                        @forelse ($karyawans as $item)
                        <tr>
                            <td>{{ $item->nomor_induk }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->cutis_count }} kali</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger fw-bold fs-4">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>