<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsAddCastType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function(Blueprint $table) {

            $table->enum('cast_type', ['string', 'interger', 'int', 'boolean', 'bool', 'float', 'double'])
                    ->after('value')->default('string');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function(Blueprint $table) {

            $table->dropColumn('cast_type');

        });
    }
}
