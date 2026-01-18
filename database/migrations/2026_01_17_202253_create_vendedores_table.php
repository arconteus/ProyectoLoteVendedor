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
        // | Campo | Tipo | Descripción |
        // |------|------|-------------|
        // | id | bigint | Primary key |
        // | nombre | string | Not Null |
        // | email | string | Not Null |
        // | telefono | string | Phone number |
        // | external_id | bigint | Unique |
        // | lote_id | bigint | Foreign Key |
        // | created_at | timestamp | Creation date |
        // | updated_at | timestamp | Last update |
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 150);
            $table->string('telefono', 20)->nullable();
            $table->unsignedBigInteger('external_id')->unique();
            $table->foreignId('lote_id')
                ->constrained('lotes')
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
