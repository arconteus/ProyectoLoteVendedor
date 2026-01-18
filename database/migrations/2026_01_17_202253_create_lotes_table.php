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
        // | direccion | string | Nullable |
        // | identificador | string | Unique |
        // | activo | boolean | Default: true |
        // | created_at | timestamp | Creation date |
        // | updated_at | timestamp | Last update |
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('direccion', 255)->nullable();
            $table->string('identificador', 50)->unique();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
