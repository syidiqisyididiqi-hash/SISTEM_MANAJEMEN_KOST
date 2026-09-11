<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_tenant_id')->constrained()->cascadeOnDelete();
            $table->date('bill_month');
            $table->decimal('amount', 12, 2);
            $table->date('due_date');
            $table->decimal('fine_amount', 12, 2)->default(0);
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->timestamps();

            $table->unique(['room_tenant_id', 'bill_month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
