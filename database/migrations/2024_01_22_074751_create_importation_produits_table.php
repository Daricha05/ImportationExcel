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
        Schema::create('importation_produits', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('libelle');
            $table->integer('annee');
            $table->bigInteger('valeur_caf');
            $table->bigInteger('poids_net');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importation_produits');
    }
};