<style>
    #col-right {
        top: 0;
        right: 0;
        background-image: url('{{ asset("/assets/ellipse.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .button-main {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 30px;
        padding-right: 30px;
        background: #3079A3;
        border-radius: 40px;
        color: #fff;
        text-decoration: none;
    }

    .card-menu {
        background-color: #3079A3;
        border-radius: 20px;
    }
</style>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="{{ asset('/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/datatables/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="font-family: 'Inter', sans-serif;">
    <img class="fixed-bottom" src=" {{ asset('/assets/vector_main.png') }}" alt="" style="height:70px; width: 100%;">
    <div class=" container" style="margin-top: 10rem; margin-bottom:3rem">
        <div class="mb-3 d-flex">
            <a href="{{ route('home') }}" class="btn btn-warning">Kembali</a>
            <a href="{{ route('riwayat.export') }}" class="btn btn-primary ms-2">Export</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Data Riwayat Perjalanan</h5>
            </div>
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                        <th>No.</th>
                        <th>Petugas Input</th>
                        <th>Petugas Submit</th>
                        <th>Tanggal</th>
                        <th>Jenis Kendaraan</th>
                        <th>No Pol/Bod</th>
                        <th>Nama Driver</th>
                        <th>Jumlah Penumpang</th>
                        <th>Foto</th>
                        <th>Waktu Pos 1</th>
                        <th>Waktu Pos 9</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($perjalanan as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->petugas_input }}</td>
                            <td>{{ $row->petugas_submit }}</td>
                            <td>{{ date('d-m-Y',strtotime($row->tanggal)) }}</td>
                            <td>{{ $row->jenis }}</td>
                            <td>{{ $row->nopol }}</td>
                            <td>{{ $row->driver }}</td>
                            <td>{{ $row->penumpang }}</td>
                            <td><a href="{{ asset($row->foto) }}" target="_blank"><img src="{{ asset($row->foto) }}"
                                        width="100px" alt=""></a></td>
                            <td>{{ $row->pos1 }}</td>
                            <td>{{ $row->pos9 }}</td>
                            <td>
                                @if ($row->selisih > 22)
                                <span class="text-success">Kecepatan normal dan baik</span>
                                @elseif ($row->selisih == 22)
                                <span class="text-success">Kecepatan normal </span>
                                @else
                                <span class="text-danger">Kecepatan diatas standar yang telah ditetapkan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src=" {{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/datatables/responsive.bootstrap5.min.css') }}"></script>

    <script>
        $('#datatable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "cari",
                sSearch: ""
            }
        });
    </script>
</body>

</html>