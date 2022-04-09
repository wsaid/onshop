<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->mediumText('description');
            $table->unsignedInteger('cost');
            $table->unsignedInteger('retail');
            $table->boolean('active')->default(true);
            $table->boolean('vat')->default(false);
            $table->foreignId('category_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId('range_id')->nullable()->index()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('products');
    }
}
