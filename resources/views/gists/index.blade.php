@extends('layouts.app')

@section('content')

  <div class="page-header">
    <h2>Gists</h2>
  </div>

  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Description</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach($gists as $gist)
      <tr>
        <td>
          <a href="{{ route('gist_path', $gist->id) }}">
            {{ $gist->description ?: 'no description' }}
          </a>
        </td>
        <td>{{ $gist->created_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
