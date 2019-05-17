<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->nama}}</p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{$activeMenu == 'dashboard' ? 'active' : ''}}"><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-sitemap"></i> <span>Organisasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Sejarah
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Tambah Sejarah</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Data Sejarah</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Struktur
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Tambah Struktur</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Data Struktur</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Pengprov
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Tambah Pengprov</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Data Pengprov</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview {{$activeMenu == 'berita' ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-rss-square"></i>
          <span>Berita</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/berita/tambah-berita')}}"><i class="fa fa-circle-o"></i> Tambah Berita</a></li>
          <li><a href="{{url('admin/berita/data-berita')}}"><i class="fa fa-circle-o"></i> Data Berita</a></li>
        </ul>
      </li>
      <li class="treeview {{$activeMenu == 'atlet' ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Atlet</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/atlet/tambah-atlet')}}"><i class="fa fa-circle-o"></i> Tambah Atlet</a></li>
          <li><a href="{{url('admin/atlet/data-atlet')}}"><i class="fa fa-circle-o"></i> Data Atlet</a></li>
        </ul>
      </li>
      <li class="treeview {{$activeMenu == 'kejuaraan' ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-calendar"></i>
          <span>Kejuaraan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/kejuaraan/tambah-kejuaraan')}}"><i class="fa fa-circle-o"></i> Tambah Kejuaraan</a></li>
          <li><a href="{{url('admin/kejuaraan/daftar-kejuaraan')}}"><i class="fa fa-circle-o"></i> Daftar Kejuaraan</a></li>
        </ul>
      </li>
      <li class="treeview {{$activeMenu == 'kategori-rangking' ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-random"></i>
          <span>Kategori & Rangking</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/kategori')}}"><i class="fa fa-circle-o"></i> Daftar Kategori</a></li>
          <li><a href="{{url('admin/rangking/tambah-rangking')}}"><i class="fa fa-circle-o"></i> Tambah Rangking</a></li>
          <li><a href="{{url('admin/rangking/data-rangking')}}"><i class="fa fa-circle-o"></i> Rangking</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-envira"></i>
          <span>Gallery</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{url('admin/tambah-kalender-kejuaraan')}}"><i class="fa fa-circle-o"></i> Tambah Gallery</a></li>
          <li><a href="{{url('admin/kalender-kejuaraan')}}"><i class="fa fa-circle-o"></i> Gallery</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
