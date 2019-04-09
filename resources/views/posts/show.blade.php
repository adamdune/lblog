@extends('layouts.app') 
@section('title') {{$post->title}}
@endsection
 
@section('content')
<?php
    if(isset($_COOKIE['user_tz_off'])){
      $timezone_offset = $_COOKIE['user_tz_off'] * 3600;
    } else {
      $timezone_offset = 0;
    }
  ?>
  <style>
    :root {
      --img-size: 50px;
    }

    .img__comment {
      height: var(--img-size);
      width: var(--img-size);
    }

    .div__comment-profile {
      display: flex;
      flex-direction: row;
    }

    .div__comment-profile :nth-child(2) {
      width: 100%;
    }

    .div__comment-profile :nth-child(3),
    .div__comment-profile :nth-child(4) {
      align-self: flex-start;
      white-space: nowrap;
    }

    .div__comment-container {
      padding-left: var(--img-size);
    }

    .d-flex {
      display: flex;
    }


    .d-flex :nth-child(1) {
      word-break: break-all;
    }

    .d-flex :nth-child(2) {
      flex-shrink: 0;
    }
  </style>
  <div class="card mb-3">
    <div class="card-body">
      @auth 
      @if(Auth::user()->id === $post->user_id)
      <div class="d-flex">
        <div>
          <h3 class="card-title">{{$post->title}}</h3>
        </div>
        <div class="mx-2">
          <a class="btn btn-secondary" href="/posts/{{$post->id}}/edit"><i class="fas fa-pen"></i><span class="d-none d-lg-inline ml-2">Edit</span></a>
          <button class="btn btn-danger" onclick="prepareDeleteModal('post', '{{$post->title}}', '/posts/{{$post->id}}')"><i class="fas fa-trash"></i><span class="d-none d-lg-inline ml-2">Delete</span></button>
        </div>
      </div>
      @else
      <h3 class="card-title">{{$post->title}}</h3>
      @endif 
      @endauth 
      @guest
      <h3 class="card-title">{{$post->title}}</h3>
      @endguest
      <small>Written By: 
        <a href="/profile/{{$post->user->id}}">
          {{$post->user->name}}
        <img src="{{$post->user->profile_picture}}" style="height: 2rem; width 2rem;" class="rounded ml-2">
      </a>
    </small>
      <br>
      <small><i class="fas fa-clock mr-1 text-info"></i><span class="text-muted">{{ date('d M Y, g:ia', strtotime($post->created_at) + $timezone_offset)}}</span></small>      
      @if($post->edited)
      <small data-toggle="tooltip" data-placement="top" title="Last Edited On: {{ date('d M Y, g:ia', strtotime($post->updated_at) + $timezone_offset) }}"><span class="text-info">(Edited)</span>
    </small> 
    @endif
      <p class="mt-3">
        {!!$post->body!!}
      </p>
    </div>
  </div>
  {{-- Comment Section --}}
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Comments</h3>
      @auth
      <form action="/comments" method="post" class="mb-3">
        @csrf
        <div class="mb-2">
          <textarea name="comment" id="input-comment" class="form-control"></textarea>
        </div>
        <input type="hidden" name="post_id" value={{$post->id}}>
        <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
      </form>
      @endauth 
      @if(count($post->comments) > 0)
      <ul class="list-group">
        @foreach($post->comments as $comment)
        <li class="list-group-item" id="comment-{{$comment->id}}">
          <div class="div__comment-profile">
            <a href="/profile/{{$comment->user->id}}">
            <img src="{{$comment->user->profile_picture}}" alt="" class="img__comment mr-2 rounded">
          </a>
            <div>
              <a href="/profile/{{$comment->user->id}}">
                <h6 class="mb-0">{{$comment->user->name}}</h6>
              </a>
              <p class="mb-0">
                <small><i class="fas fa-clock mr-1 text-info"></i><span class="text-muted">{{ date('d M Y, g:ia', strtotime($comment->created_at) + $timezone_offset) }}</span>
              </small> 
              @if($comment->edited)
                <small data-toggle="tooltip" data-placement="top" title="Last Edited On: {{ date('d M Y, g:ia', strtotime($comment->updated_at) + $timezone_offset) }}"><span class="text-info">(Edited)</span>
                </small> 
                @endif
              </p>
            </div>
            @auth 
            @if(Auth::user()->id === $comment->user_id)
            <button class="btn btn-secondary mr-2" onclick="editComment('{{$comment->id}}')">
              <i class="fas fa-pen"></i><span class="d-none d-lg-inline ml-2">Edit</span>
            </button>
            <button class="btn btn-danger" onclick="prepareDeleteModal('comment', '', '/comments/{{$comment->id}}')"><i class="fas fa-trash"></i><span class="d-none d-lg-inline ml-2">Delete</span></button>            
            @endif 
            @endauth
          </div>
          <div class="div__comment-container ml-2" data-comment="">
            {!! $comment->comment !!}
          </div>
        </li>
        @endforeach 
        @auth
        <form action="/comments/" method="post" class="mb-3" style="display: none;" id="form-comment-edit">
          @csrf @method('PUT')
          <div class="mb-2">
            <textarea name="comment" id="input-comment-edit" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Save</button>
        </form>
        @endauth
      </ul>
      @else
      <p class="lead">There are no comments to show.</p>
      @endif
    </div>
  </div>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  // Create Comment
  if (document.getElementById('input-comment')){
    ClassicEditor.create(document.getElementById('input-comment'), 
    {
      removePlugins: [ "ImageUpload", "MediaEmbed", "Table", "Link", "TableToolbar", "CKFinderUploadAdapter", "CKFinder", "ImageToolbar" ],
      toolbar: [ "heading", "|", "bold", "italic", "numberedList", "bulletedList", "blockQuote", "|", "undo", "redo" ],
      placeholder: 'Share your thoughts'
    })
    .catch( error => {
      console.log( error );
    });
  }

  // Edit Comment
  if (document.getElementById('input-comment-edit')){    
  let commentEditor;
  ClassicEditor.create(document.getElementById('input-comment-edit'), 
  {
    removePlugins: [ "ImageUpload", "MediaEmbed", "Table", "Link", "TableToolbar", "CKFinderUploadAdapter", "CKFinder", "ImageToolbar" ],
    toolbar: [ "heading", "|", "bold", "italic", "numberedList", "bulletedList", "blockQuote", "|", "undo", "redo" ],
    placeholder: 'Share your thoughts'
  })
  .then(editor =>{
    commentEditor = editor;
  })
  .catch( error => {
    console.log( error );
  });
  
  function editComment(id){
    commentEditor.data.set($(`#comment-${id} [data-comment]`)[0].innerHTML);

    $('#form-comment-edit').attr('action',  $('#form-comment-edit').attr('action') + id);
    $('#form-comment-edit').css("display", "block").appendTo($(`#comment-${id} [data-comment]`)[0]);
    }
  }
  </script>
  @include('inc.delete_confirm')
@endsection