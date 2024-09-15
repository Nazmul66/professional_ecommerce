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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->text('logo');
            $table->string('name')->unique();
            $table->string('slug');
            $table->integer('is_featured')->default(1)->comment('1 = yes, 0 = no');
            $table->integer('status')->default(1)->comment('1 = Active, 0 = Deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
