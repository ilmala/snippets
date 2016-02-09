@extends('layouts.app')

@section('content')

  <div class="container-fluid">

    <a href="{{ route('gists_path') }}"><i class="fa fa-long-arrow-left"></i> Back to list</a>

    <div id="gist" gist-id="{{$gist->id}}" token="{{Auth::user()->github_token}}">

      <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Snippet</button>

      <div class="input-group">
        <input type="text" v-model="description" class="form-control input-lg">
        <span class="input-group-btn">
          <button class="btn btn-info" type="button"><i class="fa fa-check"></i> Save</button>
        </span>
      </div>

      <sn-file v-for="file in files" :file.sync="file" :index="$index"></sn-file>

      <div class="modal fade" v-el:modal="" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add new snippet</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" v-model="newfilename" class="form-control" placeholder="filename ...">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button @click="addFile()" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Add new file</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

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

          <a v-if="file.raw_url" :href="file.raw_url" class="btn btn-default btn-block"><i class="fa fa-file-code-o"></i> Raw file</a>

        </div>
      </div>
    </template>
  </div>

@endsection

@section('scripts')
  <script src="{{ asset('js/snippet.js') }}"></script>
@endsection
