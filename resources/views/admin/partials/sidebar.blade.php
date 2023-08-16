<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        @if($settings->public_logo==null)
            <img class="img-thumbnail "
                 src="{{url('logo/logo-white.png')}}" alt="Logo"
                 style="opacity: .8">
        @else
            <img class="img-thumbnail "
                 src="{{asset('logo/'.$settings->public_logo) ?? '' }}" alt="Logo"
                 style="opacity: .8">
        @endif


    </a>
@php  $seekerss = \App\Seeker::where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
        $recruiterss = App\Recruiter::where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
         @endphp
    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item has-treeview">
                    <a href="{{url('admin/home')}}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/stats')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Stats</p>
                    </a>
                </li>

                @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'Seo')



                    <li class="nav-item">
                        <a href="{{url('admin/seo')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Seo</p>
                        </a>
                    </li>





                @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'admin')

                <li class="nav-header">Settings</li>
                <li class="nav-item">
                    <a href="{{url('admin/analytics')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Analytics</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>General
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/users')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/settings')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/change-password')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Essentials
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/skills')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Skills</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/industries')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Industries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/cities')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cities</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/pages')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{url('/admin/packages')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Package</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{url('admin/seo')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seo</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/coupons')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coupons</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/blogs')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blogs</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/all-portals')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>All Portals Stats</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/bugs')}}" class="nav-link">
                        <i class="nav-icon fas fa-bug"></i>
                        <p>Bugs Report</p>
                    </a>
                </li>


                <li class="nav-header">Seekers</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Seekers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        <span class="right badge badge-danger">New {{count($seekerss) ?? '0'}}</span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/seekers')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/cvs')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cvs</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-header">Recruiter</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Recruiter
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        <span class="right badge badge-danger">New {{count($recruiterss) ?? '0'}}</span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/recruiter')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Companies</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/orders')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>




                    </ul>
                </li>

                <li class="nav-header">Jobs</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Jobs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        <span class="right badge badge-danger"></span>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/jobs')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jobs</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/job-alerts')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Job Alerts</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-header">Contacts</li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Contacts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/contact-us')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/newsletter')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Newsletters</p>
                            </a>
                        </li>


                    </ul>
                </li>

                    <li class="nav-header">Advertisement</li>
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Advertisement
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('admin/advertisement')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Advertisement</p>
                                </a>
                            </li>



                        </ul>
                    </li>



<br>
<br>
<br>
<br>



                @else

                    <li class="nav-item">
                        <a href="{{url('admin/sales')}}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Sales</p>
                        </a>
                    </li>

                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
