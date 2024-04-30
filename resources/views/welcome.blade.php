<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Lapa-Lapa Apps - Laporan Pangan Aktual Provinsi Sulawesi Tenggara</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template') }}/assets/img/favicon.png" />


    <!-- General CSS Files -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="{{ asset('template') }}/node_modules/@fortawesome/fontawesome-free/css/all.min.css">


    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="{{ asset('template') }}/node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/izitoast/dist/css/iziToast.min.css">

    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('template') }}/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet"
        href="{{ asset('template') }}/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet"
        href="{{ asset('template') }}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{ asset('template') }}/node_modules/sweetalert2/dist/sweetalert2.min.css">





    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/lalapa-apps.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/components.css">
</head>

<body id="landing-page">
    <div id="container-header">
        <div class="header">
            <div class="d-xl-none d-sm-block sm text-center">
                <img src="{{ asset('template') }}/assets/img/logo-1.png" alt="logo-lapalapa" class=" ">
            </div>
            <div class="row d-flex justify-content-center">
                <a href="/" style="text-decoration-line: none">
                    <div class="brand text-center">
                        LAPALAPA APPS
                        <span class="d-none d-xl-inline"></span>
                    </div>
                </a>
                <div class="center">
                    <div class="d-xl-none d-sm-block sm d-flex justify-content-center ">
                        <hr>
                    </div>
                    <div class="tag-line text-center text-center">
                        Laporan Pangan Aktual Provinsi Sulawesi Tenggara
                    </div>
                </div>
                <div class="logo d-none d-xl-block ">
                    <img src="{{ asset('template') }}/assets/img/logo-1.png" alt="">
                </div>

            </div>
        </div>
    </div>

    <div id="sub-header">
        <div class="row">
            <div class="new">
                New
            </div>
            <div class="text-playstore">
                Dapatkan Aplikasi Mobile LAPALAPA di PlayStore Sekarang Juga !
            </div>
            <div class="logo-play-store">
                <a href="https://play.google.com/store/apps/details?id=com.lapalapa.mobile_lapalapa" target="_blank">
                    <img src="{{ asset('template') }}/assets/img/play-store-logo-nisi-filters-australia-11 1.png">
                </a>
            </div>
        </div>
    </div>

    <div id="konten">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="text-konten">
                    <div class="judul-konten">
                        PUSAT informasi TENTANG harga pangan !
                    </div>
                    <div class="sub-judul-konten">
                        Pusat informasi resmi tentang harga pangan secara akurat khusus daerah Sulawesi Tenggara
                    </div>
                    <div class="btn-cek">
                        <a href="#komoditas" class="cek-harga-pangan">
                            <button class="btn">CEK HARGA PANGAN</button>
                        </a>
                        <a class="pasar-murah" target="_blank" href="https://pasarmurah-bi.projectkoding.com/kegiatan">
                            <button class="btn">PASAR MURAH</button>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-12 d-none d-xl-block">
                <div class="image-konten ">
                    <img src="{{ asset('template') }}/assets/img/Data analytics _Monochromatic 1.svg" alt="">
                </div>
            </div>
        </div>
    </div>



    <div id="komoditas">
        <form action="{{ route('dashboard.post') }}" method="post">
            @csrf
            <div class="row padding-l">
                <div class="form-group padding-r" style="width: 379px;">
                    <label for="exampleFormControlSelect1">SUB KOMODITAS</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="subkomoditas">
                        @foreach ($subkomoditas as $itemsubkomoditas)
                            <option value="{{ $itemsubkomoditas->id }}"
                                @if (Session::get('subkomoditas') == $itemsubkomoditas->id) selected @endif>{{ $itemsubkomoditas->nama }}
                            </option> @endforeach
                    </select>
                </div>
                <div class="form-group
        padding-r" style="width: 205px;">
    <label for="exampleFormControlSelect1">JENIS PASAR</label>
    <select class="form-control" id="exampleFormControlSelect1" name="jenispasar">
        @foreach ($jenispasar->reverse() as $itemjenispasar)
            <option value="{{ $itemjenispasar->id }}" @if (Session::get('pajenispasarsar') == $itemjenispasar->id) selected @endif>
                {{ $itemjenispasar->nama }}
            </option>
        @endforeach
    </select>
    </div>
    <div class="form-group padding-r" style="width: 252px;">
        <label for="exampleFormControlSelect1">JENIS INFORMASI HARGA</label>
        <select class="form-control" id="exampleFormControlSelect1w" name="informasi_harga"
            onchange="hideopsi(this.options[this.selectedIndex].value)">
            <option value="perbandingan_harga" @if (Session::get('jenisinformasi') == 'perbandingan_harga') selected @endif>
                Perbandingan Harga</option>
            <option value="perubahan_harga" @if (Session::get('jenisinformasi') == 'perubahan_harga') selected @endif>Perubahan
                Harga</option>
        </select>
    </div>
    <div class="form-group padding-r opsiperbandingan" class="" style="width: 252px;">
        <label for="exampleFormControlSelect1">Perbandingan</label>
        <select class="form-control" id="periode" name="periode"
            onchange="hideopsiperbandingan(this.options[this.selectedIndex].value)">
            <option value="daytoday" @if (Session::get('periode') == 'daytoday') selected @endif>Day to Day</option>
            <option value="weektoweek" @if (Session::get('periode') == 'weektoweek') selected @endif>Week to week
            </option>
            <option value="monthtomonth" @if (Session::get('periode') == 'monthtomonth') selected @endif>Month to Month
            </option>
        </select>
    </div>
    <div class="form-group padding-r" style="width: 205px;">
        <label>TANGGAL</label>
        <input type="date" class="form-control" name="tanggal" value="{{ $data['tanggalinput'] }}"
            max="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
    </div>
    <div>
        <button type="submit" class="btn btn-lp">SUBMIT</button>
    </div>
    </div>
    </form>
    </div>
    <div class="container">
        <button type="button" id="dl-peta" class="dl_data" onclick="download('data')">Download Peta</button>
        <button type="button" id="dl-data" class="dl_data" onclick="download('histogram-chart')">Download
            Histogram</button>
    </div>
    <div id="data" class="data {{ Session::get('jenisinformasi') ?? '' }} {{ Session::get('periode') ?? '' }}">
        <div id="judul">
            {{ $data['nama_subkomoditas']->nama }} per {{ $data['nama_subkomoditas']->satuan }}
        </div>
        <div id="data-konten">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="row" id="day">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                            <hr>
                            <ul class="nav d-flex justify-content-end nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="tampilkan-peta-tab" data-toggle="pill"
                                        href="#tampilkan-peta" role="tab" aria-controls="tampilkan-peta"
                                        aria-selected="true">
                                        <span><i class="far fa-map"></i></span>
                                        TAMPILKAN PETA
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="tampilkan-histogram-tab" data-toggle="pill"
                                        href="#tampilkan-histogram" role="tab" aria-controls="tampilkan-histogram"
                                        aria-selected="false">
                                        <span><i class="fas fa-signal"></i></span> HISTOGRAM</a>
                                </li>
                            </ul>
                            <hr>
                            <div id="histogram-chart">
                                <div class="date-konten d-flex justify-content-end">
                                    <span class="theDate"><label>Tanggal:</label> {{ $data['tanggal'] }}</span>
                                    <span class="theAvg"><label>Rata-rata:</label>
                                        @if ($ratarata ?? '')
                                            @currency($ratarata)
                                        @else
                                            No Data
                                        @endif
                                    </span>
                                    {{-- <span class="theStdev"><label>STDev:</label>
                                        @if ($stddev ?? '')
                                            @currency($stddev)
                                        @else
                                            No Data
                                        @endif
                                    </span> --}}
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="tampilkan-peta" role="tabpanel"
                                        aria-labelledby="tampilkan-peta-tab">
                                        <div class="maps1">
                                            @include('admin.peta.index')
                                        </div>
                                        <div class="maps2">
                                            @include('admin.peta.index2')
                                        </div>
                                        <div class="maps3">
                                            @include('admin.peta.index3')
                                        </div>
                                        <div class="maps4">
                                            @include('admin.peta.index4')
                                        </div>
                                        <div class="warna-data">
                                            <div class="d-flex flex-row">
                                                <div>
                                                    <div class="hijau-tua"></div>
                                                    <label class="text-dark"><b>Harga Turun</b></label>
                                                </div>
                                                <div>
                                                    <div class="hijau-toska"></div>
                                                    <label class="text-dark"><b></b></label>
                                                </div>
                                                <div>
                                                    <div class="hijau"></div>
                                                    <label class="text-dark"><b>Harga Tetap</b></label>
                                                </div>
                                                <div>
                                                    <div class="merah"></div>
                                                    <label class="text-dark"><b></b></label>
                                                </div>
                                                <div>
                                                    <div class="merah-tua"></div>
                                                    <label class="text-dark"><b>Harga Naik</b></label>
                                                </div>
                                                <div>
                                                    <div class="abu-abu"></div>
                                                    <label class="text-dark"><b>Tidak Update</b></label>
                                                </div>
                                                <div>
                                                    <div class="border-black"></div>
                                                    <label class="text-dark"><b>Tidak Ada Data</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tampilkan-histogram" role="tabpanel"
                                        aria-labelledby="tampilkan-histogram-tab">

                                        <div class="histogram1">
                                            @include('admin.histogram.index')
                                        </div>
                                        <div class="histogram2">
                                            @include('admin.histogram.index2')
                                        </div>
                                        <div class="histogram3">
                                            @include('admin.histogram.index3')
                                        </div>
                                        <div class="histogram4">
                                            @include('admin.histogram.index4')
                                        </div>
                                        <!-- <div class="data-histogram">
                                            <div class="d-flex flex-row">
                                                <div>
                                                    <div class="data-kebutuhan"></div>
                                                    <label class="text-dark"><b>Data Kebutuhan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-ketersediaan"></div>
                                                    <label class="text-dark"><b>Data Ketersediaan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-harga"></div>
                                                    <label class="text-dark"><b>Data Harga</b></label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    {{-- <div class="tab-pane fade histogram2" id="tampilkan-histogram" role="tabpanel"
                                        aria-labelledby="tampilkan-histogram-tab">
                                        <canvas id="histogram2"></canvas>
                                        <!-- <div class="data-histogram">
                                            <div class="d-flex flex-row">
                                                <div>
                                                    <div class="data-kebutuhan"></div>
                                                    <label class="text-dark"><b>Data Kebutuhan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-ketersediaan"></div>
                                                    <label class="text-dark"><b>Data Ketersediaan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-harga"></div>
                                                    <label class="text-dark"><b>Data Harga</b></label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div> --}}
                                    {{-- <div class="tab-pane fade histogram3" id="tampilkan-histogram" role="tabpanel"
                                        aria-labelledby="tampilkan-histogram-tab">
                                        <canvas id="histogram3"></canvas>
                                        <!-- <div class="data-histogram">
                                            <div class="d-flex flex-row">
                                                <div>
                                                    <div class="data-kebutuhan"></div>
                                                    <label class="text-dark"><b>Data Kebutuhan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-ketersediaan"></div>
                                                    <label class="text-dark"><b>Data Ketersediaan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-harga"></div>
                                                    <label class="text-dark"><b>Data Harga</b></label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div> --}}
                                    {{-- <div class="tab-pane fade histogram4" id="tampilkan-histogram" role="tabpanel"
                                        aria-labelledby="tampilkan-histogram-tab">
                                        <canvas id="histogram4"></canvas>
                                        <!-- <div class="data-histogram">
                                            <div class="d-flex flex-row">
                                                <div>
                                                    <div class="data-kebutuhan"></div>
                                                    <label class="text-dark"><b>Data Kebutuhan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-ketersediaan"></div>
                                                    <label class="text-dark"><b>Data Ketersediaan</b></label>
                                                </div>
                                                <div>
                                                    <div class="data-harga"></div>
                                                    <label class="text-dark"><b>Data Harga</b></label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 col-12 initabel1" style="margin-left: -255px;">
                    <div id="table" style="width: 575px;">
                        <div class="table-responsive display">
                            <table class="table display">
                                <thead class="th" style="background-color: #54B1A8; width: 575px;">
                                    <tr>
                                        <th class="text-white" scope="col">KOTA/KABUPATEN</th>
                                        <th class="text-white" scope="col">HARGA</th>
                                    </tr>
                                </thead>
                                <tbody class="table table-bordered td">
                                    @foreach ($data['tabelharga'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration - 1 }}</td>
                                            <td>{{ $item->kota->nama ?? '' }}</td>
                                            @if ($item->rekapharga->harga ?? '')
                                                <td>
                                                    @currency($item->rekapharga->harga)
                                                </td>
                                            @else
                                                <td>No Data</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 initabel2 day-to-day" style="margin-left: -255px;">
                    <div id="table" style="width: 575px;">
                        <div class="table-responsive display">
                            <table class="table display">
                                <thead class="th" style="background-color: #54B1A8; width: 575px;">
                                    <span class="indicator-periode">day</span>
                                    <tr>
                                        {{-- <th class="text-white" scope="col">No</th> --}}
                                        <th class="text-white" scope="col">KOTA/KABUPATEN</th>
                                        <th class="text-white" scope="col">PERUBAHAN</th>
                                    </tr>
                                </thead>
                                <tbody class="table table-bordered td">
                                    @foreach ($data['tabelharga'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration - 1 }}</td>
                                            <td>{{ $item->kota->nama ?? '' }}</td>
                                            <td> {{ $item->daytoday }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 initabel3 " style="margin-left: -255px;">
                    <div id="table" style="width: 575px;">
                        <div class="table-responsive display">
                            <table class="table display">
                                <thead class="th" style="background-color: #54B1A8; width: 575px;">
                                    <span class="indicator-periode">week</span>
                                    <tr>
                                        <th class="text-white" scope="col">KOTA/KABUPATEN</th>
                                        <th class="text-white" scope="col">PERUBAHAN</th>
                                    </tr>
                                </thead>
                                <tbody class="table table-bordered td">
                                    @foreach ($data['tabelharga'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration - 1 }}</td>
                                            <td>{{ $item->kota->nama ?? '' }}</td>
                                            <td> {{ $item->weektoweek }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12 initabel4" style="margin-left: -255px;">
                    <div id="table" style="width: 575px;">
                        <div class="table-responsive display">
                            <table class="table display">
                                <thead class="th" style="background-color: #54B1A8; width: 575px;">
                                    <span class="indicator-periode">month</span>
                                    <tr>
                                        <th class="text-white" scope="col">KOTA/KABUPATEN</th>
                                        <th class="text-white" scope="col">PERUBAHAN</th>
                                    </tr>
                                </thead>
                                <tbody class="table table-bordered td">
                                    @foreach ($data['tabelharga'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration - 1 }}</td>
                                            <td>{{ $item->kota->nama ?? '' }}</td>
                                            <td> {{ $item->monthtomonth }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container inflasi">
        <div class="d-flex flex-row justify-content-center inflasi-pertumbuhan">
            <div class="inflasi">
                <?php $tanggalsultra = Carbon\carbon::now(); ?>
                <div class="text-inflasi">INFLASI SULTRA {{ $tanggalsultra->isoformat('Y') }}
                    <span class="p-2 {{ $data['inflasi']['inflasi_perubahan']['status'] ?? '' }}">
                        <i class="fas fa-arrow-up pr-3"></i>
                        {{ $data['inflasi']['inflasi_perubahan']['nilai'] }}%
                    </span>
                    <span class="hasil-persen p-2">
                        {{ $data['inflasi']->prosentase ?? '' }}%
                    </span>
                </div>
            </div>
            <div class="pertumbuhan">
                <?php
                $tw = Carbon\Carbon::now()->format('m');
                
                $tw = intval($tw);
                if ($tw >= 1 && $tw <= 3) {
                    $tm = 'I';
                }
                if ($tw >= 4 && $tw <= 6) {
                    $tm = 'II';
                }
                if ($tw >= 7 && $tw <= 9) {
                    $tm = 'III';
                }
                if ($tw >= 10 && $tw <= 12) {
                    $tm = 'IV';
                }
                
                ?>
                <div class="text-pertumbuhan">PERTUMBUHAN EKONOMI SULTRA
                    {{ $tanggalsultra->format('Y') }}
                    <span
                        class="p-2 {{ $data['pertumbuhan_ekonomi']['pertumbuhan_ekonomi_perubahan']['status'] ?? '' }}">
                        <i class="fas fa-arrow-up pr-3"></i>
                        {{ $data['pertumbuhan_ekonomi']['pertumbuhan_ekonomi_perubahan']['nilai'] }}%
                    </span>
                    <span class="hasil-persen p-2">
                        {{ $data['pertumbuhan_ekonomi']->prosentase ?? '' }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div id="sub-komuditas">
        <div class="text-rata-rata">
            Harga Rata-Rata dan Perubahan
        </div>
        <hr>
        <div>
            <form>
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <select class="form-control kotabawah_id" id="pilih-provinsi" name="kotabawah_id">
                                @foreach ($kota as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <select class="form-control jenispasarbawah_id" id="pilih-pasar"
                                name="jenispasarbawah_id">
                                @foreach ($jenispasar->reverse() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div>
                            <button class="btn btn-lp save-data">SUBMIT</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="text-subkomoditas d-flex justify-content-end">
                            Tanggal: {{ $data['tanggal'] }}
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr style="margin-top: -9px; margin-bottom: 40px;">


        <div class="row cart-bawah">
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Beras Kualitas Bawah
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-beras">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil  red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Beras Kacang Kiri
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-kacang-kiri">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil green text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-down pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Beras Kacang Atas
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-kacang-atas">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil blue text-center text-white">
                                <span>
                                    <i class="fas fa-pause pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Beras Kacang Kanan
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-kacang-kanan">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Cabe Kanan
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-cabe-kanan">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    cabe kiri
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-cabe-kiri">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Cabe Atas
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-cabe-atas">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5">
                <div class="header text-center">
                    Cabe Bawah
                </div>
                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div id="grafik">
                            <div class="grafik-rata-rata-cabe-bawah">Loading...</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12" style="">
                        <div id="keterangan">
                            <div class="harga text-right">
                                Rp26.550
                            </div>
                            <div class="kg text-right">
                                per Kg
                            </div>
                            <div class="hasil red text-center text-white">
                                <span>
                                    <i class="fas fa-arrow-up pr-1"></i>
                                </span>
                                0.18% - Rp300
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>







    <!-- General JS Scripts -->
    <script src="{{ asset('template') }}/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/moment/min/moment.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('template') }}/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="{{ asset('template') }}/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="{{ asset('template') }}/node_modules/izitoast/dist/js/iziToast.min.js"></script>

    <!-- Page Specific JS File -->
    {{-- <script src="{{ asset('template') }}/assets/js/page/index.js"></script> --}}
    <script src="{{ asset('template') }}/assets/js/page/modules-toastr.js"></script>
    <script src="{{ asset('template') }}/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    {{-- <script src="{{ asset('template') }}/assets/js/page/modules-sparkline.js"></script> --}}

    {{-- <script>
    $('.konawe').mouseover(function() {
        $('').addClass();
    });

  </script> --}}

    <script>
        $(document).ready(function() {
            $("#dl-data").hide();
            $("#dl-peta").show();
            $("#tampilkan-peta-tab").click(function() {
                $("#dl-data").hide();
                $("#dl-peta").show();
            });
        });

        $(document).ready(function() {
            $("#tampilkan-histogram-tab").click(function() {
                $("#dl-peta").hide();
                $("#dl-data").show();
            });
        });
    </script>
    <script>
        var harga_rata_rata = [1.6, 5, 1.8, -50, 3, 5, 4, 3, 2, 1.2]
        $('.grafik-rata-rata-1').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>



    <script>
        var harga_rata_rata = [1.1, 2.2, 3.3, 4.4, 5.5, 1.1]
        $('.grafik-rata-rata-kacang-atas').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [10, 12, 45, 12, 56]
        $('.grafik-rata-rata-kacang-kiri').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [100, 200, 300, 500, -100, 1]
        $('.grafik-rata-rata-kacang-kanan').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [100, 200, 300, 500, -100, 1]
        $('.grafik-rata-rata-cabe-kanan').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [11.1, 2.2, 3.3, 4.4, 5.5, 1.1]
        $('.grafik-rata-rata-cabe-kiri').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [1, 2, 3, 4, 5, 6, 7, 8, 9]
        $('.grafik-rata-rata-cabe-atas').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        var harga_rata_rata = [1.6, 5, 1.8, -50, 3, 5, 4, 3, 2, 1.2]
        $('.grafik-rata-rata-cabe-bawah').sparkline(harga_rata_rata, {
            type: 'line',
            width: '100%',
            height: '110',
            lineWidth: 1,
            lineColor: 'rgba(0, 0, 0, 1)',
            fillColor: 'transparent',
            highlightSpotColor: 'red',
            highlightLineColor: 'blue',
            spotRadius: 5,
            spotColor: '#f80',
        });
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle-tooltip="tooltip"]').tooltip();
        });
    </script>

    <?php
    $namakota = $data['tabelharga'][0]->kota->pluck('nama');
    $namakotas = [];
    $hargas = [];
    $hargasdk = [];
    $hargasdp = [];
    $daytoday = [];
    $weektoweek = [];
    $monthtomonth = [];
    if ($data['tabelharga']) {
        foreach ($data['tabelharga'] as $key => $value) {
            array_push($namakotas, $value->kota->nama);
            array_push($hargas, $value->rekapharga->harga ?? '');
            array_push($hargasdk, $value->rekapharga->dk ?? '');
            array_push($hargasdp, $value->rekapharga->dp ?? '');
            array_push($daytoday, $value->daytoday ?? '');
            array_push($weektoweek, $value->weektoweek ?? '');
            array_push($monthtomonth, $value->monthtomonth ?? '');
        }
    }
    
    // var_dump($daytoday);
    // var_dump($weektoweek);
    // var_dump($monthtomonth);
    
    ?>
    <script>
        const labels = @php echo json_encode($namakotas); @endphp;
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Data Harga',
                    data: <?php echo json_encode($hargas); ?>,
                    borderColor: 'rgba(232, 98, 98, 1)',
                    backgroundColor: 'rgba(232, 98, 98, 1)',
                    fill: false,
                    type: 'line',
                    order: 2,
                    yAxisID: 'harga'
                },
                {

                    label: 'Data Kebutuhan',
                    data: <?php echo json_encode($hargasdk); ?>,
                    borderColor: 'rgba(18, 77, 182, 1)',
                    backgroundColor: 'rgba(18, 77, 182, 1)',
                    order: 0,
                    yAxisID: 'kebutuhan'
                },
                {
                    label: 'Data Ketersediaan',
                    data: <?php echo json_encode($hargasdp); ?>,
                    borderColor: 'rgba(173, 206, 178, 1)',
                    backgroundColor: 'rgba(173, 206, 178, 1)',
                    order: 1
                }
            ]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    yAxes: [{
                            id: 'kebutuhan',
                            type: 'linear',
                            position: 'left',
                            grid: {
                                display: false,
                            }
                        }, {
                            id: 'harga',
                            type: 'linear',
                            position: 'right',
                            grid: {
                                display: false,
                            }
                        }

                    ]
                }
            },
        };
        const myChart = new Chart(
            document.getElementById('histogram1'),
            config
        );
    </script>
    <script>
        const labels2 = @php echo json_encode($namakotas); @endphp;
        const data2 = {
            labels: labels2,
            datasets: [{
                    label: 'Data Harga',
                    data: <?php echo json_encode($daytoday); ?>,
                    borderColor: 'rgba(232, 98, 98, 1)',
                    backgroundColor: 'rgba(232, 98, 98, 1)',
                    fill: false,
                    type: 'line',
                    order: 2,
                    yAxisID: 'harga'
                },
                {

                    label: 'Data Kebutuhan',
                    data: <?php echo json_encode($daytoday); ?>,
                    borderColor: 'rgba(18, 77, 182, 1)',
                    backgroundColor: 'rgba(18, 77, 182, 1)',
                    order: 0,
                    yAxisID: 'kebutuhan'
                },
                {
                    label: 'Data Ketersediaan',
                    data: <?php echo json_encode($daytoday); ?>,
                    borderColor: 'rgba(173, 206, 178, 1)',
                    backgroundColor: 'rgba(173, 206, 178, 1)',
                    order: 1
                }
            ]
        };
        const config2 = {
            type: 'bar',
            data: data2,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    yAxes: [{
                            id: 'kebutuhan',
                            type: 'linear',
                            position: 'left',
                            grid: {
                                display: false,
                            }
                        }, {
                            id: 'harga',
                            type: 'linear',
                            position: 'right',
                            grid: {
                                display: false,
                            }
                        }

                    ]
                }
            },
        };
        const myChart2 = new Chart(
            document.getElementById('histogram2'),
            config2
        );
    </script>
    <script>
        const labels3 = @php echo json_encode($namakotas); @endphp;
        const data3 = {
            labels: labels3,
            datasets: [{
                    label: 'Data Harga',
                    data: <?php echo json_encode($weektoweek); ?>,
                    borderColor: 'rgba(232, 98, 98, 1)',
                    backgroundColor: 'rgba(232, 98, 98, 1)',
                    fill: false,
                    type: 'line',
                    order: 2,
                    yAxisID: 'harga'
                },
                {

                    label: 'Data Kebutuhan',
                    data: <?php echo json_encode($weektoweek); ?>,
                    borderColor: 'rgba(18, 77, 182, 1)',
                    backgroundColor: 'rgba(18, 77, 182, 1)',
                    order: 0,
                    yAxisID: 'kebutuhan'
                },
                {
                    label: 'Data Ketersediaan',
                    data: <?php echo json_encode($weektoweek); ?>,
                    borderColor: 'rgba(173, 206, 178, 1)',
                    backgroundColor: 'rgba(173, 206, 178, 1)',
                    order: 1
                }
            ]
        };
        const config3 = {
            type: 'bar',
            data: data3,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    yAxes: [{
                            id: 'kebutuhan',
                            type: 'linear',
                            position: 'left',
                            grid: {
                                display: false,
                            }
                        }, {
                            id: 'harga',
                            type: 'linear',
                            position: 'right',
                            grid: {
                                display: false,
                            }
                        }

                    ]
                }
            },
        };
        const myChart3 = new Chart(
            document.getElementById('histogram3'),
            config3
        );
    </script>
    <script>
        const labels4 = @php echo json_encode($namakotas); @endphp;
        const data4 = {
            labels: labels4,
            datasets: [{
                    label: 'Data Harga',
                    data: <?php echo json_encode($monthtomonth); ?>,
                    borderColor: 'rgba(232, 98, 98, 1)',
                    backgroundColor: 'rgba(232, 98, 98, 1)',
                    fill: false,
                    type: 'line',
                    order: 2,
                    yAxisID: 'harga'
                },
                {

                    label: 'Data Kebutuhan',
                    data: <?php echo json_encode($monthtomonth); ?>,
                    borderColor: 'rgba(18, 77, 182, 1)',
                    backgroundColor: 'rgba(18, 77, 182, 1)',
                    order: 0,
                    yAxisID: 'kebutuhan'
                },
                {
                    label: 'Data Ketersediaan',
                    data: <?php echo json_encode($monthtomonth); ?>,
                    borderColor: 'rgba(173, 206, 178, 1)',
                    backgroundColor: 'rgba(173, 206, 178, 1)',
                    order: 1
                }
            ]
        };
        const config4 = {
            type: 'bar',
            data: data4,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    yAxes: [{
                            id: 'kebutuhan',
                            type: 'linear',
                            position: 'left',
                            grid: {
                                display: false,
                            }
                        }, {
                            id: 'harga',
                            type: 'linear',
                            position: 'right',
                            grid: {
                                display: false,
                            }
                        }

                    ]
                }
            },
        };
        const myChart4 = new Chart(
            document.getElementById('histogram4'),
            config4
        );
    </script>
    <script>
        // $(document).ready(function() {
        //     $('.opsiperbandingan').hide();
        //     $('.initabel2').hide();
        //     $('.initabel3').hide();
        //     $('.initabel4').hide();
        //     $('.maps2').hide();
        //     $('.maps3').hide();
        //     $('.maps4').hide();
        //     $('.histogram2').hide();
        //     $('.histogram3').hide();
        //     $('.histogram4').hide();
        // });
    </script>

    <script>
        window.onload = function() {

            // $('.display').dataTable();
            $(".save-data").click();
            $(".semuakota").click();
            if (document.getElementById('exampleFormControlSelect1w').value == 'perubahan_harga') {
                document.getElementById("periode").disabled = false;
            } else {
                document.getElementById("periode").disabled = true;
            }
            console.log(document.getElementById('exampleFormControlSelect1w').value);
            // document.getElementById("periode").disabled = true;
            // $('.table').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copyHtml5',
            //         'excelHtml5',
            //         'csvHtml5',
            //         'pdfHtml5'
            //     ]
            // });
        }
    </script>

    <script>
        $(".save-data").click(function(event) {
            event.preventDefault();

            $(".cart-bawah").empty();

            let kotabawahi_id = $(".kotabawah_id").val();
            let jenispasarbawahi_id = $(".jenispasarbawah_id").val();
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/indexpostbawah",
                type: "POST",
                data: {
                    kotabawah_id: kotabawahi_id,
                    jenispasarbawah_id: jenispasarbawahi_id,
                    _token: _token
                },
                success: function(response) {
                    console.log(response);

                    if (response) {
                        $('.success').text(response.success);
                        // $("#ajaxform")[0].reset();
                        for (var i = 0; i < response.length; i++) {
                            const id = response[i].subkomoditas.id;
                            const nama = response[i].subkomoditas.nama;
                            const satuan = response[i].subkomoditas.satuan;
                            const harga = response[i].rekaphargaone.harga;
                            const hargaselisih = response[i].selisihharga;
                            const hargagrafik = response[i].rekapharga;
                            const arrow = response[i].status['status'];
                            const color = response[i].status['color'];
                            const persentase = response[i].persentase;

                            $(".cart-bawah").append(
                                '<div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-5"><div class="header text-center">' +
                                nama +
                                '</div><div class="row" style="padding-left: 15px; padding-right: 15px;"><div class="col-lg-6 col-md-6 col-sm-6 col-12"><div id="grafik"><div class="grafik-rata-rata-' +
                                id +
                                '">Loading...</div></div></div><div class="col-lg-6 col-md-6 col-sm-6 col-12" style=""><div id="keterangan"><div class="harga text-right">' +
                                rupiah(harga) +
                                '</div><div class="kg text-right">per ' + satuan +
                                '</div><div class="hasil ' +
                                color +
                                ' text-center text-white"><span><i class="fas fa-arrow-' +
                                arrow + ' pr-1"></i></span>' + persentase + '% - ' +
                                rupiah(hargaselisih) + '</div></div></div></div></div>'
                            );
                            var cartgrafik = cart(hargagrafik, id);
                            $(".cart-bawah").append(cartgrafik);
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                    // $('#nameError').text(response.responseJSON.errors.name);
                    // $('#emailError').text(response.responseJSON.errors.email);
                    // $('#mobileError').text(response.responseJSON.errors.mobile);
                    // $('#messageError').text(response.responseJSON.errors.message);
                }
            });
        });
    </script>
    <script>
        function cart(arrcart, idcart) {
            var harga_rata_rata = arrcart
            $('.grafik-rata-rata-' + idcart).sparkline(harga_rata_rata, {
                type: 'line',
                width: '100%',
                height: '110',
                lineWidth: 1,
                lineColor: 'rgba(0, 0, 0, 1)',
                fillColor: 'transparent',
                highlightSpotColor: 'red',
                highlightLineColor: 'blue',
                spotRadius: 5,
                spotColor: '#f80',
            });
        }
    </script>
    <script>
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            method: 'POST',
            data: {
                _token: _token
            },
            url: '/semuakota',
            success: function(response) {
                myArraysemuakota = response
                console.log(myArraysemuakota)
                for (let index = 0; index < myArraysemuakota['tabelharga'].length; index++) {
                    console.log(myArraysemuakota['tabelhargareverse'][index]);
                    const harga = myArraysemuakota['tabelhargareverse'][index]['harga'];
                    const hargaformat = rupiah(harga);
                    $(".loopingsemuakota").append(
                        "<td>" + hargaformat + "</td>"
                    );

                }
            }
        })

        let subkomoditas_id = 2;
        let pasar_id = 1;
        let tanggal = '2022-06-18';

        $.ajax({
            method: 'POST',
            data: {
                subkomoditas_id: subkomoditas_id,
                pasar_id: pasar_id,
                tanggal: tanggal,
                _token: _token
            },
            url: '/ratarata',
            success: function(response) {
                ratarata = response
                console.log(ratarata)
            }
        })

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            }).format(number);
        }

        function hideopsiperbandingan(params) {
            if (params == 'daytoday') {
                // $('.initabel1').hide();
                // $('.initabel2').show();
                // $('.initabel3').hide();
                // $('.initabel4').hide();
            }
            if (params == 'weektoweek') {
                // $('.initabel1').hide();
                // $('.initabel2').hide();
                // $('.initabel3').show();
                // $('.initabel4').hide();
            }
            if (params == 'monthtomonth') {
                // $('.initabel1').hide();
                // $('.initabel2').hide();
                // $('.initabel3').hide();
                // $('.initabel4').show();
            }
        }

        function hideopsi(params) {
            if (params == 'perubahan_harga') {
                // $('.opsiperbandingan').show();
                // $('.initabel1').hide();
                // $('.initabel2').show();
                // $('.initabel3').hide();
                // $('.initabel4').hide();
                document.getElementById("periode").disabled = false;
            }
            if (params == 'perbandingan_harga') {
                // $('.opsiperbandingan').hide();
                // $('.initabel1').show();
                // $('.initabel2').hide();
                // $('.initabel3').hide();
                // $('.initabel4').hide();
                document.getElementById("periode").disabled = true;
            }
        }
    </script>

    {{-- canvas donwload --}}
    {{-- <a id="btn-Convert-Html2Image" href="#">Download</a> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script> --}}
    <script>
        function download(tagId) {
            html2canvas(document.getElementById(tagId)).then(function(canvas) {
                var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                // document.getElementById("previewImg").appendChild(canvas);
                anchorTag.download = "filename.jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
        }
    </script>
    <!-- #region datatables files -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    {{-- <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> --}}
    <!-- #endregion -->




    {{-- download --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.esm.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery("#download").click(function() {
                screenshot();
            });
        });

        // function downloadbaru(params) {
        //     screenshot(params);
        // }

        function screenshot() {
            // console.log("#" + params);
            html2canvas(document.getElementById("#konten")).then(function(canvas) {
                downloadImage(canvas.toDataURL(), "UsersInformation.png");
            });
        }

        function downloadImage(uri, filename) {
            var link = document.createElement('a');
            if (typeof link.download !== 'string') {
                window.open(uri);
            } else {
                link.href = uri;
                link.download = filename;
                accountForFirefox(clickLink, link);
            }
        }

        function clickLink(link) {
            link.click();
        }

        function accountForFirefox(click) {
            var link = arguments[1];
            document.body.appendChild(link);
            click(link);
            document.body.removeChild(link);
        }
    </script>
    </body>

    <footer id="footer">
        <small>Hak Cipta © 2022 Sulawesi Tenggara Government - Semua Hak Dilindungi | Rekomendasi browser Chrome dan
            Firefox
            <span style="display: inline-block; width: 100%;">Developed by
                <a title="Professional Web & Apps Development" alt="Professional Web & Apps Development"
                    target="_blank" style="color:#fff" href="https://markashosting.com">Markas Hosting</a>
            </span>
        </small>
    </footer>

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
