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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edition_id')->constrained();
            $table->string('prenom');
            $table->string('nom');
            $table->string('secteur');
            $table->enum('sexe',['Masculin','Feminin']);
            $table->string('phone');
            $table->string('structure');
            $table->string('email');
            $table->string('ville');
            $table->string('adresse');
            $table->string('logo')->nullable();
            $table->string('presentation_activite')->nullable();
            $table->string('piece_identite')->nullable();
            $table->boolean('status')->default(0);
            $table->enum('etude',['en attente','validé','rejetté'])->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
