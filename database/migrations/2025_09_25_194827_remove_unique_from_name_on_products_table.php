<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // drop unique constraint on name column
            $table->dropUnique('products_name_unique');
            // or you can do: $table->dropUnique(['name']);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // re-add the unique constraint if you roll back
            $table->unique('name');
        });
    }
};
