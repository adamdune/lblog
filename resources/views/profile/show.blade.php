@extends('layouts.app') 
@section('content')
<?php
if(isset($_COOKIE['user_tz_off'])){
  $timezone_offset = $_COOKIE['user_tz_off'] * 3600;
} else {
  $timezone_offset = 0;
}
?>
<style>
  .btn__unstyle {
    border: none;
    margin: 0;
    padding: 0;
  }

  .btn__editProfilePicture {
    position: relative;
    background-clip: padding-box;
    border: 7.5px solid rgba(255,64,129,0.25);
    transition: border-color 0.5s linear 0s;
  }

  .btn__editProfilePicture:hover {
    border: 7.5px solid rgba(255,64,129,1);
  }

  .div__in-image {
    background-color: none;
    color: #fff;
    font-size: 32px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  .div__in-image:hover {
    font-size: 36px;
    transition: font-size 0.5s linear 0s;
  }

  .img__profile-picture-border{
    border: 7.5px solid rgba(255,64,129,0.5);
  }

  .img__lower-opacity {
    opacity: 0.70;
  }

  .div__bg-black{
    background: black;
  }

  .img__editProfilePicture {
    border: 0px solid var(--primary);
    transition: border-width 0.25s ease-out 0s;
  }

  .img__editProfilePicture:hover {
    border: 5px solid var(--primary);
  }
</style>
<div class="card">
  <div class="card-body">
    <div class="row m-2">
      <div class="col-12 col-md-4 mb-3">
        <img src="{{$user->profile_picture}}" alt="" class="img-fluid rounded img__profile-picture-border" id="profile-picture">
        <h3 class="card-title my-2" id="name" style="line-height: 44px;">{{$user->name}}</h3>
        @auth
        @if(Auth::user()->id === $user->id)
        <form action="/profile/{{$user->id}}" id="edit-profile-form" method="post" class="d-none">
          @csrf @method('PUT')
          <button class="btn__unstyle btn__editProfilePicture rounded" data-toggle="modal" data-target="#modal-profile-picture" id="trigger-profile-picture" onclick="event.preventDefault()">
          <div class="div__bg-black rounded">
              <img src="{{$user->profile_picture}}" alt="" class="img-fluid img__lower-opacity rounded" id="profile-picture-edit">
          </div>
          <div class="div__in-image">
            <p>Change Profile Picture</p>
          </div>
          </button>
          <div id="input-name-div">
            <input type="text" class="form-control my-2" id="input-name" name="name" style="font-size: 1.5rem;">
          </div>
          <input type="hidden" name="profile_picture" value="{{$user->profile_picture}}" id="input-profile-picture">
        </form>
        @endif
        @endauth
        <p>Blog Posts: {{$user->posts->total()}}</p>
        <p>Comments: {{count($user->comments)}}</p>
        <p>Joined: {{ date('d M Y', strtotime($user->created_at) + $timezone_offset) }}</p>
        @auth 
        @if(Auth::user()->id === $user->id)
        <button class="btn btn-secondary" onclick="editProfileInit()" id="edit-btn"><i class="fas fa-pen mr-2"></i>Edit Profile</button>
        <div id="edit-btn-container" class="d-none">
          <button class="btn btn-success" onclick="editProfileSave()"><i class="fas fa-save mr-2"></i>Save Changes</button>
          <button class="btn btn-danger" onclick="editProfileCancel()"><i class="fas fa-times mr-2"></i>Cancel</button>
        </div>
        @endif 
        @endauth
      </div>
      <div class="col-12 col-md-8">
        @if(count($user->posts) > 0) 
        @foreach($user->posts as $post)
          @include('inc.post_item')
        @endforeach 
        <div id="pagination" style="display: flex; justify-content: center;">{{$user->posts->links()}}</div>
        @else
        @auth
        @if(Auth::user()->id === $user->id)
          <p class="lead">You haven't made a post. Try adding one.</p>
          <a class="btn btn-primary" href="posts/create"><i class="fas fa-plus mr-2"></i>Add Post</a>
        @else
          <p class="lead">This user has not made a post.</p>
        @endif
        @endauth
        @guest
          <p class="lead">This user has not made a post.</p>
        @endguest
        @endif
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-profile-picture">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose a Profile Picture</h5>
        <button class="close" data-dismiss="modal">
          <span><i class="fas fa-times"></i><span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          Choose from a range of cute default Twitch profile picture.
        </div>
        <div class="row px-2">
          @foreach (['UU8DI2g.jpg', 'l0o31Tn.png', '6a0LF3N.jpg', 'caHQ0Ht.png','OqJb76V.jpg', 'qWouajd.jpg', 'cyWrrAA.jpg'] as $imgSrc)
          <div class="col-3 px-1 pb-2">
            <img src="https://i.imgur.com/{{$imgSrc}}" alt="" class="img-fluid img__editProfilePicture rounded" onclick="editProfilePictureChange('https://i.imgur.com/{{$imgSrc}}')"
              data-dismiss="modal">
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function editProfileInit(){
    console.log('Edit Profile');
    $('#input-name').val($('#name').text());
    $('#profile-picture-edit').attr('src',$('#profile-picture').attr('src'));

    $('#profile-picture, #name, #edit-btn').addClass('d-none');
    $('#edit-profile-form, #edit-btn-container').removeClass('d-none');
  }

  function editProfilePictureChange(src){
    $('#profile-picture-edit').attr('src', src);
    $('#input-profile-picture').val(src);
  }

  function editProfileSave(){
    $('#edit-profile-form').submit();
  }

  function editProfileCancel(){
    $('#edit-profile-form, #edit-btn-container').addClass('d-none');
    $('#profile-picture, #name, #edit-btn').removeClass('d-none');
  }

</script>
@endsection