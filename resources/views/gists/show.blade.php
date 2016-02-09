@extends('layouts.app')

@section('content')

  <div class="container-fluid">

    <a href="{{ route('gists_path') }}"><i class="fa fa-long-arrow-left"></i> Back to list</a>

    <div id="gist" gist-id="{{$gist->id}}" token="{{Auth::user()->github_token}}">

      <button @click="addFile()" class="btn btn-info" type="button"><i class="fa fa-plus"></i> Add Snippet</button>

      <div class="input-group">
        <input type="text" v-model="description" class="form-control input-lg">
        <span class="input-group-btn">
          <button class="btn btn-info" type="button"><i class="fa fa-check"></i> Save</button>
        </span>
      </div>

      <sn-file v-for="file in files" :file="file" :index="$index" :key="$key"></sn-file>

      <div class="notify">
        this is a long text user and other type notification ....
      </div>

    </div>

    <template id="file">
      <hr>
      <div class="row">
        <div class="col-sm-10">

          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="input-group">
                <input v-model="file.filename" @keyup="changeName() | debounce" class="form-control">
                <span class="input-group-addon">@{{mode}}</span>
              </div>
            </div>
            <div class="">
              <textarea v-el:ed="" v-model="file.content" class="form-control"></textarea>
            </div>
          </div>

        </div>
        <div class="col-sm-2">

          <a :href="file.raw_url" class="btn btn-default btn-block"><i class="fa fa-file-code-o"></i> Raw file</a>

        </div>
      </div>
    </template>
  </div>

@endsection

@section('scripts')
  <script src="{{ asset('js/snippet.js') }}"></script>
@endsection
