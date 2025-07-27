<!DOCTYPE html>
<html>

<head>

    @include('includes.auth.meta')

    <title> Koperasi Simpan Pinjam | Login</title>

    @include('includes.auth.style')

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="login-logo">
            <img src="{{ asset('logo/logo-koperasi.png') }}" alt="" width="100px">
        </div>

        <div class="login-box-body">

            <p class="text-center"><span style="font-size: 16pt ; font-weight: bold;">KOPERASI SIMPAN PINJAM</span> </p>

            <form action="{{ route('proses-login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <label for="username" style="font-size: 10pt">USERNAME <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username"
                        class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                    <span class="glyphicon glyphicon-user form-control-feedback "></span>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <label for="password" style="font-size: 10pt">PASSWORD <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password')
                        is-invalid
                        @enderror"
                        placeholder="********">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <!-- Alert untuk error -->
                    @if (session('error'))
                        <div class="alert alert-danger ">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
                    </div>
                </div>

            </form>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    @include('includes.auth.script')
</body>

</html>
