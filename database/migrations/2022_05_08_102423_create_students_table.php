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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->boolean('gender')->default(0)->comments("0:Male,1:Female");
            $table->integer('teacher_id');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Permission::create(['name' => "student_read"]);
        Permission::create(['name' => "student_create"]);
        Permission::create(['name' => "student_update"]);
        Permission::create(['name' => "student_delete"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');

        Permission::where('name', "student_read")->delete();
        Permission::where('name', "student_create")->delete();
        Permission::where('name', "student_update")->delete();
        Permission::where('name', "student_delete")->delete();
    }
};