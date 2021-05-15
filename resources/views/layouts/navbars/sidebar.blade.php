<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a href="{{ route('home') }}">
            {{-- <img src="{{ asset('argon') }}/img/brand/blue.png"> --}}
            <img src="{{ asset('argon') }}/img/brand/Kampus.png" width="100%">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <!-- Profile IMG -->
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    {{-- <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a> --}}
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            {{-- <img src="{{ asset('argon') }}/img/brand/blue.png"> --}}
                            <img src="{{ asset('argon') }}/img/brand/Kampus.png"  width="200px">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Search -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-chart-bar-32 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-official" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-official">
                        <i class="fas fa-user-tie" style="color: gray;"></i>
                        <span class="nav-link-text">{{ __('Officials') }}</span>
                    </a>
                    <div class="collapse" id="navbar-official">
                        <ul class="nav nav-sm flex-column">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li> --}}
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('client') }}">
                                    <i class="fas fa-user-tie"></i> {{ __('Directors') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-tie"></i> {{ __('Rectors') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-staff">
                        <i class="fas fa-users" style="color: #11cdef;"></i>
                        <span class="nav-link-text">{{ __('Staffs') }}</span>
                    </a>
                    <div class="collapse" id="navbar-staff">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user"></i> {{ __('Deans') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user"></i> {{ __('Lecturers') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user"></i> {{ __('Administrators') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-academic" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-academic">
                        <i class="fas fa-graduation-cap" style="color: #2dce89;"></i>
                        <span class="nav-link-text">{{ __('Academic') }}</span>
                    </a>
                    <div class="collapse" id="navbar-academic">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-graduate"></i> {{ __('Students') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-atom"></i> {{ __('Faculties & Research') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="ni ni-books"></i> {{ __('Courses') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('icons') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __('Maps') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('table') }}">
                      <i class="ni ni-bullet-list-67 text-default"></i>
                      <span class="nav-link-text">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li> --}}
            </ul>
            <!-- Divider -->
            {{-- <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>
