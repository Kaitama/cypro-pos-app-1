<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
			$table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
			$table->string('name')->unique();
			$table->integer('price')->default(0);
			// stock null = unilimited
			// stock 0 = habis stock
			// stock > 0 = produk tersedia
			$table->integer('stock')->nullable();
			$table->text('description')->nullable();
			$table->string('photo_path')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
