@extends('layouts.app', [
    'title' => 'Dashboard Admin',
])

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Data</h1>
        </div>

        <!-- Tambah Data -->
        <div class="section-body">
            <div class="card card-primary" id="manajemen-data">
                <div class="card-header" id="manajemen-data-header">
                    <h4>TAMBAH DATA KOMODITAS</h4>
                    <div class="card-header-action">
                        <a data-collapse="#manajemen-data-collapse" class="btn btn-icon btn-primary" href="#">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="manajemen-data-collapse">
                    <div class="card-body" id="manajemen-data-body">
                        <ul class="nav nav-tabs d-flex justify-content-center" id="manajemen-data-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tata-cara-tambah-komuditas-tab" data-toggle="tab" href="#tata-cara-tambah-komuditas" role="tab" aria-controls="tata-cara-tambah-komuditas" aria-selected="true">
                                    Tata Cara Tambah Data Komuditas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tambah-komuditas-tab" data-toggle="tab" href="#tambah-komuditas" role="tab" aria-controls="tambah-komuditas" aria-selected="false">
                                    Tambah Komuditas
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tambah-sub-komuditas-tab" data-toggle="tab" href="#tambah-sub-komuditas" role="tab" aria-controls="tambah-sub-komuditas" aria-selected="false">
                                    Tambah Sub Komuditas
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="manajemen-data-tab-content">
                            <div class="tab-pane fade show active" id="tata-cara-tambah-komuditas" role="tabpanel" aria-labelledby="tata-cara-tambah-komuditas-tab">
                                <div class="row d-flex justify-content-center">
                                    <!-- Tata cara Tambah Komuditas -->
                                    <div class="col-6">
                                        <div class="d-flex justify-content-center pt-4">
                                            <button class="btn btn-success collapsed" type="button" data-toggle="collapse" data-target="#tata-cara-tambah-komuditas-collapsed" aria-expanded="false" aria-controls="tata-cara-tambah-komuditas-collapsed" style="width: 100%;">
                                                Tata Cara Tambah Komditas
                                            </button>
                                        </div>
                                        <div class="collapse mt-3" id="tata-cara-tambah-komuditas-collapsed">
                                            <div id="accordion">
                                                <div class="accordion" id="accordion-success">
                                                  <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#langkah-1" aria-expanded="false">
                                                    <h4>Langkah Pertama</h4>
                                                  </div>
                                                  <div class="accordion-body collapse bg-light text-dark" id="langkah-1" data-parent="#accordion">
                                                    <ul>
                                                        <li>
                                                            Masukan Nama Komuditas Pada Form Yang Sudah Disediakan.
                                                        </li>
                                                        <li>
                                                            Penamaan Komuditas Jangan Hanya Memasukan Nama Jenis Komuditas.
                                                        </li>
                                                        <li>
                                                            Contoh Penamaan : 
                                                            <ul>
                                                                <li>Contoh Penamaan Benar : Komuditas Beras</li>
                                                                <li>Contoh Penamaan Salah : Beras</li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                  </div>
                                                </div>
                                                <div class="accordion" id="accordion-success">
                                                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#langkah-2" aria-expanded="false">
                                                        <h4>Langkah Kedua</h4>
                                                    </div>
                                                    <div class="accordion-body collapse bg-light text-dark" id="langkah-2" data-parent="#accordion">
                                                        <ul>
                                                            <li>
                                                                Masukan Gambar Komuditas Pada Form Yang Sudah Disediakan.
                                                            </li>
                                                            <li>
                                                                Masukan Gambar Berbentuk Persegi Agar Tidak Terpotong.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="accordion" id="accordion-success">
                                                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#langkah-3" aria-expanded="false">
                                                        <h4>Langkah Terakhir</h4>
                                                    </div>
                                                    <div class="accordion-body collapse bg-light text-dark" id="langkah-3" data-parent="#accordion">
                                                        <ul>
                                                            <li>
                                                                Klik Button Tambahkan Komuditas.
                                                            </li>
                                                            <li>
                                                                Cek Data Pada Table Komuditas.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                    <!-- Tata cara tambah sub komuditas -->
                                    <div class="col-6">
                                        <div class="d-flex justify-content-center pt-4">
                                            <button class="btn btn-warning collapsed" type="button" data-toggle="collapse" data-target="#tata-cara-tambah-sub-komuditas-collapsed" aria-expanded="false" aria-controls="tata-cara-tambah-sub-komuditas-collapsed" style="width: 100%;">
                                                Tata Cara Tambah Sub Komuditas
                                            </button>
                                        </div>
                                        <div class="collapse mt-3" id="tata-cara-tambah-sub-komuditas-collapsed">
                                            <div id="accordion-1">
                                                <div class="accordion" id="accordion-warning">
                                                  <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#sub-komuditas-langkah-1" aria-expanded="false">
                                                    <h4>Langkah Pertama</h4>
                                                  </div>
                                                  <div class="accordion-body collapse bg-light text-dark" id="sub-komuditas-langkah-1" data-parent="#accordion-1">
                                                    <ul>
                                                        <li>
                                                            Sebelum Menambahkan Sub Komuditas Pastikan Sudah Ada Komuditas.
                                                        </li>
                                                        <li>
                                                           Pilih Komuditas Sesuai Sub Komuditas Yang Akan Ditambahkan
                                                        </li>
                                                        <li>
                                                            Jika Belum Ada Tambahkan Terlebih Dahulu Komuditas Di Menu <b>Tambah Komuditas</b>.
                                                        </li>
                                                    </ul>
                                                  </div>
                                                </div>
                                                <div class="accordion" id="accordion-warning">
                                                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#sub-komuditas-langkah-2" aria-expanded="false">
                                                      <h4>Langkah Kedua</h4>
                                                    </div>
                                                    <div class="accordion-body collapse bg-light text-dark" id="sub-komuditas-langkah-2" data-parent="#accordion-1">
                                                        <ul>
                                                            <li>
                                                                Masukan Nama Sub Komuditas Pada Form Yang Sudah Disediakan.
                                                            </li>
                                                            <li>
                                                                Penamaan Sub Komuditas Jangan Hanya Memasukan Nama Jenis Sub Komuditas.
                                                            </li>
                                                            <li>
                                                                Contoh Penamaan : 
                                                                <ul>
                                                                    <li>Contoh Penamaan Benar : Komuditas Bawang Merah</li>
                                                                    <li>Contoh Penamaan Salah : Bawang Merah</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="accordion" id="accordion-warning">
                                                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#sub-komuditas-langkah-3" aria-expanded="false">
                                                      <h4>Langkah Ketiga</h4>
                                                    </div>
                                                    <div class="accordion-body collapse bg-light text-dark" id="sub-komuditas-langkah-3" data-parent="#accordion-1">
                                                        <ul>
                                                            <li>
                                                                Masukan Gambar Sub Komuditas Pada Form Yang Sudah Disediakan.
                                                            </li>
                                                            <li>
                                                                Masukan Gambar Berbentuk Persegi Agar Tidak Terpotong.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="accordion" id="accordion-warning">
                                                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#sub-komuditas-langkah-terakhir" aria-expanded="false">
                                                      <h4>Langkah Terakhir</h4>
                                                    </div>
                                                    <div class="accordion-body collapse bg-light text-dark" id="sub-komuditas-langkah-terakhir" data-parent="#accordion-1">
                                                        <ul>
                                                            <li>
                                                                Klik Button Tambahkan Sub Komuditas.
                                                            </li>
                                                            <li>
                                                                Cek Data Pada Table Komuditas.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tambah-komuditas" role="tabpanel" aria-labelledby="tambah-komuditas-tab">
                                <div class="pt-3 pr-1 pl-1">
                                    <!-- Tambah Data Komusditas -->
                                    <form class="needs-validation" novalidate="">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <label for="nama-komuditas">Nama Komuditas</label>
                                                    <input id="nama-komuditas" type="text" class="form-control" name="nama-komuditas" tabindex="2"
                                                        placeholder="Masukan Nama Komuditas" required>
                                                    <div class="invalid-feedback">
                                                        Wajib Memasukan Nama Komuditas
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="label-gambar-komuditas">Gambar Komuditas</label>
                                                    <div class="input-group mb-4" id="gambar-komuditas">
                                                        <div class="custom-file">
                                                            <input type="file" name="gambar-komuditas" class="custom-file-input" id="input-gambar-komuditas" required tabindex="3"> 
                                                            <label class="custom-file-label" for="input-gambar-komuditas">Pilih Gambar Komuditas</label>
                                                            <div class="invalid-feedback">
                                                                Wajib Gambar Komuditas
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-icon icon-left btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    Tambahkan Komuditas
                                                </button>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="nama-sub-komuditas">Preview Gambar Komuditas</label>
                                                    <div class="card bg-light">
                                                        <div class="card-body">
                                                            <img id='preview-gambar-komuditas' class="card-img-top">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tambah-sub-komuditas" role="tabpanel" aria-labelledby="tambah-sub-komuditas-tab">
                                <div class="pt-3 pr-1 pl-1">
                                    <!-- Tambah Data Sub Komuditas -->
                                    <form class="needs-validation" novalidate="">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="form-group">
                                                    <label for="pilih-komuditas">Pilih Komuditas</label>
                                                    <select class="form-control" id="pilih-komuditas" name="pilih-komuditas" required tabindex="1">
                                                      <option>Pilih Komuditas</option>
                                                      <option value="komuditas-bawang">Komuditas Bawang</option>
                                                      <option value="komuditas-ayam">Komuditas Ayam</option>
                                                      <option value="komuditas-beras">Komuditas Beras</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Wajib Memilih Komuditas
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama-sub-komuditas">Nama Sub Komuditas</label>
                                                    <input id="nama-sub-komuditas" type="text" class="form-control" name="nama-sub-komuditas" tabindex="2"
                                                        placeholder="Masukan Nama Sub Komuditas" required>
                                                    <div class="invalid-feedback">
                                                        Wajib Memasukan Nama Sub Komuditas
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="label-gambar-sub-komuditas">Gambar Sub Komuditas</label>
                                                    <div class="input-group mb-4" id="gambar-sub-komuditas">
                                                        <div class="custom-file">
                                                            <input type="file" name="gambar-sub-komuditas" class="custom-file-input" id="input-gambar-sub-komuditas" required tabindex="3"> 
                                                            <label class="custom-file-label" for="input-gambar-sub-komuditas">Pilih Gambar Komuditas</label>
                                                            <div class="invalid-feedback">
                                                                Wajib Memasukan Gambar Sub Komuditas
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-icon icon-left btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    Tambahkan Sub Komuditas
                                                </button>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group">
                                                    <label for="nama-sub-komuditas">Preview Gambar Komuditas</label>
                                                    <div class="card bg-light">
                                                        <div class="card-body">
                                                            <img id='preview-gambar-sub-komuditas' class="img-fluid rounded"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="text-warning">DATA KOMODITAS</h4>
                    <div class="card-header-form">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive" id="table-data-komoditas">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-dark">
                                <th>NO</th>
                                <th>KOMODITAS</th>
                                <th>KOTA</th>
                                <th>DIBUAT OLEH</th>
                                <th>DIBUAT PADA TANGGAL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <span class="pr-3">
                                        <a data-collapse="#bawang" class="text-dark btn-icon" href="#">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </span> 
                                    Bawang
                                </td>
                                <td>2018-01-20</td>
                                <td>
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                </td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                
                                <tbody class="collapse" id="bawang">
                                    <tr class="thead text-dark">
                                        <th>NO</th>
                                        <th>SUB KOMODITAS</th>
                                        <th>KOTA</th>
                                        <th>DIBUAT OLEH</th>
                                        <th>DIBUAT PADA TANGGAL</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            Bawang Merah
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>
                                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                        </td>
                                        <td><div class="badge badge-success">Completed</div></td>
                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            Bawang Hijau
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>
                                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                        </td>
                                        <td><div class="badge badge-success">Completed</div></td>
                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tr>
                                </tbody>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>
                                    <span>
                                        <a data-collapse="#cabe" class="text-dark btn-icon" href="#">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                    </span> 
                                    Cabe
                                </td>
                                <td>2018-01-20</td>
                                <td>
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                </td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                
                                <tbody class="collapse bg-white" id="cabe">
                                    <tr>
                                        <th>NO</th>
                                        <th>SUB KOMODITAS</th>
                                        <th>KOTA</th>
                                        <th>DIBUAT OLEH</th>
                                        <th>DIBUAT PADA TANGGAL</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            Cabe Merah
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>
                                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                        </td>
                                        <td><div class="badge badge-success">Completed</div></td>
                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            Cabe Hijau
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>
                                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                        </td>
                                        <td><div class="badge badge-success">Completed</div></td>
                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tr>
                                </tbody>
                            </tr>
                           
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

    {{-- JS Preview Gambar Komuditas dan Get Filename Image --}}
    <script>
        $('#input-gambar-komuditas').on('change',function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
      
        function readURL(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      
                      reader.onload = function (e) {
                          $('#preview-gambar-komuditas').attr('src', e.target.result);
                      }
                      
                      reader.readAsDataURL(input.files[0]);
                  }
              }
      
              $("#input-gambar-komuditas").change(function(){
                  readURL(this);
              }); 	
    </script>

    {{-- JS Preview Gambar Sub Komuditas dan Get Filename Image --}}
    <script>
        $('#input-gambar-sub-komuditas').on('change',function(){
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
      
        function readURLSubKomuditas(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      
                      reader.onload = function (e) {
                          $('#preview-gambar-sub-komuditas').attr('src', e.target.result);
                      }
                      
                      reader.readAsDataURL(input.files[0]);
                  }
              }
      
              $("#input-gambar-sub-komuditas").change(function(){
                  readURLSubKomuditas(this);
              }); 	
    </script>

@endpush