
<div class="fixed mt-5 d-none d-lg-block">
    
    <input type="checkbox" id="check">
     <!--sidebar-start-->
     <div class="sidebar d-flex flex-column justify-content-around align-items-start" >
         
         <a href="/dashboard"><i class="fas fa-desktop"></i><span><!--&nbsp;-->Dashboard</span></a>
         <a href="/analytics"><i class="fas fa-chart-line"></i><span>Analytics</span></a>
         <a href="/events"><i class="far fa-calendar-check"></i><span>Events</span></a>
         @if(auth()->user()->access_id=='aa')
         <a href="/marketing"><i class="fas fa-comment-dollar"></i><span>Marketing</span></a>
         @endif
         <a href="/blogs"><i class="fas fa-blog"></i><span>Blogs</span></a>
         <a href="/media"><i class="fas fa-photo-video"></i><span>Media</span></a>
         <a href="/teams"><i class="fas fa-users"></i><span>Teams</span></a>
         
         <label for="check">
            <i class="fas fa-angle-right" id="sidebar_btn"></i>
         </label>
     
     </div>
</div>
     <!--sdiebar-end-->

     <!-- Sidebar Toggle-->
   <div class="collapse navbar-collapse d-lg-none fixed-top" id="sidebar-toggle">
    <ul class="navbar-nav mr-auto py-2">
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
     <li class="nav-item">
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
