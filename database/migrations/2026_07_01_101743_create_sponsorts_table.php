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
        Schema::create('sponsorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edition_id')->constrained();
            $table->string('name');
            $table->string('secteur');
            $table->string('responsable');
            $table->string('phone');
            $table->string('email');
            $table->string('adresse');
            $table->string('logo')->nullable();
            $table->text('message');
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
        Schema::dropIfExists('sponsorts');
    }
};
