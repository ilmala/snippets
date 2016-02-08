<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\Github\Gist;

class GistsController extends Controller
{
    public function index(Gist $gist)
    {
      return view('gists.index')->withGists($gist->all());
    }

    public function show(Gist $gist, $id)
    {
      //dd($gist->show($id));
      return view('gists.show')->withGist($gist->show($id));
    }
}
