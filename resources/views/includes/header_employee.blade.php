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
      <a class="navbar-brand" href="{{route('employee.home')}}">{{ config('app.name', 'HRM') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <!-- MENU ITEMS GO HERE -->
      <ul class="nav navbar-nav">
        <li class="{{ $current == 'employee.leaves' ? 'active' : ''}}">
          <a href="{{route('employee.leaves.index')}}"> {{trans('app.leave.main')}}
              @if($current == 'employee.leaves') 
                <span class="sr-only">({{trans('app.current')}})</span>
              @endif
          </a>
        </li>
        <li class="dropdown {{ $current == 'employee.time' ? 'active' : ''}}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{trans('app.time.main')}} <span class="caret"></span>
              @if($current == 'employee.time') 
              <span class="sr-only">({{trans('app.current')}})</span>
              @endif
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{route('employee.time.index')}}">{{trans('app.time.time_logs.main')}}</a></li>
            <li><a href="{{route('employee.time.report')}}">{{trans('app.time.time_logs.report')}}</a></li>
          </ul>
        </li>
        <li class="{{ $current == 'employee.salary' ? 'active' : ''}}">
          <a href="{{route('employee.salary.index')}}"> {{trans('app.employee.salary.main')}}
              @if($current == 'employee.salary')
                <span class="sr-only">({{trans('app.current')}})</span>
              @endif 
          </a>
        </li>
        <li class="{{ $current == 'employee.documents' ? 'active' : ''}}">
          <a href="{{route('employee.documents.index')}}"> {{trans('app.pim.employees.documents.main')}}
              @if($current == 'employee.documents')
                <span class="sr-only">({{trans('app.current')}})</span>
              @endif
          </a>
        </li> 
        <li class="{{ $current == 'employee.dashboard_documents' ? 'active' : ''}}">
          <a href="{{route('employee.dashboard_documents.index')}}">{{trans('app.dashboard.main')}}
            @if($current == 'employee.dashboard_documents') 
              <span class="sr-only">({{trans('app.current')}})</span>
            @endif
            </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
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