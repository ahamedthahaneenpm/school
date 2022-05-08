<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Base Admin
        Role::where('name', 'super_privilege')->delete();
        $baseAdminRole = Role::create(['name' => 'super_privilege']);

        User::where('email', 'web@root.com')->forceDelete();
        $baseAdminUser = new User();
        $baseAdminUser->status = true;
        $baseAdminUser->name = 'Root Admin';
        $baseAdminUser->email = 'web@root.com';
        $baseAdminUser->password = Hash::make('School@01');
        $baseAdminUser->save();
        $baseAdminUser->assignRole($baseAdminRole);

        // School Admin
        Role::where('name', 'school_admin')->delete();
        $schoolAdminRole = Role::create(['name' => 'school_admin']);

        User::where('email', 'admin@school.com')->forceDelete();
        $schoolAdminUser = new User();
        $schoolAdminUser->name = 'school Admin';
        $schoolAdminUser->status = true;
        $schoolAdminUser->email = 'admin@school.com';
        $schoolAdminUser->password = Hash::make('School@01');
        $schoolAdminUser->deleted_at = NULL;
        $schoolAdminUser->save();
        $schoolAdminUser->assignRole($schoolAdminRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::where('name', 'super_privilege')->delete();
        Role::where('name', 'school_admin')->delete();
        User::where('email', 'web@root.com')->forceDelete();
        User::where('email', 'admin@school.com')->forceDelete();
    }
};