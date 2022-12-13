<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('lends', function (Blueprint $table) {
			$table->id();

			$table->bigInteger('customer_user_id')->unsigned(); // Cliente
			$table->bigInteger('owner_user_id')->unsigned(); // Bibliotecario
			$table->bigInteger('book_id')->unsigned(); // Libro que se lleva el cliente
			$table->date('date_out');
			$table->date('date_in');
			$table->enum('status', ['lend', 'returned']);
			$table->timestamps();
			$table->softDeletes();


			$table->foreign('customer_user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->foreign('owner_user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->foreign('book_id')
				->references('id')
				->on('books')
				->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('lends');
	}
};