<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{--<li class="nav-item d-none d-sm-inline-block">--}}
            {{--<a href="index3.html" class="nav-link">Home</a>--}}
        {{--</li>--}}
        {{--<li class="nav-item d-none d-sm-inline-block">--}}
            {{--<a href="#" class="nav-link">Contact</a>--}}
        {{--</li>--}}
    </ul>

    @php  $flags = \App\Flag::orderBy('name', 'ASC')->get();  @endphp
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            {{--<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
            {{--<div class="input-group-append">--}}
                {{--<button class="btn btn-navbar" type="submit">--}}
                    {{--<i class="fas fa-search"></i>--}}
                {{--</button>--}}
            {{--</div>--}}
        </div>
    </form>

    <style>
        .dropdown-menu-lg{
            max-width: 700px;
            min-width: 600px;
        }
        .dropdown-menu-lg .dropdown-item{
            width: 180px;
            float: left;
            display: inline-block;
            clear: inherit;
        }
    </style>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                <i class="far fa-comments"></i>--}}
{{--                <span class="badge badge-danger navbar-badge">3</span>--}}
{{--            </a>--}}
{{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                Brad Diesel--}}
{{--                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">Call me whenever you can...</p>--}}
{{--                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                John Pierce--}}
{{--                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">I got your message bro</p>--}}
{{--                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item">--}}
{{--                    <!-- Message Start -->--}}
{{--                    <div class="media">--}}
{{--                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                        <div class="media-body">--}}
{{--                            <h3 class="dropdown-item-title">--}}
{{--                                Nora Silvester--}}
{{--                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>--}}
{{--                            </h3>--}}
{{--                            <p class="text-sm">The subject goes here</p>--}}
{{--                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Message End -->--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>--}}
{{--            </div>--}}
{{--        </li>--}}
        <!-- Notifications Dropdown Menu -->
        @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'admin')
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-forward"></i>
{{--                <span class="badge badge-warning navbar-badge">15</span>--}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
{{--                <span class="dropdown-item dropdown-header">15 Notifications</span>--}}
{{--                <div class="dropdown-divider"></div>--}}

                @foreach ($flags as $flag)
                    <a class="dropdown-item" href="https://{{ "$flag->url".'/admin-login'}}?email=admin@fratres.net&password=admin@fratres@2020"
                       onclick="

                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-forward mr-2"></i>{{$flag->name}}
                    </a>
                    <form id="logout-form{{$flag->name}}" action="https://{{ "$flag->url".'/admin-login'}}?email=admin@fratres.net&password=admin@fratres@2020" method="get" style="display: none;">
                        @csrf
                    </form>
                @endforeach



                {{--<div class="dropdown-divider"></div>--}}
                {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fas fa-users mr-2"></i> 8 friend requests--}}
                    {{--<span class="float-right text-muted text-sm">12 hours</span>--}}
                {{--</a>--}}
                {{--<div class="dropdown-divider"></div>--}}
                {{--<a href="#" class="dropdown-item">--}}
                    {{--<i class="fas fa-file mr-2"></i> 3 new reports--}}
                    {{--<span class="float-right text-muted text-sm">2 days</span>--}}
                {{--</a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
            </div>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item">asdasd</a>
                <a class="dropdown-item">asdasd</a>
                <a class="dropdown-item">asdasd</a>
            </div>
        </li>
        @endif
        {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">--}}
                {{--<i class="fas fa-th-large"></i>--}}
            {{--</a>--}}
        {{--</li>--}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 105px;">
                {{--<div class="dropdown-divider"></div>--}}
                {{--<div class="dropdown-divider"></div>--}}
                {{--<a href="#" class="dropdown-item">--}}
                  {{----}}
                    {{--<div class="media">--}}
                        {{--<div class="media-body">--}}
                            {{--<h3 class="dropdown-item-title">--}}
                                {{--Nora Silvester--}}
                                {{--<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>--}}
                            {{--</h3>--}}
                            {{--<p class="text-sm">The subject goes here</p>--}}
                            {{--<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                  {{----}}
                {{--</a>--}}
                {{--<div class="dropdown-divider"></div>--}}
                <a href="{{url('admin/logout')}}" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        </li>
    </ul>
</nav>