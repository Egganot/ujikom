@extends('components.app')
@section('title', 'Login Page')
@section('konten')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ Route('landing.index') }}" class="text-center">
                        <img src="{{ asset('assets/img/Logo/Logo1.png') }}" class="card-img-top" alt="Logo-apk">
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ old('email') }}" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Mohon Ingat Saya
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </form>

                    {{-- <p class="mb-1">
                        <a href="{{ route('error.cant') }}">Lupa Password Klik Disini</a>
                    </p> --}}
                    <br>
                    <p class="mb-0">
                        <a href="{{ route('register.index') }}" class="text-center"> Belum Punya Akun? Daftar sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
