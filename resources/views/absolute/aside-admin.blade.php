
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Helper::gravatar(session('email')) }}" class="img-circle" alt="{{ session('username') }}">
            </div>
            <div class="pull-left info">
                <p>{{ session('username') }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Navigation Principal</li>
            <li class="active treeview">
                <a href="{{ url('gstion/admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li ><a href="{{ url('gstion/admin') }}" class="histo-link"><i class="fa fa-circle-o"></i>Tableau de bord </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>Gestion des lieux</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('territory.indexPlace') }}" class=""><i class="fa fa-circle-o"></i>CycleService</a></li>
                    <li><a href="{{ route('territory.allPlace') }}" class=""><i class="fa fa-circle-o"></i>Tout les CycleService</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Gestion du territoire</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('territory.province') }}" class="histo-link"><i class="fa fa-circle-o"></i> Province</a></li>
                    <li><a href="{{ route('territory.country') }}" class="histo-link"><i class="fa fa-circle-o"></i> Regions</a></li>
                    <li><a href="{{ route('territory.departement') }}" class="histo-link"><i class="fa fa-circle-o"></i> Departement</a></li>
                    <li><a href="{{ route('territory.town') }}" class="histo-link"><i class="fa fa-circle-o"></i> Commune</a></li>
                    <li><a href="{{ route('territory.fokontany') }}" class="histo-link"><i class="fa fa-circle-o"></i> Fokontany</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
