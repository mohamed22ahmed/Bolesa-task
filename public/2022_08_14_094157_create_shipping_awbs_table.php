<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAwbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_awbs', function (Blueprint $table) {
          $table->id();
          $table->string('shipping_company');
          $table->string('price')->nullable();
          $table->string('payment_type')->comment('CC OR COD');
          $table->string('shipper_name');
          $table->string('shipper_company_name')->nullable();
          $table->string('shipper_address_line_1');
          $table->string('shipper_line_2')->nullable();
          $table->string('shipper_line_3')->nullable();
          $table->string('shipper_city');
          $table->string('shipper_state_or_province_code')->nullable();
          $table->string('shipper_post_code')->nullable();
          $table->string('shipper_country_code');
          $table->string('shipper_phone');
          $table->string('shipper_email')->nullable();

          $table->string('consignee_name');
          $table->string('consignee_company_name')->nullable();
          $table->string('consignee_address_line_1');
          $table->string('consignee_line_2')->nullable();
          $table->string('consignee_line_3')->nullable();
          $table->string('consignee_city');
          $table->string('consignee_state_or_province_code')->nullable();
          $table->string('consignee_post_code')->nullable();
          $table->string('consignee_country_code');
          $table->string('consignee_phone');
          $table->string('consignee_email')->nullable();
          $table->string('awb_reference');
          $table->string('description');
          $table->string('tracking_number');
          $table->string('label');
          $table->string('store_name');
          $table->string('order_number');
          $table->boolean('is_delivered')->default(0);
          $table->boolean('is_paid')->default(0);


          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_awb');
    }
}
