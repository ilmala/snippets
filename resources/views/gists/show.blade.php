@extends('layouts.app')

@section('content')

  <div id="files" title="{{$gist->description}}" files="{{json_encode($gist->files)}}">
    <div class="page-header">
      <h2><input type="text" v-model="title" class="form-control input-lg"></h2>
    </div>
    <sn-file v-for="file in files" :file="file" :index="$index"></sn-file>
  </div>

  <template id="file">
    <div class="row">
      <div class="col-md-10">

        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="input-group">
              <input v-model="file.filename" @keyup="changeName | debounce" class="form-control">
              <span class="input-group-addon">@{{mode}}</span>
            </div>
          </div>
          <div class="">
            <textarea v-el:ed="" v-model="editor" class="form-control">@{{file.content}}</textarea>
          </div>
        </div>

      </div>
      <div class="col-md-2">

        <button class="btn btn-default">Save</button>
        <a :href="file.raw_url" class="btn btn-info">Raw</a>

      </div>
    </div>

    <hr>

  </template>

@endsection

@section('scripts')
  <script src="{{ asset('js/snippet.js') }}"></script>
@endsection
