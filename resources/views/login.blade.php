<style>
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
    <title>Login</title>
</head>



<body style="font-family: 'Inter', sans-serif;">
    <section class="vh-100">

        <div class="vh-100 d-flex" style="position: relative; z-index: 2;">
            <div class="my-auto mx-auto text-center">
<img src=" {{ asset('/assets/nawakara.png') }}" alt="" style="width:150px;">
                <form action="{{ route('auth') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="floatingInput" placeholder="username" name="username" value="{{ old('username') }}"
                            style="width: 350px">
                        <label for="floatingInput">Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="floatingPassword" placeholder="Password" name="password" style="width: 350px">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <input type="submit" class="button-main mt-3" value="Login">
                </form>
            </div>
        </div>
        <img src=" {{ asset('/assets/ic_login.png') }}" alt=""
            style="position: absolute; right:0; bottom: 0; opacity: 0.4;">
        <img src="{{ asset('/assets/vector_login.png') }}" alt=""
            style="height:120px; width: 100%; position: absolute; bottom: 0">
    </section>
    <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('/alert/package/dist/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('/jquery/jquery.min.js') }}"></script>

    @if (session()->has('loginError'))
    <script>
        Swal.fire("Login Gagal", "{{ session('loginError') }}", "error");
    </script>
    @endif
    @if (session()->has('accessError'))
    <script>
        Swal.fire("Warning", "{{ session('accessError') }}", "error");
    </script>
    @endif
</body>

</html>