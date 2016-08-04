<?php

namespace iPMS\Http\Controllers;

use Auth;
use iPMS\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function getRegister()
	{
		return view('auth.register');
	}

	public function getLogin()
	{
		return view('auth.login');
	}

	public function postRegister(Request $request)
	{
		$this->validate($request, [
			'uid' => 'required|unique:users|alpha_dash|max:20',
			'password' => 'required|min:6',
			'email' => 'required|unique:users|email|max:255',
			'fullname' => 'required|max:255',
		]);

		User::create([
			'uid' => $request->input('uid'),
			'password' => bcrypt($request->input('password')),
			'email' => $request->input('email'),
			'fullname' => $request->input('fullname'),
		]);

		return redirect()
			->route('index')
			->withInfo('Your account has been created and you can now sign in.');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'uid' => 'required',
			'password' => 'required'
		]);

		$authStatus = Auth::attempt($request->only(['uid', 'password']), $request->has('remember'));
		if (!$authStatus) {
			return redirect()->back()
				->with('info', 'Invalid User ID or Password.');
		}

		return redirect()->route('projects.index');
	}

	public function logOut()
	{
		Auth::logout();
		return redirect()->route('index');
	}
}
