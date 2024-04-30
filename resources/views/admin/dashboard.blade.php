@extends('layouts.app', [
    'title' => 'Dashboard',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-pepper-hot"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Komoditas</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_komoditas ?? '' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-pepper-hot"></i>
                        <i class="fas fa-pepper-hot"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Sub Komoditas</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_subkomoditas ?? '' }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_admin ?? '' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Jenis Pasar</h4>
                        </div>
                        <div class="card-body">
                            {{ $count_pasar ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>FILTER</h4>
                <div class="card-header-action">
                    <a data-collapse="#filter" class="btn btn-icon btn-primary" href="#"><i
                            class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="filter" style="">
                <div class="card-body">
                    <form>
                        <div class="form-group" id="filter-jenis-komoditas">
                            <label for="jenis-komoditas">Sub Komoditas</label>
                            <select class="form-control" id="jenis-komoditas" name="subkomoditas">
                                <option value="%">Pilih Jenis Sub Komoditas</option>
                                @foreach ($filter as $item_komoditas)
                                    <option value="{{ $item_komoditas->subkomoditas->id ?? '' }}">
                                        {{ $item_komoditas->subkomoditas->nama ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="filter-jenis-pasar">
                            <label for="jenis-pasar">Jenis Pasar</label>
                            <select class="form-control" id="jenis-pasar" name="jenispasar">
                                <option value="%">Pilih Jenis Pasar</option>
                                @foreach ($data_pasar as $item_pasar)
                                    <option value="{{ $item_pasar->id }}">{{ $item_pasar->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-filter"></i>
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h4 class="text-success">DATA TABLE</h4>
                <div class="card-header-action">
                    <a data-collapse="#data" class="btn btn-icon btn-success" href="#"><i
                            class="fas fa-minus"></i></a>
                </div>
            </div>
            <div class="collapse show" id="data" style="">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover" style="border-radius: 8px;">
                            <tbody>
                                <tr style="background-color: #47c363; color: #ffff;">
                                    <th style="padding: 0px 12px;">NO</th>
                                    <th>SUB KOMODITAS</th>
                                    <th>JENIS PASAR</th>
                                    <th>DATA KEBUTUHAN</th>
                                    <th>DATA KETERSEDIAAN</th>
                                    <th>HARGA</th>
                                    <th>ACTION</th>

                                </tr>
                                @role('Super Admin')
                                    @foreach ($data_komoditas as $key => $item)
                                        <tr>
                                            <th style="padding: 0px 12px;">{{ $loop->iteration }}</th>
                                            <td>{{ $item->subkomoditas->nama ?? '' }}</td>
                                            <td>{{ $item->jenispasar->nama ?? '' }}</td>
                                            <?php $datano = $item->rekapharga->count(); ?>
                                            <td>{{ $item->rekapharga[$datano - 1]->dk ?? '' }}</td>
                                            <td>{{ $item->rekapharga[$datano - 1]->dp ?? '' }}</td>
                                            <?php $harganominal = intval($item->rekapharga->avg('harga')) ?? ''; ?>
                                            <td>
                                                @currency($harganominal)
                                            </td>
                                            <td>
                                                <a href="/superadmin/data-komuditas/detail/{{ $item->subkomoditas->nama ?? '' }}/{{ $item->jenispasar->nama ?? '' }}"
                                                    class="btn btn-icon icon-left btn-warning">
                                                    <i class="far fa-file"></i> Lihat Data</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endrole
                                @role('Admin')
                                    @foreach ($data_komoditas as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->subkomoditas->nama ?? '' }}</td>
                                            <td>{{ $item->jenispasar->nama ?? '' }}</td>
                                            <?php $datano = $item->rekapharga->count(); ?>
                                            <td>{{ $item->rekapharga[$datano - 1]->dk ?? '' }}</td>
                                            <td>{{ $item->rekapharga[$datano - 1]->dp ?? '' }}</td>
                                            <?php $harganominal = intval($item->rekapharga->avg('harga')) ?? ''; ?>
                                            <td>
                                                @currency($harganominal)
                                            </td>
                                            <td>
                                                <a href="/admin/data-komuditas/detail/{{ $item->subkomoditas->nama }}/{{ $item->jenispasar->nama }}"
                                                    class="btn btn-icon icon-left btn-warning">
                                                    <i class="far fa-file"></i> Lihat Data</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endrole



                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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
