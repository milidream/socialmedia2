<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendship', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'friend1_id')->constrained('users');
            $table->foreignIdFor(User::class, 'friend2_id')->constrained('users');
            $table->boolean('accepted')->default(false);
            $table->timestamps();

            $table->primary(['friend1_id', 'friend2_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendship');
    }
};
