@extends('layouts.app') 

@section('title', 'About') 

@section('content')
<style>
  .ul-disc li {
    list-style-type: disc;
  }
</style>
<div class="card">
  <div class="card-body">
    <h3 class="card-title text-center">About This Application</h3>
    <blockquote class="py-2 pl-4" style="border-left: 5px solid var(--primary);">
      <h5 class="my-1">Coded with &#10084;&#65039; & &#9749; by Adam Ho</h5>
    </blockquote>
    <ul class="ul-disc">
      <li>
        This application is primarily built using the <a href="https://laravel.com/">Laravel</a> framework and it's built-in
        tools including:
        <ul>
          <li>
            <a href="https://laravel.com/docs/5.8/blade">Blade Templates</a>
          </li>
          <li>
            <a href="https://laravel.com/docs/5.8/eloquent">Eloquent ORM</a>
          </li>
          <li>
            <a href="https://laravel.com/docs/5.8/artisan">Artisan CLI</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="https://www.postgresql.org/">PostgreSQL</a> was used as the database manager because...well, it was free on Heroku. (MySQL was used initially.)
      </li>
      <li>
        Styled using <a href="https://getbootstrap.com/">Bootstrap</a> with minor variable customization.
      </li>
      <li>
        <a href="https://ckeditor.com/">CKEditor</a> was used as the WYSIWYG Editor.
      </li>
    </ul>
    <h6>Source code can be found on <a href="https://github.com/adamdune/lblog">GitHub<i class="fab fa-github ml-1"></i></a>.</h6>
  </div>
</div>
@endsection