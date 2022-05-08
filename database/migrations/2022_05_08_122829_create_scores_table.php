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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->double('maths');
            $table->double('sceince');
            $table->double('history');
            $table->integer('term');
            $table->timestamps();
        });

        Permission::create(['name' => "score_read"]);
        Permission::create(['name' => "score_create"]);
        Permission::create(['name' => "score_update"]);
        Permission::create(['name' => "score_delete"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');

        Permission::where('name', "score_read")->delete();
        Permission::where('name', "score_create")->delete();
        Permission::where('name', "score_update")->delete();
        Permission::where('name', "score_delete")->delete();
    }
};