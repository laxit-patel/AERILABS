<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white shadow-primary" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">

            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <img  class=" img-thumbnail img-circle" src="{{ asset('argon') }}/img/brand/blue.png">
                <hr>
                <!-- Navigation -->
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text"> {{ __('Dashboard') }}</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/inward">
                            <i class="fas fa-sign-in-alt text-red"></i>
                            <span class="nav-link-text"> {{ __('Inwards') }}</span>
                        </a>
                    </li>


                    <hr>



                </ul>


            </div>
        </div>
    </div>
</nav>