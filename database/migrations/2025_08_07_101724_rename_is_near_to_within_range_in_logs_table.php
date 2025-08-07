<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->renameColumn('is_near', 'within_range');
        });
    }

    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->renameColumn('within_range', 'is_near');
        });
    }
};
