<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contact_departments');
        Schema::create('contact_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('contact_id')->unsigned();
            $table->unsignedBiginteger('department_id')->unsigned();

            $table->foreign('contact_id')->references('id')
                 ->on('contacts')->onDelete('cascade');
            $table->foreign('department_id')->references('id')
                ->on('departments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_departments');
    }
};
