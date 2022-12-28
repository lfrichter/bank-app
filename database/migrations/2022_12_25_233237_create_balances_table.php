<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('balances', function(Blueprint $table) {
			$table->id();
            $table->foreignId('user_id');
			$table->decimal('current_balance', 15, 2);
			$table->string('description');
			$table->decimal('amount', 15,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('balances');
	}
};
