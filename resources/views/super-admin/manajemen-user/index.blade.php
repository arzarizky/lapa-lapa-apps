@extends('layouts.app', [
    'title' => 'Manajemen User',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manajemen User</h1>
        </div>

        <!-- Tambah Data -->
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Admin</h4>
                    <div class="card-header-action">
                        <a data-collapse="#collapse-tambah-admin" class="btn btn-icon btn-primary" href="#"><i
                                class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="collapse-tambah-admin">
                    <Form class="needs-validation" action="{{ route('superadmin.manajemen-user.post') }}" method="POST"
                        enctype="multipart/form-data" novalidate="">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="nama-depan">Nama Depan</label>
                                                <input id="input-nama-depan" type="text" class="form-control"
                                                    name="nama_depan" tabindex="2" placeholder="Masukan Nama Depan"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Wajib Memasukan Nama Depan
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="nama-belakang">Nama Belakang</label>
                                                <input id="input-nama-belakang" type="text" class="form-control"
                                                    name="nama_belakang" tabindex="2" placeholder="Masukan Nama Belakang"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Wajib Memasukan Nama Belakang
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pilih-kota">Pilih Kota</label>
                                        <select class="form-control" id="pilih-kota" name="kota_id" required tabindex="1">
                                            <option disabled selected value>Pilih Kota</option>
                                            @foreach ($kota as $itemkota)
                                                <option value="{{ $itemkota->id }}">
                                                    {{ $itemkota->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Wajib Memilih Kota
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="input-email" type="email" class="form-control" name="email"
                                            tabindex="2" placeholder="Masukan Email" required>
                                        <div class="invalid-feedback">
                                            Wajib Memasukan Email Dengan Benar
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                            <label for="password" class="d-block">Password</label>
                                            <div class="input-group" id="show-hide-password">
                                                <input id="password" type="password" class="form-control pwstrength"
                                                    placeholder="Masukan Password" data-indicator="pwindicator"
                                                    name="password" required>
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
                                                <input id="password2" type="password"
                                                    placeholder="Masukan Konfirmasi Password" class="form-control"
                                                    name="passwordsecond" required>
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
                                    </div>

                                    <div class="form-group" style="margin-top: -8px">
                                        <label for="label-foto">Foto</label>
                                        <div class="input-group" id="foto">
                                            <div class="custom-file">
                                                <input type="file" name="foto" class="custom-file-input" id="input-foto"
                                                    required tabindex="3">
                                                <label class="custom-file-label" for="input-foto">Pilih Foto</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Foto
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-icon icon-left btn-primary mb-4">
                                        <i class="fas fa-plus"></i>
                                        Tambahkan Admin
                                    </button>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="preview-foto">Preview Foto</label>
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <img id='preview-foto' src="" class="img-fluid rounded" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </Form>
                </div>
            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="text-warning">Data User</h4>
                    <div class="card-header-action">
                        <a data-collapse="#table-data-user" class="btn btn-icon btn-warning" href="#"><i
                                class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="table-data-user">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">KOTA</th>
                                        <th scope="col">DIBUAT PADA</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->kota->nama ?? '' }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button class="btn btn-warning mr-3" data-toggle="modal"
                                                    data-target="#lihat-data-user{{ $item->id }}">Lihat Data</button>
                                                <button class="btn btn-icon icon-left btn-danger delete-user"
                                                    id-user={{ $item->id }} nama="Arza Rizky" kota="Kediri">
                                                    <i class="fa fa-trash"></i>
                                                    Hapus Admin
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer">
                      
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Lihat Data --}}
    @foreach ($data as $item)
        <div class="modal fade" id="lihat-data-user{{ $item->id }}" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <Form class="needs-validation" action="{{ route('superadmin.manajemen-user.edit') }}"
                            novalidate="" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                                        <div class="form-group">
                                            <label for="nama-depan-update">Nama Depan</label>
                                            <input id="input-nama-depan-update" type="text" class="form-control"
                                                name="nama_depan" tabindex="2" placeholder="Masukan Nama Depan" required
                                                value="{{ $item->name }}">
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Nama Depan
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama-belakang-update">Nama Belakang</label>
                                            <input id="input-nama-belakang-update" type="text" class="form-control"
                                                name="nama_belakang" tabindex="2" placeholder="Masukan Nama Belakang"
                                                required value="{{ $item->last_name }}">
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Nama Belakang
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pilih-kota-update">Pilih Kota</label>
                                            <select class="form-control" id="pilih-kota-update" name="kota_id" required
                                                tabindex="1">
                                                <option disabled selected value>Pilih Kota</option>
                                                @foreach ($kota as $itemkota)
                                                    <option value="{{ $itemkota->id }}"
                                                        @if ($itemkota->nama == $item->kota->nama) {{ 'selected="selected"' }} @endif>
                                                        {{ $itemkota->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Wajib Memilih Kota
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email-update">Email</label>
                                            <input id="input-email-update" type="email" class="form-control" name="email"
                                                tabindex="2" placeholder="Masukan Email" required
                                                value="{{ $item->email }}">
                                            <div class="invalid-feedback">
                                                Wajib Memasukan Email Dengan Benar
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password-update" class="d-block">Password</label>
                                            <div class="input-group" id="show-hide-password-update">
                                                <input id="password-update" type="password"
                                                    class="form-control pwstrength-update" placeholder="Masukan Password"
                                                    data-indicator="pwindicator-update" name="password" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-warning"
                                                        style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; padding-top: 8px;">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Wajib Memasukan Password
                                                </div>
                                            </div>
                                            <div id="pwindicator-update" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password2-update" class="d-block">Konfirmasi
                                                Password</label>
                                            <div class="input-group" id="konfirmasi-show-hide-password-update">
                                                <input id="password2-update" type="password"
                                                    placeholder="Masukan Konfirmasi Password" class="form-control"
                                                    name="passwordsecond" required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-warning"
                                                        style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; padding-top: 8px;">
                                                        <i class="fas fa-eye-slash"></i></button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Wajib Memasukan Password Yang Sama
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="label-foto-update">Foto</label>
                                            <div class="input-group" id="foto-update">
                                                <div class="custom-file">
                                                    <input type="file" name="foto" class="custom-file-input"
                                                        id="input-foto-update{{ $item->id }}" required tabindex="3">
                                                    <label class="custom-file-label" for="input-foto-update">Pilih
                                                        Foto</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Wajib Memasukan Foto
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="preview-foto-update">Preview Foto</label>
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <img id='preview-foto-update{{ $item->id }}'
                                                        src="{{ asset('storage/admin') }}/{{ $item->foto }}"
                                                        class="img-fluid rounded" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button hidden id="update-data-user{{ $item->id }}" type="submit">kirim</button>
                        </Form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-icon icon-left btn-warning"
                            onclick="document.getElementById('update-data-user{{ $item->id }}').click();">
                            <i class="fas fa-edit"></i>
                            Update Data Admin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

    {{-- Preview Update Foto Admin --}}
    @foreach ($data as $item)
        <script>
            $('#input-foto-update{{ $item->id }}').on('change', function() {
                //get the file name
                var fileName = $(this).val().replace('C:\\fakepath\\', " ");
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
            var id = $(this).attr('id-user');


            function readURLFotoUpdate(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview-foto-update{{ $item->id }}').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#input-foto-update{{ $item->id }}").change(function() {
                readURLFotoUpdate(this);
            });
        </script>
    @endforeach


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

    {{-- JS Show Hide Konfirmasi Update Password --}}
    <script>
        $(document).ready(function() {
            $("#konfirmasi-show-hide-password-update button").on('click', function(event) {
                event.preventDefault();
                if ($('#konfirmasi-show-hide-password-update input').attr("type") == "text") {
                    $('#konfirmasi-show-hide-password-update input').attr('type', 'password');
                    $('#konfirmasi-show-hide-password-update i').addClass("fas fa-eye-slash");
                    $('#konfirmasi-show-hide-password-update i').removeClass("far fa-eye");
                } else if ($('#konfirmasi-show-hide-password-update input').attr("type") == "password") {
                    $('#konfirmasi-show-hide-password-update input').attr('type', 'text');
                    $('#konfirmasi-show-hide-password-update i').removeClass("fas fa-eye-slash");
                    $('#konfirmasi-show-hide-password-update i').addClass("far fa-eye");
                }
            });
        });
    </script>

    {{-- JS Show Hide Password --}}
    <script>
        $(document).ready(function() {
            $("#show-hide-password-update button").on('click', function(event) {
                event.preventDefault();
                if ($('#show-hide-password-update input').attr("type") == "text") {
                    $('#show-hide-password-update input').attr('type', 'password');
                    $('#show-hide-password-update i').addClass("fas fa-eye-slash");
                    $('#show-hide-password-update i').removeClass("far fa-eye");
                } else if ($('#show-hide-password-update input').attr("type") == "password") {
                    $('#show-hide-password-update input').attr('type', 'text');
                    $('#show-hide-password-update i').removeClass("fas fa-eye-slash");
                    $('#show-hide-password-update i').addClass("far fa-eye");
                }
            });
        });
    </script>

    {{-- Sweet Alert Delete User --}}
    <script>
        $('.delete-user').click(function() {
            var id = $(this).attr('id-user');
            var nama = $(this).attr('nama');
            var kota = $(this).attr('kota');
            var url = "/superadmin/manajemen-user/delete/" + id + "";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Yakin Menghapus?',
                html: '<p>Anda Akan Menghapus Admin <br><b>' + nama + '</b><br>Dikota <b>' + kota + '',
                icon: 'warning',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success ml-2',
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title: 'Terhapus!',
                        html: '<p>Data Admin <br><b>' + nama + '</b><br>Dikota <b>' + kota +
                            '</b> Terhapus.</p>',
                        icon: 'success',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Oke',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = url;
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        '<p>Data Admin <br><b>' + nama + '</b><br>Dikota <b>' + kota +
                        '</b> Tidak Terhapus.</p>',
                        'error'
                    )
                }
            })
        });
    </script>

@endpush
