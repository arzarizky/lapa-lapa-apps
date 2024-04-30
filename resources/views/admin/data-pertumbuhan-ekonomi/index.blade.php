@extends('layouts.app', [
    'title' => 'Informasi Komoditas',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pertumbuhan Ekonomi (Triwulan)</h1>
        </div>

        <!-- Harga Sub Komoditas -->
        <div class="section-body">
            <div class="card card-warning">
                <div class="card-header">
                    <h4 class="text-warning">Data Pertumbuhan Ekonomi (Triwulan)</h4>
                    <div class="card-header-action">
                        <a data-collapse="#data-pertumbuhan-ekonomi" class="btn btn-icon btn-warning" href="#"><i
                                class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse show" id="data-pertumbuhan-ekonomi">
                    <div class="card-body">
                        <form action="{{ route('superadmin.pertumbuhan-ekonomi.create') }}" class="needs-validation"
                            novalidate="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="data-pertumbuhan-ekonomi">Data Pertumbuhan Ekonomi (Triwulan) %</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white"
                                            id="data-pertumbuhan-ekonomi">%</span>
                                    </div>
                                    <input name="pertumbuhan" type="number" class="form-control"
                                        aria-describedby="data-pertumbuhan-ekonomi"
                                        placeholder="Masukkan data pertumbuhan ekonomi (dalam persen)"
                                        aria-label="data-inflasi" required step="any">
                                    <div class="invalid-feedback">
                                        Wajib Memasukan Data Pertumbuhan Ekonomi (Triwulan)
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="pilih-bulan">Pilih Bulan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text bg-warning text-white" for="pilih-bulan">
                                            <i class="fas fa-calendar-alt"></i>
                                        </label>
                                    </div>
                                    <select class="custom-select" name="pilih_bulan" id="pilih-bulan" required>
                                        <option disabled selected value>Pilih Bulan</option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Wajib Memilih Bulan
                                    </div>
                                </div>
                            </div> --}}

                            <button href="#" class="btn btn-icon icon-left btn-warning"><i
                                    class="fas fa-plus pr-2"></i>SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>History Data Pertumbuhan Ekonomi (Triwulan)</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                {{-- <input type="text" class="form-control" placeholder="Search Date">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr style="background-color: #fafdfb; color: #34395e;">
                                    <th>NO</th>
                                    <th>TANGGAL DIBUAT</th>
                                    <th>PROSENTASE INFLASI</th>
                                    <th>PERUBAHAN</th>
                                    <th>DITAMBAHKAN OLEH</th>
                                    <th>ACTION</th>
                                </tr>

                                @foreach ($data->reverse() as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <?php $date = new DateTime($item->tanggal); ?>
                                        <td>{{ $date->format('d M Y') }}</td>
                                        <td>{{ $item->prosentase }}%</td>
                                        @if ($key == 0)
                                            <td>{{ $item->prosentase ?? '' }}%</td>
                                        @else
                                            <td>{{ $item->prosentase - $data[$key - 1]->prosentase ?? '' }}%</td>
                                        @endif
                                        <td>
                                            <img alt="image" src="{{ asset('template') }}/assets/img/pp.jfif"
                                                class="rounded-circle" width="35" data-toggle="tooltip" title=""
                                                data-original-title="Arza Rizky | Super Admin">
                                        </td>
                                        <!-- Button trigger modal ubah data sub komuditas -->
                                        <td>
                                            {{-- <button type="button" class="btn btn-icon icon-left btn-primary mr-3"
                                                data-toggle="modal" data-target="#edit-pertumbuhan-ekonomi">
                                                <i class="far fa-edit"></i>
                                                EDIT
                                            </button> --}}
                                            <button type="button" class="btn btn-icon icon-left btn-danger delete-data"
                                                id-data={{ $item->id }} tanggal="{{ $date->format('d M Y') }}">
                                                <i class="fas fa-trash"></i>
                                                DELETE
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="card-footer text-center mt-2 mb-3">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i
                                            class="fas fa-chevron-left"></i></a>
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

        </div>

    </section>

    <!-- Modal Update Data -->
    <div class="modal fade" id="edit-pertumbuhan-ekonomi" tabindex="-1" role="dialog"
        aria-labelledby="edit-pertumbuhan-ekonomi-title" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="edit-pertumbuhan-ekonomi-title">Update Data 7 Mei 2022</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-2">
                    <div class="card author-box card-primary mt-2">
                        <div class="card-body">
                            <div class="author-box-left">
                                <img alt="image" src="{{ asset('template') }}/assets/img/pp.jfif"
                                    class="rounded-circle author-box-picture" data-toggle="tooltip" title=""
                                    data-original-title="Arza Rizky | Super Admin ">
                            </div>
                            <div class="author-box-details mt-4">
                                <div class="author-box-name">
                                    <a href="#">Arza Rizky | Super Admin</a>
                                </div>
                                <div class="author-box-job">Terakhir Mengubah
                                    Senin, 12-09-2022
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card author-box card-primary mt-2 p-4">
                        <form class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="data-inflasi">Data Pertumbuhan Ekonomi (Triwulan) %</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="data-inflasi">%</span>
                                    </div>
                                    <input type="number" class="form-control" aria-describedby="data-inflasi"
                                        placeholder="Data Inflasi (Bulanan)" aria-label="data-inflasi" required>
                                    <div class="invalid-feedback">
                                        Data Pertumbuhan Ekonomi (Triwulan)
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pilih-bulan">Pilih Bulan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text bg-primary text-white" for="pilih-bulan">
                                            <i class="fas fa-calendar-alt"></i>
                                        </label>
                                    </div>
                                    <select class="custom-select" name="pilih_bulan" id="pilih-bulan" required>
                                        <option disabled selected value>Pilih Bulan</option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Wajib Memilih Bulan
                                    </div>
                                </div>
                            </div>
                            <button hidden id="update-data-user" type="submit"></button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="document.getElementById('update-data-user').click();">Update
                        Data</button>
                </div>
            </div>
        </div>
    </div>
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

    {{-- Sweet Alert Delete Data --}}
    <script>
        $('.delete-data').click(function() {
            var id = $(this).attr('id-data');
            var tanggal = $(this).attr('tanggal');
            var url = "data-pertumbuhan-ekonomi/delete/" + id + "";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Yakin Menghapus?',
                html: '<p>Anda Akan Menghapus Data Pada Tanggal <b>' + tanggal +
                    '</b> Jika Iya Data Tidak Bisa Dikembalikan</p>',
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
                        html: '<p>Data Pada Tanggal <b>' + tanggal + '</b> Berhasil Dihapus</p>',
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
                        '<p>Data Pada <b>' + tanggal + '</b> Tidak Terhapus</p>',
                        'error'
                    )
                }
            })
        });
    </script>
@endpush
