<div class="card mb-2">
  <div class="card-body">
    <a href="/posts/{{$post->id}}">
      <h4 class="card-title">{{$post->title}}</h4>
    </a>
    <p class="mb-0">
      Written By:
      <a href="/profile/{{$post->user->id}}">
              {{$post->user->name}}
            <img src="{{$post->user->profile_picture}}" style="height: 2rem; width 2rem;" class="rounded ml-2">
      </a>
    </p>
    <small><i class="fas fa-clock mr-2 text-info"></i>{{ date('d M Y', strtotime($post->created_at) + $timezone_offset) }}</small>
  </div>
</div>