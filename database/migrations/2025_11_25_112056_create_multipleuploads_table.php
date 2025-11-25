<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_multipleuploads_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('multipleuploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('ref_table', 100)->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('multipleuploads');
    }
};