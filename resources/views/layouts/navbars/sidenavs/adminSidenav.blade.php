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
                    <a class="nav-link " href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Users') }}</span>
                    </a>

                    <div class="collapse " id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#navbar-invoice" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-invoice">
                        <i class="fas fa-book text-purple" ></i>
                        <span class="nav-link-text" >{{ __('Accounts') }}</span>
                    </a>

                    <div class="collapse " id="navbar-invoice">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/invoice">
                                    {{ __('Invoice') }}
                                </a>
                                <a class="nav-link" href="/ledger">
                                    {{ __('Ledger') }}
                                </a>
                                <a class="nav-link" href="/rates">
                                    {{ __('Rate List') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lab') }}">
                        <i class="fas fa-microscope text-cyan
                        "></i>
                        <span class="nav-link-text"> {{ __('Laboratory') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quotation') }}">
                        <i class="fas fa-money-bill-wave-alt text-teal
                        "></i>
                        <span class="nav-link-text"> {{ __('Quotation') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#navbar-inward" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-inward">
                        <i class="fas fa-sign-in-alt text-red"></i>
                        <span class="nav-link-text" >{{ __('Inwards') }}</span>
                    </a>

                    <div class="collapse " id="navbar-inward">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/inward">
                                    {{ __('Inwards') }}
                                </a>
                                <a class="nav-link" href="/inward/archive">
                                    {{ __('Archive') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="/test">
                        <i class="fas fa-vial text-info"></i>
                        <span class="nav-link-text"> {{ __('Tests') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/material">
                        <i class="fas fa-atom text-orange"></i>
                        <span class="nav-link-text"> {{ __('Materials') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/client">
                        <i class="fas fa-user text-blue"></i>
                        <span class="nav-link-text"> {{ __('Clients') }}</span>
                    </a>
                </li>

                <hr>

                
               
            </ul>
       
           
         </div>
       </div>
     </div>
   </nav>