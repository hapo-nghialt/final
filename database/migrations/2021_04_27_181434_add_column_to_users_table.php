<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('username')->after('name')->nullable();
            $table->text('role_id')->after('password')->nullable();
            $table->string('phone_number')->after('role_id')->nullable();
            $table->text('address')->after('phone_number')->nullable();
            $table->string('avatar')->after('address')->nullable();
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
            $table->dropColumn('username');
            $table->dropColumn('role_id');
            $table->dropColumn('phone_number');
            $table->dropColumn('address');
            $table->dropColumn('avatar');
        });
    }
}
