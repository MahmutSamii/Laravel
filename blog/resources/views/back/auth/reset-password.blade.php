<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Giriş - Şifremi Unuttum</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('back/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('back/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        .fa-eye {
            float: right;
            margin-top: -25px;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }
    </style>

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Şifremi Yenile</h1>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger">{{$errors->first()}}</div>
                                @endif
                                @if(Session::has('mesaj'))

                                    <div class="alert alert-success">
                                        {{ Session::get('mesaj') }}
                                    </div>

                                @endif
                                <form method="post" class="user" action="{{route('admin.forgotPassword.email.post',$id)}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" autocomplete="current-password" required="" id="id_password">
                                        <i class="far fa-eye" id="togglePassword"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Değiştir</button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
<!-- Bootstrap core JavaScript-->
<script src="{{asset('back/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('back/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('back/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
