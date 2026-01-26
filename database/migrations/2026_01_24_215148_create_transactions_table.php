<?php

use App\Models\User;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('bank')->nullable();
            $table->string('note')->nullable();
            $table->string('refrence')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('currency')->nullable();
            $table->date('transaction_date')->nullable();
            $table->text('raw_line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
