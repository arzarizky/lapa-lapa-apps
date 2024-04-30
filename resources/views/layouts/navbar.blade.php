<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>

    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle">

            @role('Super Admin')
            <a href="{{route('superadmin.kritikdansaran.index')}}" class="nav-link nav-link-lg">
                <i class="far fa-envelope"></i>
                @if ($pesan = App\Models\Kritikdansaran::where('status','Belum Dibaca')->where('kota_id',auth()->user()->kota_id)->count())
                <p class="notif d-none d-sm-block">{{$pesan}}</p>
                @else
                @endif
            </a>
            @endrole
            @role('Admin')
            <a href="{{route('admin.kritikdansaran.index')}}" class="nav-link nav-link-lg">
                <i class="far fa-envelope"></i>
                @if ($pesan = App\Models\Kritikdansaran::where('status','Belum Dibaca')->where('kota_id',auth()->user()->kota_id)->count())
                <p class="notif d-none d-sm-block">{{$pesan}}</p>
                @else
                @endif
            </a>
            @endrole

        </li>

        @role('Super Admin')
            <li class="dropdown pt-1">
                <a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user "
                    id="kotasuperadmin">{{ auth()->user()->kota->nama }}</a>
                <div class="dropdown-menu dropdown-menu-right dropdown-max">


                    @foreach (App\Models\Kota::get(); as $itemkota)
                        <a href="{{route('superadmin.updatekota',$itemkota->id)}}" class="dropdown-item has-icon"
                            s="gantikota({{ $itemkota->id }})">{{ $itemkota->nama }}</a>
                    @endforeach
                </div>
            </li>
        @endrole

        <script>
            // document.getElementById("kotasuperadmin").innerHTML =

            function gantikota(params) {
                var id_kota = params;
                if (params) {
                    $.ajax({
                        url: "{{ url('/superadmin/updatekota/') }}/" + id_kota,
                        type: 'GET',
                    });
                }
                console.log(params);
                window.location.replace('http://sidanmor.com');

            }
        </script>

        @role('Admin')
            <li class="dropdown pt-1">
                <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">{{ auth()->user()->kota->nama }}</a>
            </li>
        @endrole

        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('storage/admin') }}/{{auth()->user()->foto}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{auth()->user()->roles[0]->name}}, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Setting Profile</div>
                <a href="/profile" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item has-icon text-danger"
                    onclick="document.getElementById('logout').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form action="{{ route('logout') }}" id="logout" method="post">@csrf</form>
            </div>
        </li>
    </ul>
</nav>
