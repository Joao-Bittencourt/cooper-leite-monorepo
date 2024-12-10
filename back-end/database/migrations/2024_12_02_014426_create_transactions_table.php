<?php

declare(strict_types=1);

use App\Models\Cooperative;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Cooperative::class);
            $table->string('type');
            $table->decimal('amount', 8, 4);
            $table->foreignIdFor(User::class, 'created_by');
            $table->timestamps();
            $table->integer('active')->default(1);
        });
    }
};
