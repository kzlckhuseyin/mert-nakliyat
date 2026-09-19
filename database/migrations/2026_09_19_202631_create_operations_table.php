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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number'); // Plaka (33NCR80)
            $table->string('supplier_name'); // Alım (Nadir)
            $table->integer('quantity'); // Adet (110)
            $table->integer('freight_price'); // Navlun (2500.00)
            $table->string('store_code'); // Dükkan (84)
            $table->boolean('has_vat')->default(false);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
