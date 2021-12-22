<nav id="column-left">



  <div id="navigation"><span class="fa fa-bars"></span> Navigation</div>







  <ul id="menu">



        <li id="menu-dashboard" @if(isset($dashboard) && $dashboard === TRUE) class="active" @endif>



          <a href="{{url('view-petitions')}}"><i class="fa fa-dashboard fw"></i> Dashboard</a>



        </li>



  </ul>


</nav>



