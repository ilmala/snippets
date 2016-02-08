@extends('layouts.app')

@section('content')

<div class="github-login">

  <a href="auth/github" class="btn-github-login">
    <img src="{{ asset('img/GitHub-120.png')}}" alt="GitHub login">
    Login with github
  </a>

</div>

@endsection
