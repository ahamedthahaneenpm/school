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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Permission::create(['name' => "teacher_read"]);
        Permission::create(['name' => "teacher_create"]);
        Permission::create(['name' => "teacher_update"]);
        Permission::create(['name' => "teacher_delete"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');

        Permission::where('name', "teacher_read")->delete();
        Permission::where('name', "teacher_create")->delete();
        Permission::where('name', "teacher_update")->delete();
        Permission::where('name', "teacher_delete")->delete();
    }
};