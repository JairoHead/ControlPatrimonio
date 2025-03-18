<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToMigDataTable extends Migration
{
    public function up()
    {
        Schema::table('mig_data', function (Blueprint $table) {
            $table->index('codbien');
            $table->index('codarea');
            $table->index('nombrecompleto');
        });
    }

    public function down()
    {
        Schema::table('mig_data', function (Blueprint $table) {
            $table->dropIndex(['codbien']);
            $table->dropIndex(['codarea']);
            $table->dropIndex(['nombrecompleto']);
        });
    }
}