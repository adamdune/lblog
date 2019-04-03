@extends('layouts.app') 
@section('content')
<div class="content">
  <style>
    .div__jumbo-img {
      background: url(https://images.pexels.com/photos/1007025/pexels-photo-1007025.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
      background-position: center;
      background-size: 100% auto;
    }
  </style>
  @if($posts->onFirstPage())
  <div class="jumbotron div__jumbo-img">
    <div class="display-4">Welcome to LBlog</div>
    <p class="lead">Read Thoughts, Say Words</p>
    <a class="btn btn-primary" href="/register">Register</a>
    <a class="btn btn-secondary" href="/about">About This App</a>
  </div>
  @endif 
  @if(count($posts) > 0)
  <?php
    if(isset($_COOKIE['user_tz_off'])){
      $timezone_offset = $_COOKIE['user_tz_off'] * 3600;
    } else {
      $timezone_offset = 0;
    }
  ?>  
  @foreach($posts as $post)
    @include('inc.post_item') 
  @endforeach
    <div id="pagination" style="display: flex; justify-content: center;">{{$posts->links()}}</div>
    @else
  <div class="card">
    <div class="card-body">
      <p class="lead">
        Sorry, there's no posts to show at the moment.
      </p>
    </div>
  </div>
  @endif
</div>
@endsection