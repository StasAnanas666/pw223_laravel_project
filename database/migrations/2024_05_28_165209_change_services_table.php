<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table("services", function(Blueprint $table) {
            $table->unsignedBigInteger("user_id")->default(1);
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::table("services", function(Blueprint $table) {
            $table->dropColumn("user_id");
        });
    }
};