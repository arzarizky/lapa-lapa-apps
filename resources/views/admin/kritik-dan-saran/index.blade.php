@extends('layouts.app', [
    'title' => 'Kritik Dan Saran',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kritik Dan Saran</h1>
        </div>
        <div class="section-body">
            <div class="card card-primary" id="daftar-kritik-dan-saran">
                <div class="card-header" id="daftar-kritik-dan-saran-header">
                    <h4>Daftar Kritik Dan Saran</h4>
                    <div class="card-header-action">
                        <a data-collapse="#daftar-kritik-dan-saran-collapse" class="btn btn-icon btn-primary" href="#">
                            <i class="fas fa-minus"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse show" id="daftar-kritik-dan-saran-collapse">
                    <div class="card-body" id="daftar-kritik-dan-saran-body">
                        <div class="table-responsive" id="daftar-kritik-dan-saran-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="th">NAMA</th>
                                        <th class="th">Kota</th>
                                        <th class="th">TANGGAL</th>
                                        <th class="th">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Tidak ada Data</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($data as $item)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->kota->nama }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if ($item->status == 'Sudah Dibaca')
                                                        <button
                                                            class="btn btn-icon icon-left btn-outline-success btn-success mr-3"
                                                            data-toggle="modal"
                                                            data-target="#lihat-pesan{{ $item->id }}">
                                                            <i class="far fa-edit"></i>
                                                            Pesan Telah dibaca
                                                        </button>
                                                    @else
                                                        <button class="btn btn-icon icon-left btn-outline-primary mr-3"
                                                            data-toggle="modal"
                                                            data-target="#lihat-pesan{{ $item->id }}">
                                                            <i class="far fa-edit"></i>
                                                            Baca Pesan
                                                        </button>
                                                    @endif

                                                    <button class="btn btn-icon icon-left btn-outline-danger delete"
                                                        id-kritik-dan-saran="{{ $item->id }}" nama="{{ $item->nama }}"
                                                        kota="{{ $item->kota->nama }}"
                                                        tanggal="{{ $item->created_at }}">
                                                        <i class="fa fa-trash"></i>
                                                        Hapus Pesan
                                                    </button>
                                                    <form id="deletepesan{{ $item->id }}" {{-- action="{{ route('superadmin.kritikdansaran.delete') }}" --}}
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="card-footer text-center">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                            class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="card card-danger" id="data-kritik-dan-saran">
                <div class="card-header" id="data-kritik-dan-saran-header">
                    <h4 class="text-danger">Data Kritik Dan Saran</h4>
                    <div class="card-header-action">
                        <a data-collapse="#data-kritik-dan-saran-collapse" class="btn btn-icon btn-danger" href="#">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="data-kritik-dan-saran-collapse">
                    <div class="card-body" id="data-kritik-dan-saran-body">
                        <div class="table-responsive" id="data-kritik-dan-saran-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="th">NAMA</th>
                                        <th class="th">Kota</th>
                                        <th class="th">TANGGAL</th>
                                        <th class="th">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->kota->nama }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <button class="btn btn-icon icon-left btn-outline-danger delete"
                                                    id-kritik-dan-saran="{{ $item->id }}" nama="{{ $item->nama }}"
                                                    kota="{{ $item->kota->nama }}" tanggal="{{ $item->created_at }}">
                                                    <i class="fa fa-trash"></i>
                                                    Hapus Pesan
                                                </button>
                                                <form id="deletepesan{{ $item->id }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                            class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- Modal Lihat Pesan -->
    @foreach ($data as $item)
        <div class="modal fade" id="lihat-pesan{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="lihat-pesan-title" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" id="modal-header-pesan-title">
                        <h5 class="modal-title" id="lihat-pesan-title">Pesan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body-pesan-title">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <p class="text-dark">{{ $item->nama }}</p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="kritik">Kritik</label>
                            <p class="text-dark">
                                {{ $item->kritik }}
                            </p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="saran">Saran</label>
                            <p class="text-dark">
                                {{ $item->saran }}
                            </p>
                        </div>
                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="document.getElementById('updatestatusbelum{{ $item->id }}').submit();">Belum
                            Selesai
                            Baca</button>
                        <form id="updatestatusbelum{{ $item->id }}"
                            action="{{ route('superadmin.kritikdansaran.update') }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="status" value="Belum Dibaca">
                        </form>
                        <button class="btn btn-primary"
                            onclick="document.getElementById('updatestatussudah{{ $item->id }}').submit();">Sudah
                            Dibaca</button>
                        <form id="updatestatussudah{{ $item->id }}"
                            action="{{ route('superadmin.kritikdansaran.update') }}" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="status" value="Sudah Dibaca">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

{{-- Untuk Masukan JS --}}

@push('js')
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

    {{-- Sweet Alert Delete Data Kritik Dan Saran --}}
    <script>
        $('.delete').click(function() {
            var id = $(this).attr('id-kritik-dan-saran');
            var nama = $(this).attr('nama');
            var kota = $(this).attr('kota');
            var tanggal = $(this).attr('tanggal');
            var url = "/superadmin/kritik-dan-saran/delete/" + id + "";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Yakin Menghapus?',
                html: '<p>Apakah data kritik dan saran <br><b>' + nama + '</b><br>dikota <b>' + kota +
                    '</b> pada tanggal <b><br>' + tanggal + '</b> sudah didata?</p>',
                icon: 'warning',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah Didata',
                cancelButtonText: 'Tidak, Belum Didata',
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
                        html: '<p>Data kritik dan saran <br><b>' + nama + '</b><br>dikota <b>' +
                            kota + '</b> pada tanggal <b><br>' + tanggal + '</b> terhapus.</p>',
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
                        '<p>Data kritik dan saran <br><b>' + nama + '</b><br>dikota <b>' + kota +
                        '</b> pada tanggal <b><br>' + tanggal + '</b> tidak terhapus.</p>',
                        'error'
                    )
                }
            })
        });
    </script>
@endpush
