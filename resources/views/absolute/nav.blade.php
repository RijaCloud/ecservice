<div class="header-container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">EveryCycle</a>
            </div>

            <div class="collapse navbar-collapse" id="collapse-2">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rechercher un cycle service <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="toggle"><a href="{{ url('services') }}?sv=part" class="cs-link">Ventes Pieces</a></li>
                            <li class="toggle"><a href="{{ url('services') }}?sv=garage" class="cs-link">Reparation</a></li>
                            <li class="toggle"><a href="{{ url('services') }}?sv=oil" class="cs-link">Ventes Huiles</a></li>
                            <li class="toggle"><a href="{{ url('services') }}?sv=accessory" class="cs-link">Ventes Accessoire</a></li>
                        </ul>
                    </li>
                </ul>

                @if(session('role'))
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="lng-switch dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> <span class="caret"></span> </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('gstion/admin/') }}" rel="nofollow">Administration</a> </li>
                                <li><a href="{{ url('gstion/admin/logout') }}" rel="nofollow">Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>