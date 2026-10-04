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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('birth_date');
            $table->enum('category', ['sd', 'smp']);
            $table->string('school');
            $table->string('parent_name');
            $table->string('parent_phone', 25);
            $table->text('address');
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamps();

            $table->index('category');
            $table->index('registered_at');
            $table->index('school');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
