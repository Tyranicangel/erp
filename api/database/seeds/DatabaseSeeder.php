<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;
use App\Module;
use App\Menu;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('ModuleTableSeeder');
		$this->call('MenuTableSeeder');
	}

}

class MenuTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Menu::create(['role'=>1,'module_id'=>1,'menu'=>'Home','slug'=>'main','priority'=>1]);
		Menu::create(['role'=>1,'module_id'=>1,'menu'=>'Masters','slug'=>'masters','priority'=>2]);
		Menu::create(['role'=>1,'module_id'=>2,'menu'=>'Home','slug'=>'main','priority'=>1]);
		Menu::create(['role'=>1,'module_id'=>2,'menu'=>'Masters','slug'=>'masters','priority'=>2]);
	}

}

class ModuleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Module::create(['role'=>1,'module'=>'Office','color'=>'#bababa','icon'=>'fa fa-desktop','slug'=>'office','priority'=>'1']);
		Module::create(['role'=>1,'module'=>'Users','color'=>'#f5f5f5','icon'=>'fa fa-users','slug'=>'users','priority'=>'2']);
	}

}

class RoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Role::create(['role'=>'Admin','link'=>'user.main']);
		Role::create(['role'=>'HR','link'=>'user.main']);
		Role::create(['role'=>'HR Incharge','link'=>'user.main']);
	}

}

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		User::create(['username'=>'admin','name'=>'Admin','email'=>'admin@admin.com','address'=>'Admin','phoneno'=>'admin','designation'=>'Admin','password'=>'c4895d7b6724d48e7019e06b74275eaaaccb562738a89abd05b8500570a4b4d2','role'=>1,'created_by'=>0]);
	}

}
