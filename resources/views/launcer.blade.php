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
    <title>Pencatatan Perjalanan</title>
</head>

<body style="font-family: 'Inter', sans-serif;">
    <section class="vh-100 m-0 p-0">
        <div class="row m-0 p-0">
            <div class="col-xl-7 col-lg-6 col-md-12 col-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 vh-100 d-flex">
                        <div class="my-auto">
                            <h1>Keamanan Adalah Kunci Kenyamanan</h1>
                            <p>keberadaan Satuan Pengamanan menjadi unsur penting dalam mendukung performa sebuah perusahaan. 
                            Petugas Pengamanan yang umumnya disebut oleh banyak orang Security ini memiliki segudang tugas dan tanggung jawab.
                            Petugas keamanan bertugas dan bertanggung jawab untuk menjaga aset dan perlindungan keamanan dan keselamatan perusahaan 
                            serta karyawan di dalamnya.
                            </p>
                            <a href="{{ route('login') }}" class="button-main">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-12 col-12 vh-100 d-flex justify-content-center" id="col-right">
                <div class="mt-auto ">
                    <img src="{{ asset('/assets/ic_security.png') }}" alt="" width="100%">
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src=" {{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
</body>

</html>