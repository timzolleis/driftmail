<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('projects', function (Blueprint $table) {
//            $table->uuid('id')->primary();
//
//        });
//
//        Schema::table('projects', function (Blueprint $table) {
//            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
//            $table->string('name');
//            $table->string('description');
//        });

        Schema::table('projects', function (Blueprint $table){
            $table->string('description')->nullable()->change();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
