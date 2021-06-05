<?php

namespace App\Controllers;
use App\Libraries\Auth;
use App\Libraries\ApiParser;

class Home extends BaseController
{
	private $authClass;
	private $auth;
	private $action;
	public function __construct()
	{
		$this->authClass = new Auth();
		$this->action = new ApiParser();
		$this->auth = $this->authClass->authCheckKey();
		if (!$this->auth){
			$data["status"]			= 401;
			$data["body"]			= "null";
			$data["massage"]		= "Ooooh. you cant authrization";
			$data["type"]			= "Access Denide";
			echo view("response",$data);
		}
	}

	public function updateAuth()
	{
		if($this->auth)
		{
			$key = $this->authClass->authUpdate();
			$data["status"]			= 200;
			$data["body"]			= $key;
			$data["massage"]		= "success change new key";
			$data["type"]			= "seccess";
			return view("response",$data);
		}
		
	}

	public function igUserPost(){
		if ($this->auth){
			$username = $this->request->getPost("username");
			$result = $this->action->insta_userPost($username);
			if ($result){
				$data["status"]			= 200;
				$data["body"]			= json_decode($result);
				$data["massage"]		= "Successful recive Data";
				$data["type"]			= "json/application";
				return view("response",$data);
			}else{
				$data["status"]			= 400;
				$data["body"]			= "null";
				$data["massage"]		= "services Cant Analyces use account";
				$data["type"]			= "error";
				return view("response",$data);
			}

			
		}
	
	}

}
