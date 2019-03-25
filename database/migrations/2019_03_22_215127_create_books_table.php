<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
			Schema::create('books', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('author');
				$table->string('user')->nullable();
				$table->date('published_date');
				$table->integer('category_id')->unsigned();
				$table->foreign('category_id')->references('id')->on('book_categories');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
