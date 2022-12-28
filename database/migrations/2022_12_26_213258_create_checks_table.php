<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('checks', function(Blueprint $table) {
			$table->id();
            $table->foreignId('user_id');
			$table->decimal('amount', 15,2);
			$table->string('description');
			$table->string('image');
			$table->enum('status', array('pending', 'accepted', 'rejected'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('checks');
	}
};
