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
        Schema::create('mail_queue', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

        Schema::table('mail_queue', function (Blueprint $table){
            $table->integer('job_id');
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('request_id');
            $table->string('mail_address');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_queue', function (Blueprint $table){
            $table->dropColumn('new_field'); // remove the new field from existing table
        });
        Schema::dropIfExists('mail_queue');
    }
};
