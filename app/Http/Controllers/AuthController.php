<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;

use App\User;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest', ['except'=>['logout']]);
  }

  public function login()
  {
    return view('auth.login');
  }

  public function logout()
  {

    auth()->logout();

    return redirect('/');

  }

  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return Response
   */
  public function redirectToProvider()
  {
      return Socialite::driver('github')
          //->scopes(['user'])
          ->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @return Response
   */
  public function handleProviderCallback()
  {
      $gitUser = Socialite::driver('github')->user();

      $user = User::firstOrNew([
        //'github_token' => $gitUser->token,
        'username' => $gitUser->nickname,
        'name' => $gitUser->name,
        'email' => $gitUser->email
      ]);

      $user->github_token = $gitUser->token;
      $user->save();

      auth()->login($user);

      return redirect('/gists');
  }
}
