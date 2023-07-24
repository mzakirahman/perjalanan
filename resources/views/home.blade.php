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
    <title>{{ $title }}</title>
</head>

<body style="font-family: 'Inter', sans-serif;">
    <img class="fixed-bottom" src=" {{ asset('/assets/vector_main.png') }}" alt="" style="height:70px; width: 100%;">
    <div class=" container" style="margin-top: 10rem; margin-bottom:3rem">
        <div class="row">
            <?php if(Auth::user()->role != '1'){ ?>
            <div class="col-md-4 mb-3">
                <a href="{{ route('perjalanan.input') }}" style="text-decoration: none">
                    <div class="card-menu shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('/assets/ic_input.png') }}" width="100%" height="250px" alt="">
                        </div>
                    </div>
                    <p class="text-center fw-bold text-dark" style="font-size: 20px">Input Data Perjalanan</p>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('perjalanan.terima') }}" style="text-decoration: none">
                    <div class="card-menu shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('/assets/ic_terima.png') }}" width="100%" height="250px" alt="">
                        </div>
                    </div>
                    <p class="text-center fw-bold text-dark" style="font-size: 20px">Terima Data Perjalanan</p>
                </a>
            </div>
            <?php } ?>
            <?php if(Auth::user()->role == '1'){ ?>
            <div class="col-md-4 mb-3">
                <a href="{{ route('riwayat') }}" style="text-decoration: none">
                    <div class="card-menu shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('/assets/ic_riwayat.png') }}" width="100%" height="250px" alt="">
                        </div>
                    </div>
                    <p class="text-center fw-bold text-dark" style="font-size: 20px">Riwayat Perjalanan</p>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('user-management') }}" style="text-decoration: none">
                    <div class="card-menu shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('/assets/ic_user.png') }}" width="100%" height="250px" alt="">
                        </div>
                    </div>
                    <p class="text-center fw-bold text-dark" style="font-size: 20px">Kelola Pengguna</p>
                </a>
            </div>
            <?php } ?>
            <div class="col-md-4 mb-3">
                <a href="{{ route('logout') }}" style="text-decoration: none">
                    <div class="card-menu shadow-sm">
                        <div class="card-body">
                            <img src="{{ asset('/assets/ic_logout.png') }}" width="100%" height="250px" alt="">
                        </div>
                    </div>
                    <p class="text-center fw-bold text-dark" style="font-size: 20px">Logout</p>
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src=" {{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
</body>

</html>