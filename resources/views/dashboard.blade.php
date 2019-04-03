@extends('layouts.app') 
@section('title') {{auth()->user()->name}}'s Dashboard
@endsection
 
@section('content')
<div class="card mb-3">
  <div class="card-body">
    <div class="display-4">Hello, {{auth()->user()->name}}!</div>
  </div>
</div>
<div class="card">
  <div class="card-header">Dashboard</div>
  <div class="card-body">
    @if(count($posts) > 0)
    <table class="table">
      <thead>
        <th>Post</th>
        <th>Created At</th>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
          <td>{{ date('d M Y, g:ia', strtotime($post->created_at)) }}</td>
          <td><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary"><i class="fas fa-pen"></i><span class="d-none d-lg-inline ml-2">Edit</span></a></td>
          <td>
            <button class="btn btn-danger" onclick="prepareDeleteModal('post', '{{$post->title}}', '/posts/{{$post->id}}')"><i class="fas fa-trash"></i><span class="d-none d-lg-inline ml-2">Delete</span></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div id="pagination" style="display: flex; justify-content: center;">{{$posts->links()}}</div>
    @else
    <p class="lead">No posts to show at the moment. Try adding one.</p>
    <a class="btn btn-primary" href="posts/create"><i class="fas fa-plus mr-2"></i>Add Post</a>
    @endif
  </div>
</div>
  @include('inc.delete_confirm')
@endsection