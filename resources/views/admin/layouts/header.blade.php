<header class="main-header" style="padding: 10px 0;">
    <div class="container-fluid">
        <nav class="navbar site-navbar" style="margin-bottom: 0" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#blog-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('admin.index') }}" class="navbar-brand">Admin</a>
            </div>
            <div class="collapse navbar-collapse" id="blog-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('post.create') }}">@lang('xblog.post_create')</a></li>
                    <li><a href="{{ route('admin.images') }}">@lang('xblog.images')</a></li>
                    <li><a href="{{ route('admin.files') }}">@lang('xblog.files')</a></li>
                    <li><a href="{{ route('admin.settings') }}">@lang('xblog.settings')</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('post.index') }}">@lang('xblog.home')</a></li>
                                <li><a href="{{ route('user.show',auth()->user()->name) }}">@lang('xblog.profile')</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        @lang('xblog.logout')
                                    </a></li>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('login') }}">@lang('xblog.login')</a></li>
                        <li><a href="{{ url('register') }}">@lang('xblog.register')</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>