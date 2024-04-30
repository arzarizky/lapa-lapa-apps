@extends('layouts.app', [
    'title' => 'Profile',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile {{ auth()->user()->name }}</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hi, {{ auth()->user()->name }} !</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img id='preview-foto' class="rounded-circle profile-widget-picture"
                                src="{{ asset('storage/admin') }}/{{ auth()->user()->foto }}">
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ auth()->user()->name }}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> {{ auth()->user()->roles[0]->name }}
                                    {{ auth()->user()->kota->nama }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data"
                            action="{{ route('profile.update') }}">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Depan</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                            required="" readonly>
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Belakang</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->last_name }}"
                                            required="" readonly>
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{ auth()->user()->email }}"
                                            required="" name="email">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Kota</label>
                                        <input type="text" class="form-control"
                                            value="{{ auth()->user()->kota->nama }}" required="" readonly>
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label for="password" class="d-block">Password</label>
                                        <div class="input-group" id="show-hide-password">
                                            <input id="password" type="password" class="form-control pwstrength"
                                                placeholder="Masukan Password" data-indicator="pwindicator" name="password"
                                                required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"
                                                    style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; padding-top: 8px;">
                                                    <i class="fas fa-eye-slash"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Password
                                            </div>
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label for="password2" class="d-block">Konfirmasi Password</label>
                                        <div class="input-group" id="konfirmasi-show-hide-password">
                                            <input id="password2" type="password" placeholder="Masukan Konfirmasi Password"
                                                class="form-control" name="passwordsecond" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"
                                                    style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; padding-top: 8px;">
                                                    <i class="fas fa-eye-slash"></i></button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Password Yang Sama
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="label-foto">Foto</label>
                                        <div class="input-group" id="foto">
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input"
                                                    id="input-foto" required tabindex="3">
                                                <label class="custom-file-label" for="input-foto">Pilih Foto</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Foto
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



{{-- Untuk Masukan JS --}}
@push('js')

    <script src="{{ asset('template') }}/assets/js/page/auth-register.js"></script>
    @if (Session::has('error'))
        <script>
            iziToast.error({
                title: 'Title',
                message: '{{ Session::get('error') }}',
                position: 'topRight',
            });
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            iziToast.info({
                title: 'Title',
                message: '{{ Session::get('info') }}',
                position: 'topRight',
            });
        </script>
    @endif
    @if (Session::has('warning'))
        <script>
            iziToast.warning({
                title: 'Title',
                message: '{{ Session::get('warning') }}',
                position: 'topRight',
            });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            iziToast.success({
                title: 'Title',
                message: '{{ Session::get('success') }}',
                position: 'topRight',
            });
        </script>
    @endif


    {{-- Preview Foto Admin --}}
    <script>
        $('#input-foto').on('change', function() {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

        function readURLFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-foto').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#input-foto").change(function() {
            readURLFoto(this);
        });
    </script>



    {{-- Show Hide Konfirmasi Password --}}
    <script>
        $(document).ready(function() {
            $("#konfirmasi-show-hide-password button").on('click', function(event) {
                event.preventDefault();
                if ($('#konfirmasi-show-hide-password input').attr("type") == "text") {
                    $('#konfirmasi-show-hide-password input').attr('type', 'password');
                    $('#konfirmasi-show-hide-password i').addClass("fas fa-eye-slash");
                    $('#konfirmasi-show-hide-password i').removeClass("far fa-eye");
                } else if ($('#konfirmasi-show-hide-password input').attr("type") == "password") {
                    $('#konfirmasi-show-hide-password input').attr('type', 'text');
                    $('#konfirmasi-show-hide-password i').removeClass("fas fa-eye-slash");
                    $('#konfirmasi-show-hide-password i').addClass("far fa-eye");
                }
            });
        });
    </script>

    {{-- JS Show Hide Update Password --}}
    <script>
        $(document).ready(function() {
            $("#show-hide-password button").on('click', function(event) {
                event.preventDefault();
                if ($('#show-hide-password input').attr("type") == "text") {
                    $('#show-hide-password input').attr('type', 'password');
                    $('#show-hide-password i').addClass("fas fa-eye-slash");
                    $('#show-hide-password i').removeClass("far fa-eye");
                } else if ($('#show-hide-password input').attr("type") == "password") {
                    $('#show-hide-password input').attr('type', 'text');
                    $('#show-hide-password i').removeClass("fas fa-eye-slash");
                    $('#show-hide-password i').addClass("far fa-eye");
                }
            });
        });
    </script>

@endpush
