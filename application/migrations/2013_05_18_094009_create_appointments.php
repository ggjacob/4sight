<?php

class Create_Appointments {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('appointmenttypes', function($table) {
            // auto incremental id (PK)
            $table->increments('id');

            $table->string('name', 32);

            // created_at | updated_at DATETIME
            $table->timestamps();
        });

        Schema::create('appointments', function($table) {
            // auto incremental id (PK)
            $table->increments('id');

            $table->integer('appointmenttype_id')->unsigned();
            $table->foreign('appointmenttype_id')->references('id')->on('appointmenttypes')->on_update('cascade');
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people')->on_update('cascade');
            $table->date('date');
            $table->string('notes', 512)->nullable();

            // created_at | updated_at DATETIME
            $table->timestamps();
        });

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('appointments');
        Schema::drop('appointmenttypes');
	}

}