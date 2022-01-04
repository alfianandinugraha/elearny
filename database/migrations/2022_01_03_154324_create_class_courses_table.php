<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_courses', function (Blueprint $table) {
            $table->string('class_course_id');
            $table->string('lecturer_id')->nullable()->default(null);
            $table->string('course_id')->nullable()->default(null);
            $table->string('class');
            $table->string('token')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('lecturer_id')
                ->references('lecturer_id')
                ->on('lecturers')
                ->nullOnDelete();
            $table->foreign('course_id')
                ->references('course_id')
                ->on('courses')
                ->nullOnDelete();
            $table->primary('class_course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_courses');
    }
}
