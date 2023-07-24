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
            <a href="javascript:;" class="btn btn-primary ms-2" data-bs-toggle="modal"
                data-bs-target="#modal_add">Tambah
                Data</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Data Pengguna</h5>
            </div>
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($user as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->username }}</td>
                            <td>{{ get_role($row->role) }}</td>
                            <td class="text-nowrap" style="width:15%">
                                <a href="javascript:;" onclick="editData('{{ $row->id_user }}')"
                                    class="btn btn-warning btn-sm text-light">Edit</a>
                                <a href="javascript:;" onclick="deleteData('{{ $row->id_user }}')"
                                    class="btn btn-danger btn-sm ms-1">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal add-->
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formadd">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" id="namaadd" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" name="username" id="usernameadd" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="text" name="password" id="passwordadd" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select name="role" required class="form-select" id="roleadd">
                                <option value="">-Pilih-</option>
                                <option value="1">{{ get_role('1') }}</option>
                                <option value="2">{{ get_role('2') }}</option>
                                <option value="3">{{ get_role('3') }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="btnadd" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--End Modal add-->

    <!-- Modal edit-->
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formedit">
                    <input type="hidden" name="id" id="idedit">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" id="namaedit" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Username</label>
                            <input type="text" name="username" id="usernameedit" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="text" name="password" id="passwordedit" class="form-control" value="">
                            <span class="text-muted" style="font-size:12px">*Kosongkan bila tidak ingin memperbarui
                                password</span>
                        </div>
                        <div class="form-group mb-3">
                            <label>Role</label>
                            <select name="role" required class="form-select" id="roleedit">
                                <option value="1">{{ get_role('1') }}</option>
                                <option value="2">{{ get_role('2') }}</option>
                                <option value="3">{{ get_role('3') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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

        $("#formadd").submit(function(e) {
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
                url: "{{ route('user-management.add') }}",
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
                url: "{{ route('user-management.detail') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status == "1") {
                        data = response.user[0];
                        $("#idedit").val(id);
                        $("#namaedit").val(data.nama);
                        $("#usernameedit").val(data.username);
                        $("#roleedit").val(data.role).change();
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
            $("#btnedit").prop('disabled', true);
            const formdata = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ route('user-management.edit') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btnedit").prop('disabled', false);
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
                    $("#btnedit").prop('disabled', false);
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

        function deleteData(id) {
        swal.fire({
            title: 'Apakah anda yakin??',
            text: "Anda tidak dapat mengembalikan data ini !!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonClass: 'btn btn-danger me-3',
            cancelButtonClass: 'btn btn-secondary',
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('user-management.delete') }}",
                    data: 'id=' + id,
                    success: function(response) {
                        if (response.status == "1") {
                            swal.fire({
                                icon: "success",
                                title: 'Berhasil',
                                text: response.msg,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal.fire("Error!", response.msg, "error");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        swal.fire('Error', 'SQL Error Inserting Data', 'error')
                    }
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                );
            }
        });
    }
    </script>
</body>

</html>