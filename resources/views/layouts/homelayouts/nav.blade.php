<!--header-->
<header id="site-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark stroke p-0">
            <h1> <a class="navbar-brand" href="{{url('/')}}">
                    Publication
                </a></h1>
   
            <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @if(!Auth::check())
                    <li class="nav-item @@about-active">
                        <a class="nav-link" href="{{url('/login')}}">Login</a>
                    </li> 
                    <li class="nav-item @@about-active">
                        <a class="nav-link" href="{{url('/register')}}">Register</a>
                    </li>
                    @else
                    <li class="nav-item @@about-active">
                        <a class="nav-link" href="#">Wellcome. {{ Auth::user()->name }}</a>
                    </li>    
                    <li class="nav-item @@about-active">
                        <a class="nav-link" href="{{url('/userLogout')}}">Logout</a>
                    </li>
                    @endif
                 
                </ul>
                <!--/search-right-->
             
            </div>

            <!-- toggle switch for light and dark theme -->
            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox" style="display: none;">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>
            <!-- //toggle switch for light and dark theme -->
        </nav>
    </div>
</header>
<!--/header-->
<!-- Domain Modal -->
<div class="modal right fade" id="DomainModal" tabindex="-1" role="dialog" aria-labelledby="DomainModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content right-toggle-bg">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <div class="modal-body">
                <div class="modal__content">
                    <h2 class="logo"><a class="logo-brand" href="index.html">
                            Petitions
                        </a></h2>

                    <p class="mt-md-3 mt-2">Lorem ipsum dolor sit amet, elit. Eos expedita ipsam at fugiat ab.</p>
                    <div class="widget-menu-items mt-sm-5 mt-4">
                        <h5 class="widget-title">Menu Items</h5>
                        <nav class="navbar p-0">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('/')}}">Home</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- //modal-content -->
    </div>
    <!-- //modal-dialog -->
</div>
<!-- //Domain modal -->

