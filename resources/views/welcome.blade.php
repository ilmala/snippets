@extends('layouts.app')

@section('content')

  <div class="jumbotron">
    <div class="container">
      <h1>My Snippet</h1>
      <p>Easy gists snippets continer.</p>

      <a href="auth/github" class="btn-github-login">
        <img src="{{ asset('img/GitHub-120.png')}}" alt="GitHub login">
        Login with github
      </a>
    </div>
  </div>

@endsection
