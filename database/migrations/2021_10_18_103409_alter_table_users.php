<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->after('email')->nullable();
            $table->enum('role', ['admin', 'user'])->after('photo')->default('user');
            $table->string('provider')->after('role')->nullable();
            $table->string('provider_id')->after('provider')->nullable();
            $table->enum('status', ['active', 'inactive'])->after('provider_id')->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('role');
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('status');
        });
    }
}
