<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddBillingShippingConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('billing_id')->index()->nullable()->constrained('addresses')->nullOnDelete();
            $table->foreignId('shipping_id')->index()->nullable()->constrained('addresses')->nullOnDelete();
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
            $table->dropColumn([
                'billing_id',
                'shipping_id'
            ]);

            $table->dropIndex([
                'billing_id',
                'shipping_id'
            ]);
        });
    }
}
