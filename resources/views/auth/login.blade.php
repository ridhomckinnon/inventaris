<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <title>Login</title>
</head>
<body>

<div class="login container-fluid" style="height: 100vh;">
    <div class="row">
        <div class="col-md-6 bg-white" style="height: 100vh;">
            <div class="row justify-content-center align-content-center flex-wrap">
                <div class="logo ">
                    <img src="dist/img/logo.jpeg" alt="">
                </div>
                <div class="info text-center mt-5">
                    <h2 class="my-5">UD.ILHAM PILLY Beff Merchant </br> KOTA MEDAN</h2>
                    <p>Pasar Simpang Limun Medan, Jl.M.Nawi Harahap (Jl.Seksama )Sitirejo III</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg-light" style="height: 100vh;">
            <div class="row justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-8">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login.perform') }}">
                                @csrf

                                @include('template.messages')
                                <div class="form-group">
                                    <label for="">Username atau email</label>
                                    <input type="text" name="username" class="form-control">
                                    @if ($errors->has('username'))
                                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
