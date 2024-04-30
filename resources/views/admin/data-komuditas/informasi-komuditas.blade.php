@extends('layouts.app', [
    'title' => 'Informasi Komoditas',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Informasi {{ Request::segment(4) }} {{ Request::segment(5) }}</h1>
        </div>

        <!-- Harga Sub Komoditas -->
        <div class="section-body">
            @if (Carbon\Carbon::now()->format('D') == 'Fri')
                <div class="card card-warning">
                    <div class="card-header">
                        <h4 class="text-warning">Harga {{ $rekapharga_subkomoditas[0]->pemilik->subkomoditas->nama ?? '' }}
                        </h4>
                        <div class="card-header-action">
                            <a data-collapse="#informasi-komuditas" class="btn btn-icon btn-warning" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="informasi-komuditas">
                        <div class="card-body">

                            <div class="empty-state header-informasi-komuditas" data-height="400">
                                <div class="empty-state-icon body-informasi-komuditas">
                                    <img src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $rekapharga_subkomoditas[0]->pemilik->subkomoditas->foto ?? '' }}"
                                        class="card-img img-informasi-komuditas" alt="...">
                                </div>
                                <?php $totalrekapharga = $rekapharga_subkomoditas->count();
                                $q = $rekapharga_subkomoditas[0]->harga ?? 0;
                                ?>
                                <h2>@currency($q)</h2>
                                <p class="lead">Harga
                                    {{ $rekapharga_subkomoditas[0]->pemilik->subkomoditas->nama ?? '' }}
                                    Sekarang adalah
                                    <span class="text-warning">
                                        @currency($q)
                                    </span>
                                </p>

                                <!-- Button Trigger Modal Update Harga Sub Komuditas -->
                                <button type="button" class="btn btn-warning mt-4" data-toggle="modal"
                                    data-target="#update-informasi-komuditas">
                                    Update Data
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Table Informasi {{ $rekapharga_subkomoditas[0]->pemilik->subkomoditas->nama ?? '' }}</h4>
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

                <div class="p-3">
                    {{-- <a href="#" class="btn btn-icon icon-left btn-primary"><i class="fas fa-file-csv"></i> Export Data
                        Ke
                        Excel</a> --}}
                    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambah-data-sub-komuditas"><i
                            class="fas fa-solid fa-plus"></i> Tambah
                        Data</button> -->

                </div>

                <div class="card-body p-0">
                    <div class="form-group pt-2 pr-3 pl-3">
                        <label for="maxRowsLabel">Tampilkan Data Sebanyak</label>
                        <select style="width: 165px;" class="form-control" id="maxRows">
                            <option value="50000000">Show All</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="75">75</option>
                            <option value="100">100</option>

                        </select>
                    </div>
                    <div class="table-responsive">
                        <table id="informasi-komoditas" class="table table-hover">
                            <tbody>
                                <tr style="background-color: #fafdfb; color: #34395e;">
                                    <th style="padding: 0px 12px;">NO</th>
                                    <th style="padding: 0px 12px;">KOMUDITAS</th>
                                    <th style="padding: 0px 12px;">JENIS PASAR</th>
                                    <th style="padding: 0px 12px;">Data KEBUTUHAN</th>
                                    <th style="padding: 0px 12px;">DATA KETERSEDIAAN</th>
                                    <th style="padding: 0px 12px;">HARGA</th>
                                    <th style="padding: 0px 12px;">DIUBAH OLEH</th>
                                    <th style="padding: 0px 12px;">TANGGAL</th>
                                    <th style="padding: 0px 12px;">ACTION</th>
                                </tr>
                                @foreach ($rekapharga_subkomoditas as $item)
                                    <tr>
                                        <th style="padding: 0px 12px;">{{ $loop->iteration }}</th>
                                        <td style="padding: 0px 12px;">{{ $item->pemilik->subkomoditas->nama ?? '' }}</td>
                                        <td style="padding: 0px 12px;">{{ $item->pemilik->jenispasar->nama ?? '' }}</td>
                                        <td style="padding: 0px 12px;">{{ $item->dk }}</td>
                                        <td style="padding: 0px 12px;">{{ $item->dp }}</td>
                                        <td style="padding: 0px 12px;">@currency($item->harga)</td>
                                        <td style="padding: 0px 12px;">
                                            @if ($item->useredit_id)
                                                <img alt="image" src="{{ asset('template') }}/assets/img/pp.jfif"
                                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                                    title="" data-original-title="{{ $item->user->email ?? '' }}">
                                            @else
                                            @endif

                                        </td>
                                        <td style="padding: 0px 12px;">{{ $item->tanggal }}</td>
                                        <!-- Button trigger modal ubah data sub komuditas -->
                                        <td style="padding: 0px 5px;">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#ubah-data-sub-komuditas{{ $item->id }}"><i
                                                    class="fas fa-solid fa-eye"></i> Lihat
                                                Data</button>
                                            <button class="btn btn-primary delete-data" data-toggle="modal"
                                                id-data="{{ $item->id }}" tanggal="{{ $item->tanggal }}"><i
                                                    class="fas fa-solid fa-eye"></i>
                                                Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer pagination-container text-center mt-2 mb-3">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{-- <li class="page-item disabled">
                                    <span style="cursor: pointer" class="page-link" tabindex="-1"><i
                                            class="fas fa-chevron-left"></i></span>
                                </li> --}}

                                {{-- <li class="page-item">
                                    <span style="cursor: pointer" class="page-link">2</span>
                                </li>
                                <li class="page-item"><span style="cursor: pointer" class="page-link" >3</span></li> --}}
                                {{-- <li class="page-item">
                                    <span style="cursor: pointer" class="page-link"><i class="fas fa-chevron-right"></i></span>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </div>

    </section>

    <!-- Modal Update Harga Sub Komuditas -->
    <div class="modal fade" id="update-informasi-komuditas" tabindex="-1" role="dialog"
        aria-labelledby="update-informasi-komuditas-title" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="update-informasi-komuditas-title">Update Data
                        {{ $rekapharga_subkomoditas[0]->pemilik->subkomoditas->nama ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mt-2">
                    <form action="{{ route('superadmin.data-komoditas.detailsubkategori.harga') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $nama->id }}" name="pemilik_id">
                        <div class="form-group" id="input-harga">
                            <label for="harga">Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="harga">Rp</span>
                                </div>
                                <input type="text" id="rupiah" class="form-control" placeholder="Masukan Harga"
                                    aria-label="Harga" aria-describedby="harga" name="harga">
                            </div>
                        </div>
                        <div class="form-group" id="input-data-ketersediaan">
                            <label for="data-ketersediaan">Data Ketersediaan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="data-ketersediaan"><i
                                            class="fas fa-archive"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Masukan Data Ketersediaan"
                                    aria-label="DataKetersediaan" aria-describedby="data-ketersediaan" name="dk">
                            </div>
                        </div>
                        <div class="form-group" id="input-data-kebutuhan">
                            <label for="harga">Data Kebutuhan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="data-kebutuhan"><i
                                            class="fas fa-archive"></i></span>
                                </div>
                                <input type="number" class="form-control" placeholder="Masukan Data Kebutuhan"
                                    aria-label="DataKebutuhan" aria-describedby="data-kebutuhan" name="dp">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Data Sub Komuditas -->
    @foreach ($rekapharga_subkomoditas as $item)
        <div class="modal fade" id="ubah-data-sub-komuditas{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="ubah-data-sub-komuditas-title" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uubah-data-sub-komuditas-title">Data
                            {{ $item->pemilik->subkomoditas->nama }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="needs-validation" novalidate=""
                            action="{{ route('superadmin.data-komoditas.detailsubkategori.updateharga') }}"
                            method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="card author-box card-primary mt-2">
                                <div class="card-body">
                                    <div class="author-box-left">
                                        <img alt="image"
                                            src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $item->pemilik->subkomoditas->foto ?? '' }}"
                                            class="rounded-circle author-box-picture" data-toggle="tooltip"
                                            title="" data-original-title="Arza Rizky | Super Admin ">
                                    </div>
                                    <div class="author-box-details mt-4">
                                        <div class="author-box-name">
                                            <a href="#">{{ $item->user->email ?? '' }}</a>
                                        </div>
                                        <div class="author-box-job">Terakhir Mengubah
                                            {{ $item->updated_at }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-primary">
                                <div class="card-body">
                                    <h6 class="mb-4">Data Pada Tanggal <span
                                            class="text-primary">{{ $item->created_at }}</span></h6>
                                    <div class="form-group" id="input-harga">
                                        <label for="harga">Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white"
                                                    id="harga">Rp</span>
                                            </div>
                                            <input type="text" id="update-rupiah" class="form-control"
                                                placeholder="Masukan Harga" aria-label="Harga" aria-describedby="harga"
                                                value="{{ $item->harga }}" name="harga">
                                        </div>
                                    </div>
                                    <div class="form-group" id="input-data-ketersediaan">
                                        <label for="data-ketersediaan">Data Kebutuhan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white"
                                                    id="data-ketersediaan"><i class="fas fa-archive"></i></span>
                                            </div>
                                            <input type="number" class="form-control"
                                                placeholder="Masukan Data Ketersediaan" aria-label="DataKetersediaan"
                                                aria-describedby="data-ketersediaan" value="{{ $item->dk }}"
                                                name="dk" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group" id="input-data-kebutuhan">
                                        <label for="harga">Data Ketersediaan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white"
                                                    id="data-kebutuhan"><i class="fas fa-archive"></i></span>
                                            </div>
                                            <input type="number" class="form-control"
                                                placeholder="Masukan Data Kebutuhan" aria-label="DataKebutuhan"
                                                aria-describedby="data-kebutuhan" value="{{ $item->dp }}"
                                                name="dp" step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer pt-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary">Update Data</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah Data Sub Komuditas -->
    <div class="modal fade" id="tambah-data-sub-komuditas" tabindex="-1" role="dialog"
        aria-labelledby="tambah-data-sub-komuditas-title" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-data-sub-komuditas-title">Data
                        {{ $item->pemilik->subkomoditas->nama ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="needs-validation" novalidate=""
                        action="{{ route('superadmin.data-komoditas.detailsubkategori.hargatanggal') }}"
                        method="post">
                        @csrf
                        <input type="hidden" value="{{ $nama->id }}" name="pemilik_id">
                        <div class="card author-box card-primary mt-2">
                            <div class="card-body">
                                <div class="author-box-left">
                                    <img alt="image"
                                        src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $item->pemilik->subkomoditas->foto ?? '' }}"
                                        class="rounded-circle author-box-picture" data-toggle="tooltip" title=""
                                        data-original-title="Arza Rizky | Super Admin ">
                                </div>
                                <div class="author-box-details mt-4">
                                    <div class="author-box-name">
                                        <a href="#"></a>
                                    </div>
                                    <div class="author-box-job">Terakhir Mengubah

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-body">
                                <h6 class="mb-4">Data Pada Tanggal <span class="text-primary"></span></h6>
                                <div class="form-group" id="input-harga">
                                    <label for="harga">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="harga">Rp</span>
                                        </div>
                                        <input type="text" id="update-rupiah" class="form-control"
                                            placeholder="Masukan Harga" aria-label="Harga" aria-describedby="harga"
                                            value="" name="harga" >
                                    </div>
                                </div>
                                <div class="form-group" id="input-data-ketersediaan">
                                    <label for="data-ketersediaan">Data Kebutuhan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="data-ketersediaan"><i
                                                    class="fas fa-archive"></i></span>
                                        </div>
                                        <input type="number" class="form-control"
                                            placeholder="Masukan Data Ketersediaan" aria-label="DataKetersediaan"
                                            aria-describedby="data-ketersediaan" value="" name="dk" step="0.01">
                                    </div>
                                </div>
                                <div class="form-group" id="input-data-kebutuhan">
                                    <label for="harga">Data Ketersediaan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="data-kebutuhan"><i
                                                    class="fas fa-archive"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Masukan Data Kebutuhan"
                                            aria-label="DataKebutuhan" aria-describedby="data-kebutuhan" value=""
                                            name="dp" step="0.01">
                                    </div>
                                </div>
                                <div class="form-group" id="input-data-kebutuhan">
                                    <label for="Tanggal">Tanggal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white" id="data-Tanggal"><i
                                                    class="fas fa-archive"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="tanggal"
                                            placeholder="Masukan Tanggal">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pt-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary"><i class="fas fa-solid fa-plus"></i> Tambah Data</button>
                        </div>
                    </form>
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

    <script type="text/javascript">
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        var rupiahUpdate = document.getElementById('update-rupiah');
        rupiahUpdate.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiahUpdate.value = formatRupiahUpdate(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiahUpdate(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiahUpdate = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiahUpdate += separator + ribuan.join('.');
            }

            rupiahUpdate = split[1] != undefined ? rupiahUpdate + ',' + split[1] : rupiahUpdate;
            return prefix == undefined ? rupiahUpdate : (rupiahUpdate ? 'Rp. ' + rupiahUpdate : '');
        }
    </script>

    <script>
        $('.delete-data').click(function() {
            var id = $(this).attr('id-data');
            var tanggal = $(this).attr('tanggal');
            var url = "/superadmin/data-komuditas/detail-delete/delete/" + id + "";
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

    <script>
        var table = '#informasi-komoditas'
        $('#maxRows').on('change', function() {
            $('.pagination').html('')
            var trnum = 0
            var maxRows = parseInt($(this).val())
            var totalRows = $(table + ' tbody tr').length
            $(table + ' tr:gt(0)').each(function() {
                trnum++
                if (trnum > maxRows) {
                    $(this).hide()
                }
                if (trnum <= maxRows) {
                    $(this).show()
                }
            })
            if (totalRows > maxRows) {
                var pagenum = Math.ceil(totalRows / maxRows)
                // if(pagenum > 1){
                //     $('.pagination').append('<li class="page-item"> <span style="cursor: pointer" class="page-link" tabindex="-1"><i class="fas fa-chevron-left"></i></span></li>').show()
                // }
                for (var i = 1; i <= pagenum;) {
                    $('.pagination').append('<li data-page="' + i +
                        '" class="page-item"><span style="cursor: pointer" class="page-link">' + i++ +
                        '<span class="sr-only">(current)</span></span></li>').show()

                }

            }

            $('.pagination li:first-child').addClass('active')
            $('.pagination li').on('click', function() {
                var pageNum = $(this).attr('data-page')
                var trIndex = 0;
                $('.pagination li').removeClass('active')
                $(this).addClass('active')

                $(table + ' tr:gt(0)').each(function() {
                    trIndex++
                    if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) -
                        maxRows)) {
                        $(this).hide()
                    } else {
                        $(this).show()
                    }
                })
            })
        })
        // $(function(){
        //     $('table tr:eq(0)').prepend('<th style="padding: 0px 12px;">NO</th>')
        //     var no = 0;
        //     $('table tr:gt(0)').each(function(){
        //         no++
        //         $(this).prepend('<td>'+no+'</td>')
        //     })
        // })
    </script>
@endpush
