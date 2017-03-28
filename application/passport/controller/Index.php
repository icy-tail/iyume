<?php
namespace app\passport\controller;

use \app\model\User;
use \think\Session;
use \think\Controller;

class Index extends Controller
{
	public function index() {}
	public function login() {
		$userid = $_POST['userid'];
		$password = $_POST['password'];
		$user = User::get(['userid' => $userid]);
		$result = array();
		if($user){
			if($user->password == $password){
				$result['status'] = 'success';
				$result['username'] = $user->username;
				$this->loginsuccess($user);
			}else{
				$result['status'] = 'error';
			}
		}else{
			$result['status'] = 'miss';
		}
		return json($result);
	}
	private function loginsuccess($user){
		Session::set('userinfo', $user);
	}
	public function logout() {
		Session::delete('userinfo');
		$this->success('已登出', 'http://iyume.cn');
	}
}
