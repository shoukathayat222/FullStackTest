<header id="header" class="navbar navbar-static-top">  <div class="container-fluid">       <a href="#" id="button-menu" class="hidden-md hidden-lg"><span class="fa fa-bars"></span></a>    <ul class="nav navbar-nav navbar-right">      <li class="dropdown">        <a href="#" class="dropdown-toggle" data-toggle="dropdown">            <img src="{{ asset('/black_rock_assets/images/logo.svg') }}"  height="50" width="40" alt="John Doe" title="admin" id="user-profile" class="img-circle" />{{ Auth::user()->name }}            <i class="fa fa-caret-down fa-fw"></i>        </a>        <ul class="dropdown-menu dropdown-menu-right">          
	{{-- <li><a href="{{ url('my-profile') }}"><i class="fa fa-user-circle-o fa-fw"></i> Your Profile</a></li>          
	<li><a href="{{ url('settings') }}"><i class="fa fa-gear fa-fw "></i> Change Password</a></li>  --}}         
	<li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Log Out</a></li>        
</ul>      </li>         </ul>     </div></header>