<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->id();
			$table->string('first_name',60);
			$table->string('last_name',60);
			$table->string('other_name',60)->nullable();
			$table->string('gender', 10);
			$table->date('dob')->nullable();
			$table->string('pob',200)->nullable();
			$table->string('parent_name',20)->nullable();
			$table->string('phone',20)->nullable();
			$table->string('phone2',20)->nullable();
			$table->string('email', 60)->nullable();
			$table->string('religion', 32)->nullable();
			$table->string('occupation', 200)->nullable();
			$table->smallInteger('class_id')->nullable();
			$table->smallInteger('class_type_id')->nullable();
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('student_reg', 9)->unique();
			$table->string('profile_pix')->default('default.jpg');
			$table->foreign('parent_id')->references('id')->on('parents');
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
		Schema::drop('students');
	}

}
