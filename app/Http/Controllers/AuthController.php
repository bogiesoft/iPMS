<?php

namespace iPMS\Http\Controllers;

use Auth;
use iPMS\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function getRegister()
	{
		return view('auth.register')->with('useGuest', true);
	}

	public function getLogin()
	{
		return redirect()->route('index');
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

		return redirect()->route('index')
			->withInfo('계정이 생성 되었습니다. 관리자 승인 후 사용할 수 있습니다.');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'uid' => 'required',
			'password' => 'required'
		]);

		$authStatus = Auth::attempt($request->only(['uid', 'password']), $request->has('remember'));
		if (!$authStatus)
			return redirect()->back()->with('error', 'User ID 와 Password가 일치하지 않습니다.');

		if (Auth::user()->group == '-1') {
			Auth::logout();
			return redirect()->back()->with('error', '미승인 사용자입니다. 관리자에게 문의하십시오.');
		}

		return redirect()->route('dashboard');
	}

	public function logOut()
	{
		Auth::logout();
		return redirect()->route('index');
	}
}
