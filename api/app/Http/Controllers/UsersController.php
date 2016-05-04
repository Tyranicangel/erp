<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\User;
use App\Session;
use App\OfficeUser;
use App\UserUpdate;
use App\OfficeUserUpdate;
use Carbon\Carbon;
use DB;

class UsersController extends Controller {

	public function users(){
		return User::where('role','!=',1)->with('officedetails.officedata')->get();
	}

	public function activate_user(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		$u=User::where('id','=',Request::get('user_id'))->first();
		DB::beginTransaction();
		try{
			$uu=new UserUpdate;
			$uu->name=$u->name;
			$uu->email=$u->email;
			$uu->address=$u->address;
			$uu->user=$u->id;
			$uu->phoneno=$u->phoneno;
			$uu->designation=$u->designation;
			$uu->created_by=$u->created_by;
			$uu->active=$u->active;
			$uu->save();
			$u->active=1;
			$u->save();
		}
		catch(Exception $e){
			DB::rollback();
		}
		DB::commit();
		return User::where('role','!=',1)->with('officedetails.officedata')->get();
	}

	public function deactivate_user(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		$u=User::where('id','=',Request::get('user_id'))->first();
		DB::beginTransaction();
		try{
			$uu=new UserUpdate;
			$uu->name=$u->name;
			$uu->email=$u->email;
			$uu->address=$u->address;
			$uu->user=$u->id;
			$uu->phoneno=$u->phoneno;
			$uu->designation=$u->designation;
			$uu->created_by=$u->created_by;
			$uu->active=$u->active;
			$uu->save();
			$u->active=0;
			$u->save();
		}
		catch(Exception $e){
			DB::rollback();
		}
		DB::commit();
		return User::where('role','!=',1)->with('officedetails.officedata')->get();
	}

	public function save_user(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		$user=Request::all();
		$response="";
		$msg="error";
		if(array_key_exists('id', $user))
		{
			DB::beginTransaction();
			try{
				$u=User::where('id','=',$user['id'])->first();
				$uu=new UserUpdate;
				$uu->name=$u->name;
				$uu->email=$u->email;
				$uu->address=$u->address;
				$uu->user=$u->id;
				$uu->phoneno=$u->phoneno;
				$uu->designation=$u->designation;
				$uu->created_by=$u->created_by;
				$uu->active=$u->active;
				$uu->save();
				$u->name=$user['name'];
				$u->email=$user['email'];
				$u->address=$user['address'];
				$u->phoneno=$user['phoneno'];
				$u->designation=$user['designation'];
				$u->created_by=$admin->users->id;
				$u->save();
				$ou=OfficeUser::where('user','=',$u->id)->first();
				if($ou->office==$user['officedetails']['office'])
				{

				}
				else
				{
					$ouu=new OfficeUserUpdate;
					$ouu->user=$ou->user;
					$ouu->office=$ou->office;
					$ouu->created_by=$ou->created_by;
					$ouu->save();
					$ou->user=$u->id;
					$ou->office=$user['officedetails']['office'];
					$ou->created_by=$admin->users->id;
					$ou->save();
				}
				$response="User edited";
				$msg="success";
			}
			catch(Exception $e){
				DB::rollback();
			}
			DB::commit();
		}
		else
		{
			$u=User::where('username','=',$user['username'])->count();
			if($u>0)
			{
				$response="This username already in use";
			}
			else
			{
				DB::beginTransaction();
				try{
					$u=new User;
					$u->username=$user['username'];
					$u->name=$user['name'];
					$u->email=$user['email'];
					$u->password=hash("sha256",$user['username'].'123456erp');
					$u->address=$user['address'];
					$u->phoneno=$user['phoneno'];
					$u->designation=$user['designation'];
					$u->role=2;
					$u->created_by=$admin->users->id;
					$u->save();
					$ou=new OfficeUser;
					$ou->user=$u->id;
					$ou->office=$user['officedetails']['office'];
					$ou->created_by=$admin->users->id;
					$ou->save();
					$response="User created with username: ".$u->username.' and password 123456';
					$msg="success";
				}
				catch(Exception $e){
					DB::rollback();
				}
				DB::commit();
			}
		}
		$ulist=User::where('role','!=',1)->with('officedetails.officedata')->get();
		return array($response,$msg,$ulist);
	}
}
