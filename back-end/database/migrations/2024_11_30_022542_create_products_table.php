<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyText('description')->nullable();
            $table->string('unit');
            $table->decimal('price', 8, 2)->default(0.00);
            $table->timestamps();
            $table->integer('active')->default(1);
        });
    }
};
