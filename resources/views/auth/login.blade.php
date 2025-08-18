<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.auth.meta')

    <title>Koperasi Simpan Pinjam | Login</title>

    @include('includes.auth.style')
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        {{-- Logo --}}
        <div class="login-logo">
            <img src="{{ asset('logo/logo-koperasi.png') }}" alt="Logo Koperasi" width="100px">
        </div>

        {{-- Box Body --}}
        <div class="login-box-body">
            <p class="text-center">
                <span style="font-size: 16pt; font-weight: bold;">KOPERASI SIMPAN PINJAM</span>
            </p>

            {{-- Form Login --}}
            <form action="{{ route('proses-login') }}" method="POST">
                @csrf

                {{-- Username --}}
                <div class="form-group has-feedback">
                    <label for="username" style="font-size: 10pt">
                        USERNAME <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="username" 
                           id="username"
                           class="form-control @error('username') is-invalid @enderror"
                           placeholder="Masukkan Username"
                           value="{{ old('username') }}"
                           required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @error('username')
                        <span class="help-block text-danger">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group has-feedback">
                    <label for="password" style="font-size: 10pt">
                        PASSWORD <span class="text-danger">*</span>
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="********"
                           required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @error('password')
                        <span class="help-block text-danger">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>

                {{-- Error dari Session --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                {{-- Tombol Login --}}
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            LOGIN
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    @include('includes.auth.script')
</body>
</html>
