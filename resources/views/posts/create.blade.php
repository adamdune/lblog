@extends('layouts.app') 

@section('title', 'Create New Post')

@section('content')
<h2>Create New Post</h2>
<form action="/posts" method="post">
  @csrf
  <div class="form-group">
    <label for="input-title">Title</label>
    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="input-title">
  </div>
  <div class="form-group">
    <label for="input-body">Post Body</label>
    <textarea name="body" id="input-body" class="form-control">{{old('body')}}</textarea>
  </div>
  <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save mr-2"></i>Save</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
  .create( document.querySelector( '#input-body' ), {
    removePlugins: [ "CKFinderUploadAdapter", "CKFinder", "EasyImage", "Image", "ImageCaption", "ImageStyle", "ImageToolbar", "ImageUpload" ],
    toolbar: ["heading", "|", "bold", "italic", "link", "bulletedList", "numberedList", "blockQuote", "|", "insertTable", "mediaEmbed", "|", "undo", "redo"],
    placeholder: 'So, what\'s up?'
  })
  .catch( error => {
    console.log( error );
  });
</script>
@endsection