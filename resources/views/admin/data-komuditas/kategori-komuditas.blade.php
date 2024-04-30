@extends('layouts.app', [
    'title' => 'Kategori Komoditas',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Komoditas</h1>
        </div>

        <div class="row">
            @role('Super Admin')
                @foreach ($data_komoditas as $key => $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 kategori-komoditas" style="margin-top: 15px;">
                        <a href="{{ route('superadmin.data-komoditas.subkategori', $item->komoditas->nama) }}"
                            style="text-decoration:none">
                            <div class="d-flex justify-content-center">
                                <div class="card text-center header-komoditas">
                                    {{ $item->komoditas->nama }}
                                </div>
                            </div>
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="height: auto;">
                                    <img src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $item->subkomoditassss->subkomoditas->foto ?? '' }}"
                                        class="card-img" alt="...">
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Sub Komoditas {{ $item->nama }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $item->total }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endrole
            @role('Admin')
                @foreach ($data_komoditas as $key => $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 kategori-komoditas" style="margin-top: 15px;">
                        <a href="{{ route('admin.data-komoditas.subkategori', $item->komoditas->nama) }}"
                            style="text-decoration:none">
                            <div class="d-flex justify-content-center">
                                <div class="card text-center header-komoditas">
                                    {{ $item->komoditas->nama }}
                                </div>
                            </div>
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="height: auto;">
                                    <img src="{{ asset('template') }}/assets/img/pp.jfif" class="card-img" alt="...">
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Sub Komoditas {{ $item->nama }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $item->total }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endrole
        </div>


    </section>
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
@endpush
