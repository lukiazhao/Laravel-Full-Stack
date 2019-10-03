<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColToEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('business_name', 64)->nullable();
            $table->longText('introduction')->nullable();
            $table->string('city', 64)->nullable();
            $table->bigInteger('classification_id')->unsigned()->nullable();
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->string('detailed_address', 64)->nullable();
            $table->string('website', 128)->nullable();
            $table->string('phone_number', 64)->nullable();
            $table->string('company_logo', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn('business_name');
            $table->dropColumn('introduction');
            $table->dropColumn('city');
            $table->dropColumn('classification_id');
            $table->dropForeign('employers_classification_id_foreign');
            $table->dropColumn('detailed_address');
            $table->dropColumn('website');
            $table->dropColumn('phone_number');
        });
    }
}
