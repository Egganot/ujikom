@extends('components.app')
@section('title', 'Register Page')
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Retype password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-map-marker-alt"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota Asal">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-building"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="telepon" id="telepon" placeholder="No Telepon">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-phone"></span>
                            </div>
                          </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-1">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                </div>
                            </div>
                            <div class="col-10">
                                <label for="remember">
                                    Saya Setuju Seluruh <a href="{{ route('error.cant') }}">Syarat</a> dan <a href="{{ route('error.cant') }}">Ketentuan</a> yang berlaku
                                </label>
                            </div>
                        </div> --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </form>

                    <p class="mb-0">
                        <a href="{{ route('login.index') }}" class="text-center">Sudah Punya Akun? klik disini untuk login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
