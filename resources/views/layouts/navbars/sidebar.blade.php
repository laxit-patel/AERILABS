@auth()

    @if(  Auth::user()->role == 'admin'  )
        @include('layouts.navbars.sidenavs.adminSidenav')
    @elseif(  Auth::user()->role == 'engineer' )
        @include('layouts.navbars.sidenavs.engineerSidenav')
    @elseif(  Auth::user()->role == 'accountant' )
        @include('layouts.navbars.sidenavs.accountSidenav')
    @elseif(  Auth::user()->role == 'employee' )
        @include('layouts.navbars.sidenavs.employeeSidenav')
    @endif

@endauth



@guest()
    @include('layouts.navbars.navs.guest')
@endguest