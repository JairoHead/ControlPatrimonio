<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReporteGeneradoToMigDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mig_data', function (Blueprint $table) {
            $table->boolean('reporte_generado')->default(false)->after('serie'); // Ajusta 'serie' según tu estructura
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mig_data', function (Blueprint $table) {
            $table->dropColumn('reporte_generado');
        });
    }
}