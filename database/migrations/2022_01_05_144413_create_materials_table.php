<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->string('material_id');
            $table->string('title');
            $table->text('content');
            $table->string('filename')->nullable();
            $table->string('class_course_id');
            $table->timestamps();

            $table->foreign('class_course_id')
                ->references('class_course_id')
                ->on('class_courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->primary('material_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
