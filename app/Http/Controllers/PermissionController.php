<?php
namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   

    /**
     * Cria as permission e os usuarios com elas!
     *
	 * 
	 * 
     * @return \Illuminate\Http\Response
     */
    public function Permission()
    {   
    	$admin_permission = Permission::where('slug','admin')->first();
		$user_permission = Permission::where('slug', 'user')->first();

		//RoleTableSeeder.php
		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin Develop';
		$admin_role->save();
		$admin_role->permissions()->attach($admin_permission);

		$user_role = new Role();
		$user_role->slug = 'user';
		$user_role->name = 'User';
		$user_role->save();
		$user_role->permissions()->attach($user_permission);

		$admin_role = Role::where('slug','admin')->first();
		$user_role = Role::where('slug', 'user')->first();

		$admin = new Permission();
		$admin->slug = 'admin';
		$admin->name = 'Admin';
		$admin->save();
		$admin->roles()->attach($admin_role);

		$editUsers = new Permission();
		$editUsers->slug = 'user';
		$editUsers->name = 'User';
		$editUsers->save();
		$editUsers->roles()->attach($user_role);

		$admin_role = Role::where('slug','admin')->first();
		$user_role = Role::where('slug', 'user')->first();
		$dev_perm = Permission::where('slug','admin')->first();
		$manager_perm = Permission::where('slug','user')->first();



		//Adição de usuarios com suas roles
		$developer = new User();
		$developer->name = 'Harsukh Makwana';
		$developer->email = 'harsukh21@gmail.com';
		$developer->password = bcrypt('harsukh21');
		$developer->save();
		$developer->roles()->attach($admin_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->name = 'Jitesh Meniya';
		$manager->email = 'jitesh21@gmail.com';
		$manager->password = bcrypt('jitesh21');
		$manager->save();
		$manager->roles()->attach($user_role);
		$manager->permissions()->attach($manager_perm);

		$user = new User();
		$developer->name = 'Amós';
		$developer->email = 'Amos@gmail.com';
		$developer->password = bcrypt('123456');
		$developer->save();
		$developer->roles()->attach($admin_role);
		$developer->permissions()->attach($dev_perm);

		return redirect()->back();
    }
}