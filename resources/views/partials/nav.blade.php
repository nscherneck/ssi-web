<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('home') }}">SSI-Extranet</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Customers <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="/customers">
                            @include('partials.icons.customer-icon') &nbsp; Customer Lookup
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="/sites">
                            @include('partials.icons.site-icon') &nbsp; Site Lookup
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="/systems">
                            @include('partials.icons.system-icon') &nbsp; System Lookup
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Jobs <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="/jobs">
                            Jobs Home
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Jobs Metrics
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            New Job
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Service <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="/service/home">
                            Service Home
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="/service/metrics">
                            Service Metrics
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Work Order Queue
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            New Work Order
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Components <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="/manufacturers">
                            Manufacturer Lookup
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Component Lookup
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Resources <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#">
                            Contacts
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Codes & Standards
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Templates
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li>
                        <a href="#">
                            Other Documents
                        </a>
                        <form id="profile-form" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    @include('partials.icons.user-icon')
                    {{ Auth::user()->full_name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    @can('Admin Dashboard')
                        <li>
                            <a href="/admin">
                                @include('partials.icons.admin-icon')
                                Admin Dashboard
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="/profile">
                            @include('partials.icons.user-icon')
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            @include('partials.icons.logout-icon')
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif

      </ul>
      <!-- <form class="navbar-form navbar-right">
        <input type="text" class="form-control" placeholder="Search...">
      </form> -->
    </div>
  </div>
</nav>
