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
        border: 0;
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
        <a href="{{ route('home') }}" class="btn btn-warning">Kembali</a>
        <div class="mt-4 row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Input Perjalanan</h5>
                    </div>
                    <div class="card-body">
                        <form id="forminput" class="m-0 p-0">
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Petugas</label>
                                <div class="col-lg-7">
                                    <input type="text" name="petugas" id="petugas" value="{{ Auth::user()->nama }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Tanggal</label>
                                <div class="col-lg-7">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Jenis Kendaraan</label>
                                <div class="col-lg-7">
                                    <select name="jenis" id="jenis" class="form-select" required>
                                        <option value="">-Pilih-</option>
                                        <option value="Mobil Umum">Mobil Umum</option>
                                        <option value="Mobil Perusahaan">Mobil Perusahaan</option>
                                        <option value="Ambulance">Ambulance</option>
                                        <option value="Kendaraan Berat">Kendaraan Berat</option>
                                        <option value="Motor">Motor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">NoPol/Bod</label>
                                <div class="col-lg-7">
                                    <input type="text" name="nopol" id="nopol" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Nama Driver</label>
                                <div class="col-lg-7">
                                    <input type="text" name="driver" id="driver" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Jumlah Penumpang</label>
                                <div class="col-lg-7">
                                    <input type="number" name="penumpang" id="penumpang" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="col-lg-5">Foto</label>
                                <div class="col-lg-7">
                                    <input type="file" name="foto" id="foto" class="form-control"
                                        accept=".png, .jpg, .jpeg" required>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button id="btnadd" type="submit" class="button-main text-end">Kirim</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Perjalanan Sedang Proses</h5>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                                <th>No.</th>
                                <th>Petugas</th>
                                <th>Tanggal</th>
                                <th>Jenis Kendaraan</th>
                                <th>Nopol</th>
                                <th>Driver</th>
                                <th>Jumlah Penumpang</th>
                                @if (Auth::user()->role == '2')
                                <th>Waktu Pos 1</th>
                                @else
                                <th>Waktu Pos 9</th>
                                @endif
                                <th>Foto</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($perjalanan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->tanggal }}</td>
                                    <td>{{ $row->jenis }}</td>
                                    <td>{{ $row->nopol }}</td>
                                    <td>{{ $row->driver }}</td>
                                    <td>{{ $row->penumpang }}</td>
                                    @if (Auth::user()->role == '2')
                                    <td>{{ $row->pos1 }}</td>
                                    @else
                                    <td>{{ $row->pos9 }}</td>
                                    @endif
                                    <td><a href="{{ asset($row->foto) }}" target="_blank"><img
                                                src="{{ asset($row->foto) }}" width="100px" alt=""></a></td>
                                    <td>
                                        <a href="javascript:;" onclick="editData('{{ $row->id_perjalanan }}')"
                                            class="btn btn-warning btn-sm text-light">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formedit">
                    <input type="hidden" name="id" id="idedit">
                    <div class="modal-body">
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Petugas</label>
                            <div class="col-lg-7">
                                <input type="text" name="petugas" id="petugasedit" value="{{ Auth::user()->nama }}"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Tanggal</label>
                            <div class="col-lg-7">
                                <input type="date" name="tanggal" id="tanggaledit" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Jenis Kendaraam</label>
                            <div class="col-lg-7">
                                <select name="jenis" id="jenisedit" class="form-select" required>
                                    <option value="">-Pilih-</option>
                                    <option value="Mobil Umum">Mobil Umum</option>
                                    <option value="Mobil Perusahaan">Mobil Perusahaan</option>
                                    <option value="Ambulance">Ambulance</option>
                                    <option value="Kendaraan Berat">Kendaraan Berat</option>
                                    <option value="Motor">Motor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">NoPol/Bod</label>
                            <div class="col-lg-7">
                                <input type="text" name="nopol" id="nopoledit" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Nama Driver</label>
                            <div class="col-lg-7">
                                <input type="text" name="driver" id="driveredit" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Jumlah Penumpang</label>
                            <div class="col-lg-7">
                                <input type="number" name="penumpang" id="penumpangedit" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="col-lg-5">Foto</label>
                            <div class="col-lg-7">
                                <input type="file" name="foto" id="foto" class="form-control"
                                    accept=".png, .jpg, .jpeg">
                                <span class="text-muted" style="font-size:12px">*Kosongkan bila tidak ingin memperbarui
                                    foto</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--End Modal edit-->

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

        $("#forminput").submit(function(e) {
            $("#btnadd").prop('disabled', true);
            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('perjalanan.add_input') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btnadd").prop('disabled', false);
                    if (response.status == "1") {
                        swal.fire({
                            icon: "success",
                            title: 'Berhasil',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 900);
                    }else{
                        swal.fire({
                            icon: "error",
                            title: 'Gagal !',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                    }
                },
                error: function(response) {
                    $("#btnadd").prop('disabled', false);
                    swal.fire({
                            icon: "error",
                            title: 'Gagal',
                            text: "Ada kesalahan pada kode!",
                            showConfirmButton: true,
                            timer: 900
                        });
                }
            });
            e.preventDefault();
        });

        function editData(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ route('perjalanan.detail') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.perjalanan[0];
                        $("#idedit").val(id);
                        $("#tanggaledit").val(data.tanggal);
                        $("#jenisedit").val(data.jenis).change();
                        $("#nopoledit").val(data.nopol);
                        $("#driveredit").val(data.driver);
                        $("#penumpangedit").val(data.penumpang);
                        $('#modal_edit').modal('show');
                    }  else {
                        Swal.fire("Oops!", "Try Again!", "error");
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    swal.fire(
                        'Error',
                        'SQL Error Inserting Data',
                        'error'
                    )
                }
            });
        }

        $("#formedit").submit(function(e) {
            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('perjalanan.edit_input') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    if (response.status == "1") {
                        swal.fire({
                            icon: "success",
                            title: 'Berhasil',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 900);
                    }else{
                        swal.fire({
                            icon: "error",
                            title: 'Gagal !',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                    }
                },
                error: function(response) {
                    swal.fire({
                            icon: "error",
                            title: 'Gagal',
                            text: "Ada kesalahan pada kode!",
                            showConfirmButton: true,
                            timer: 900
                        });
                }
            });
            e.preventDefault();
        });
    </script>
</body>

</html>