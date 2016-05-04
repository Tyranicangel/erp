<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\User;
use App\Session;
use App\Office;
use App\OfficeUpdate;
use Carbon\Carbon;
use DB;

class OfficeController extends Controller {

	public function offices(){
		return Office::get();
	}

	public function activate_office(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		DB::beginTransaction();
		try{
			$o=Office::where('id','=',Request::get('office_id'))->first();
			$ou=new OfficeUpdate;
			$ou->office=$o->id;
			$ou->created_by=$o->created_by;
			$ou->name=$o->name;
			$ou->address=$o->address;
			$ou->active=$o->active;
			$ou->save();
			$o->active=1;
			$o->created_by=$admin->users->id;
			$o->save();
		}
		catch(Exception $e){
			DB::rollback();
		}
		DB::commit();
		return Office::get();
	}

	public function deactivate_office(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		DB::beginTransaction();
		try{
			$o=Office::where('id','=',Request::get('office_id'))->first();
			$ou=new OfficeUpdate;
			$ou->office=$o->id;
			$ou->created_by=$o->created_by;
			$ou->name=$o->name;
			$ou->address=$o->address;
			$ou->active=$o->active;
			$ou->save();
			$o->active=0;
			$o->created_by=$admin->users->id;
			$o->save();
		}
		catch(Exception $e){
			DB::rollback();
		}
		DB::commit();
		return Office::get();
	}

	public function save_office(){
		$date=Carbon::now();
		$tkn= Request::header('JWT-AuthToken');
		$admin=Session::where('token','=',$tkn)->where('expiry','>',$date)->whereHas('users',function($q){
				$q->where('active','=','1');
			})->first();
		$office=Request::all();
		if(array_key_exists('id', $office))
		{
			DB::beginTransaction();
			try{
				$o=Office::where('id','=',$office['id'])->first();
				$ou=new OfficeUpdate;
				$ou->office=$o->id;
				$ou->created_by=$o->created_by;
				$ou->name=$o->name;
				$ou->address=$o->address;
				$ou->active=$o->active;
				$ou->save();
				$o->name=$office['name'];
				$o->address=$office['address'];
				$o->created_by=$admin->users->id;
				$o->save();
			}
			catch(Exception $e){
				DB:rollback();
			}
			DB::commit();
		}
		else
		{
			$o=new Office;
			$o->name=$office['name'];
			$o->address=$office['address'];
			$o->created_by=$admin->users->id;
			$o->save();
		}
		return Office::get();
	}

}
