<!--Navbar start-->
<nav class="navbar navbar-expand-lg bg-custom fixed-top" id="mainNavbar">
    <a class="navbar-brand" href="#"><span class="text-primary">{{config('app.name','DSC')}}</span></a>

    <form class="row form-inline py-2 py-lg-0 d-lg-none" id="searchBar">
         <input class="col-8 form-control pr-sm-5 d-inline" type="search" placeholder="Search" aria-label="Search">
         <button class="col-2 btn btn-outline-primary mx-1" type="submit"><i class="fas fa-search"></i></button>
    </form>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar-toggle" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
<!--Left side of navbar-->
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item">
       <a class="nav-link" href="#">{{$PageName}}</a>
       </li>
     </ul>

<!--Right side of navbar--> 
     
     <ul class="navbar-nav ml-auto ">
       <form class="form-inline my-2 my-lg-0 mr-2">
         <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
       </form>
       <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope"></i>
        </a>
      <div class="dropdown-menu bg-component" aria-labelledby="navbarDropdown">
       
       <a class="dropdown-item" href="#">
           <div class="d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <div class="d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <div class="d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <div class="d-flex d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <div class="d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       <div class="dropdown-divider"></div>
       <a class="dropdown-item" href="#">
           <div class="d-flex justify-content-around">
               <div class="col-3 d-flex flex-column align-items-center">
                     <i class="fas fa-user-circle"></i>Username
                 </div>
                 <div class="col-7">
                     Message
                 </div>
                 <div class="col-2">
                     22m
                 </div>
             </div>
       </a>
       </div>
       </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i> {{auth()->user()->name}}
        </a>
       <div class="dropdown-menu user-dropdown bg-component" aria-labelledby="navbarDropdown">
       
       <a class="dropdown-item" href="#" >
         <div class="d-flex flex-column justify-content-around align-items-center">
             <i class="fas fa-user-circle userImg"></i>
             <div class="my-2">{{auth()->user()->name}}</div>
         </div>
       </a>
       <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><i class="fas fa-key"></i> Change Password</a>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{-- <button class="btn btn-link">{{ __('Logout') }}</button> --}}
            <i class="fas fa-sign-out-alt"></i> Sign Out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
       </div>
       </li>
     </ul>
    </div>
</div>
</nav>
<!--navbar End-->

<!-- Sidebar Toggle-->
<div class="collapse navbar-collapse d-lg-none fixed-top" id="sidebar-toggle">
    <ul class="navbar-nav mr-auto">
     <li class="nav-item">
     <a href="/analytics"><i class="fas fa-chart-line"></i><span>Analytics</span></a>
     </li>
     @if(auth()->user()->access_id=='aa')
     <li class="nav-item">
     <a href="/marketing"><i class="fas fa-comment-dollar"></i><span>Marketing</span></a>
     </li>
     @endif
     <li class="nav-item">
     <a href="/blogs"><i class="fas fa-blog"></i><span>Blogs</span></a>
     </li>
     <li class="nav-item">
     <a href="/media"><i class="fas fa-photo-video"></i><span>Media</span></a>
     </li>
     <li class="nav-item mb-2">
     <a href="/teams"><i class="fas fa-users"></i><span>Teams</span></a>
     </li>
     <li class="nav-item mb-2">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i><span>Sign Out</span></a>
    </li>
 </ul>
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</div>