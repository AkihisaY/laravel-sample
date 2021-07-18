@section('header')
<header class="header">
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
      @if(Session::get('user_name') != '')
        <a class="navbar-brand" href="/data/top">
      @else
        <a class="navbar-brand" href="/data/logout">
      @endif
        <i class="fas fa-street-view"></i> PersonalInfo
      </a>

      <button class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarToogleContent"
          aria-controls="navbarToogleContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @if(Session::get('user_name') != '')
      <div class="collapse navbar-collapse" id="navbarToogleContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/data/analysis"><i class="fas fa-chart-pie"></i> Analysis</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/data/api"><i class="fas fa-key"></i> Apikey</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/data/document"><i class="fas fa-folder-open"></i> Document</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                  {{ Session::get('user_name') }}({{ Session::get('user_id') }})
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Menu</a>
                      <a class="dropdown-item" href="/data/logout">Logout</a>
                  </div>
          </li>
        </ul>
      </div>
      @endif
  </nav>
</header>
@endsection
