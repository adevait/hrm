<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">{{ trans('app.toggle_nav') }}</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name', 'HRM') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ $current == 'settings' ? 'active' : ''}}">
          <a href="{{route('settings.index')}}">{{trans('app.settings.main')}} 
            @if($current == 'settings') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'pim' ? 'active' : ''}}">
          <a href="{{route('pim.index')}}">{{trans('app.pim.main')}}
            @if($current == 'pim') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'leave' ? 'active' : ''}}">
          <a href="{{route('leave.index')}}">{{trans('app.leave.main')}}
            @if($current == 'leave') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'time' ? 'active' : ''}}">
          <a href="{{route('time.index')}}">{{trans('app.time.main')}}
            @if($current == 'time') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'recruitment' ? 'active' : ''}}">
          <a href="{{route('recruitment.index')}}">{{trans('app.recruitment.main')}}
            @if($current == 'recruitment') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'discipline' ? 'active' : ''}}">
          <a href="{{route('discipline.index')}}">{{trans('app.discipline.main')}}
            @if($current == 'discipline') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
        <li class="{{ $current == 'dashboard' ? 'active' : ''}}">
          <a href="{{route('dashboard.index')}}">{{trans('app.dashboard.main')}}
            @if($current == 'dashboard') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('profile.index') }}">{{trans('app.profile.main')}}</a></li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{trans('app.logout')}}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>