        
<div class="profile-side">
   <ul class="me-nav">
       <li {{ (Request::is('me') ? 'class="active"' : '') }}><a href="{{ route('me-home')}}">Home</a></li>
       <li {{ (Request::is('me/content') ? 'class="active"' : '') }}><a href="{{ route('my-content') }}">My Content</a></li>
       <li {{ (Request::is('me/edit') ? 'class="active"' : '') }}><a href="{{ route('edit-profile') }}">Edit Profile</a></li>
       <li {{ (Request::is('me/change-password') ? 'class="active"' : '') }}><a href="{{ route('change-password') }}">Change Password</a></li>
   </ul>
</div>