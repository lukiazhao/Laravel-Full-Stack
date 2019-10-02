<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkedinToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('linkedin_id', 64)->nullable();
            $table->string('linkedin_name', 64)->nullable();
            $table->longText('linkedin_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('linkedin_id');
            $table->dropColumn('linkedin_name');
            $table->dropColumn('linkedin_token');
        });
    }
}
