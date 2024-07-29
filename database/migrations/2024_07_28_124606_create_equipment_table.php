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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('Unit_no')->nullable();
            $table->string('Description');
            $table->string('Specifications')->nullable();
            $table->foreign('Facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('Category_id')->references('id')->on('categories')->onDelete('cascade');

            //$table->foreignId('Facility_id')->constrained(facility)->onDelete('cascade');
            //$table->foreignId('Category_id')->constrained(category)->onDelete('cascade');
            $table->string('Status')->default('Working'); // Add a default value or make it nullable
            $table->string('Date_acquired')->nullable();
            $table->string('Supplier')->nullable();
            $table->string('Amount')->nullable();
            $table->string('Estimated_life')->nullable();
            $table->string('Item_no')->nullable();
            $table->string('Property_no')->nullable();
            $table->string('Control_no')->nullable();
            $table->string('Serial_no')->nullable();
            $table->string('No_of_stocks');
            $table->string('Restocking_point');
            $table->string('Person_liable')->nullable();
            $table->string('Remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
