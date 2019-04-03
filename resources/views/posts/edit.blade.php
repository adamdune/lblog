@extends('layouts.app') 

@section('title', 'Edit Post')

@section('content')
<h2>Edit Post</h2>
<form action="/posts/{{$post->id}}" method="post">
  {{method_field('PUT')}} 
  @csrf
  <div class="form-group">
    <label for="input-title">Title</label>
    <input type="text" name="title" id="input-title" class="form-control" value="{{$post->title}}">
  </div>
  <div class="form-group">
    <label for="input-body">Post Body</label>
    <textarea name="body" id="input-body" class="form-control">{{$post->body}}</textarea>
  </div>
  <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save mr-2"></i>Save</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
  .create( document.querySelector( '#input-body' ), {
    removePlugins: [ 'ImageUpload' ],
    placeholder: 'So, what\'s up?'
  })
  .catch( error => {
    console.log( error );
  });
</script>
@endsection