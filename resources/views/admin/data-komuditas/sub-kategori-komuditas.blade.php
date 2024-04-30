@extends('layouts.app', [
    'title' => 'Sub Komoditas',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Komoditas {{ Request::segment(3) }}</h1>
        </div>

        <div class="row">
            @role('Super Admin')
                @foreach ($data_subkomoditas as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sub-kategori-komuditas" style="margin-top: 35px">
                        <a {{-- onclick="document.getElementById('subkategoridetail{{ $item->id }}').submit();" --}} {{-- href="{{ route('superadmin.data-komoditas.detailsubkategori', [$item->subkomoditas->nama, $item->subkomoditas->nama]) }}" --}}
                            href="/superadmin/data-komuditas/detail/{{ $item->subkomoditas->nama }}/{{ $item->jenispasar->nama }}"
                            style="text-decoration:none">
                            <div class="card">
                                <div class="d-flex justify-content-center">
                                    <img alt="image"
                                        src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $item->subkomoditas->foto }}"
                                        class="rounded-circle img-sub-kategori-komuditas" width="80">
                                </div>

                                <div class="d-flex justify-content-center">
                                    <h4 class="title-sub-kategori-komuditas">{{ $item->subkomoditas->nama }}</h4>
                                    <p class="tipe-pasar">{{ $item->jenispasar->nama }}</p>
                                </div>
                            </div>
                        </a>

                        {{-- <form action="{{ route('superadmin.data-komoditas.detailsubkategori', $item->subkomoditas->nama) }}"
                        method="post" id="subkategoridetail{{ $item->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form> --}}
                    </div>
                @endforeach
            @endrole
            @role('Admin')
                @foreach ($data_subkomoditas as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 sub-kategori-komuditas" style="margin-top: 35px">
                        <a {{-- onclick="document.getElementById('subkategoridetail{{ $item->id }}').submit();" --}} {{-- href="{{ route('superadmin.data-komoditas.detailsubkategori', [$item->subkomoditas->nama, $item->subkomoditas->nama]) }}" --}}
                            href="/admin/data-komuditas/detail/{{ $item->subkomoditas->nama }}/{{ $item->jenispasar->nama }}"
                            style="text-decoration:none">
                            <div class="card">
                                <div class="d-flex justify-content-center">
                                    <img alt="image"
                                        src="{{ asset('template/assets/img/sub-komuditas') }}/{{ $item->subkomoditas->foto }}"
                                        class="rounded-circle img-sub-kategori-komuditas" width="80">
                                </div>

                                <div class="d-flex justify-content-center">
                                    <h4 class="title-sub-kategori-komuditas">{{ $item->subkomoditas->nama }}</h4>
                                    <p class="tipe-pasar">{{ $item->jenispasar->nama }}</p>
                                </div>
                            </div>
                        </a>

                        {{-- <form action="{{ route('superadmin.data-komoditas.detailsubkategori', $item->subkomoditas->nama) }}"
                        method="post" id="subkategoridetail{{ $item->id }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form> --}}
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
