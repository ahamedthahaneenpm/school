<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = ['user', 'role', 'customer', 'crud', 'country', 'settings', 'banner', 'category', 'enquiry', 'cms'];
        foreach ($permissions as  $value) {
            Permission::create(['name' => $value . '_read']);
            Permission::create(['name' => $value . '_create']);
            Permission::create(['name' => $value . '_update']);
            Permission::create(['name' => $value . '_delete']);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permissions = ['user', 'role', 'customer', 'crud', 'country', 'settings', 'banner', 'category', 'enquiry', 'cms'];
        foreach ($permissions as $value) {
            Permission::where('name', $value . '_read')->delete();
            Permission::where('name', $value . '_create')->delete();
            Permission::where('name', $value . '_update')->delete();
            Permission::where('name', $value . '_delete')->delete();
        }
    }
};