<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->string('student_course_id');
            $table->string('class_course_id')->nullable();
            $table->string('student_id')->nullable();
            $table->timestamps();

            $table->foreign('class_course_id')
                ->references('class_course_id')
                ->on('class_courses')
                ->nullOnDelete();
            $table->foreign('student_id')
                ->references('student_id')
                ->on('student')
                ->nullOnDelete();
            $table->primary('student_course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
