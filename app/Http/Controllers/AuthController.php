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
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required|min:6',
		]);

		User::create([
			'uid' => $request->input('uid'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		]);

		return redirect()
			->route('index')
			->withInfo('Your account has been created and you can now sign in');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'uid' => 'required',
			'password' => 'required'
		]);

		$authStatus = Auth::attempt($request->only(['uid', 'password']), $request->has('remember'));
		if (!$authStatus) {
			return redirect()->back()->with('info', 'Invalid Email or Password');
		}

		return redirect()->route('index')->with('info', 'You are now signed in');
	}
}
