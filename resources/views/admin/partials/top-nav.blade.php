<!-- Top Bar Start -->
<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <!-- App Notifications -->
            @if(auth()->user()->unreadNotifications()->count() > 0)
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i data-feather="bell" class="align-self-center topbar-icon"></i>
                    <span class="badge badge-danger badge-pill noti-icon-badge">{{auth()->user()->unreadNotifications()->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">

                    
                    <div class="notification-menu" data-simplebar>

                        @foreach(auth()->user()->unreadNotifications as $notification)

                            <!-- item-->
                            <a href="#" class="dropdown-item py-3">
                                <small class="float-right text-muted pl-2">{{$notification->created_at->format(' M d, h:i A')}}</small>
                                <div class="media">
                                    
                                    <div class="media-body align-self-center ml-2 text-truncate">
                                        <h6 class="my-0 font-weight-normal text-dark">{{$notification->data['title']}}</h6>
                                        <small class="text-muted mb-0">{{$notification->data['body']}}</small>
                                    </div><!--end media-body-->
                                </div><!--end media-->
                            </a><!--end-item-->

                        @endforeach
                        
                    </div>
                    <!-- All-->
                    <a href="{{route('notification.index')}}" class="dropdown-item text-center text-primary">
                        View All <i class="fi-arrow-right"></i>
                    </a>
                    
                </div>
            </li>
            @endif

            <!-- Usere Info Area -->
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">

                    @if(Auth::user()->firstName)
                        <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->firstName }},{{Auth::user()->lastName }}</span>
                    @else
                        <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->email }}</span>
                    @endif


                    @if(!Auth::user()->avatar_url)
                        @if(Auth::user()->firstName)
                            <div class="avatar-box thumb-sm align-self-center mt-2">
                                <span class="avatar-title bg-soft-pink rounded-circle">{{substr(Auth::user()->firstName, 0, 1) . substr(Auth::user()->lastName, 0, 1)}}</span>
                            </div>
                        @else
                            <div class="avatar-box thumb-sm align-self-center mt-2">
                                <span class="avatar-title bg-soft-pink rounded-circle">{{substr(Auth::user()->email, 0, 2)}}</span>
                            </div>
                        @endif
                    @else
                        <img src="{{auth()->user()->avatar_url ? auth()->user()->avatar_url : asset('public/admin/assets/images/users/user-3.jpg')}}" alt="profile-user" class="rounded-circle thumb-sm" />
                    @endif





                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('setting.index',['type'=>'profile'])}}"><i data-feather="user" class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a>


                    
                        @if(!session('impersonated_by'))
                            @if(auth()->user()->can('IMPERSONATE'))
                                <a class="dropdown-item" href="{{route('impersonate.index')}}"><i data-feather="repeat" class="align-self-center icon-xs icon-dual mr-1"></i> Impersonate</a>
                            @endif

                        @else
                            <a class="dropdown-item" href="{{route('impersonate.leave')}}"><i data-feather="repeat" class="align-self-center icon-xs icon-dual mr-1"></i>Back to LoggedIn User</a>
                        @endif
                    

                    <!-- Logout Button -->
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                        <i data-feather="power" class="align-self-center icon-xs icon-dual mr-1"></i> Logout
                    </a>
                    <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>


                </div>
            </li>

        </ul><!--end topbar-nav-->


        <!-- Shrink Side menu button -->
        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile">
                    <i data-feather="menu" class="align-self-center topbar-icon"></i>
                </button>
            </li>
            
        </ul>



    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->
