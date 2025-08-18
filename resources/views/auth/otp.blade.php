<!DOCTYPE html>
<html>
<head>
    @include('includes.auth.meta')
    <title>Verifikasi OTP | Koperasi Simpan Pinjam</title>
    @include('includes.auth.style')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('logo/logo-koperasi.png') }}" alt="logo" width="100px">
        </div>

        <div class="login-box-body">
            <p class="text-center">
                <span style="font-size: 16pt; font-weight: bold;">VERIFIKASI OTP</span>
            </p>

            <form action="{{ route('otp.check') }}" method="post">
                @csrf

                <div class="form-group has-feedback">
                    <label for="otp" style="font-size: 10pt">Kode OTP <span class="text-danger">*</span></label>
                    <input type="text" name="otp" id="otp"
                        class="form-control @error('otp') is-invalid @enderror"
                        placeholder="Masukkan kode OTP" maxlength="6" autofocus>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @error('otp')
                        <span class="help-block">
                            <small class="text-danger">{{ $message }}</small>
                        </span>
                    @enderror
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Verifikasi</button>
                    </div>
                </div>
            </form>

            <div class="text-center" style="margin-top: 15px;">
                <form action="{{ route('resend.otp') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link">AMBIL OTP</button>
                </form>
            </div>
        </div>
    </div>

    @include('includes.auth.script')
</body>
</html>
