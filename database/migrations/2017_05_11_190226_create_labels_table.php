<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('type')->default(1); // 1= shipping label, 2= Order Label
            $table->string('buyer_name');
            $table->string('buyer_company');
            $table->string('buyer_email');
            $table->string('buyer_phone');
            $table->string('buyer_residential');
            $table->string('buyer_addressLines');
            $table->string('buyer_cityTown');
            $table->string('buyer_stateProvince');
            $table->string('buyer_postalCode');
            $table->string('buyer_countryCode')->default('US');
            $table->string('receiver_name');
            $table->string('receiver_company');
            $table->string('receiver_email');
            $table->string('receiver_phone');
            $table->string('receiver_residential');
            $table->string('receiver_addressLines');
            $table->string('receiver_cityTown');
            $table->string('receiver_stateProvince');
            $table->string('receiver_postalCode');
            $table->string('receiver_countryCode');
            $table->string('parcel_weight_amount');
            $table->string('parcel_weight_unitOfMeasurement');
            $table->string('parcel_dimension_unitOfMeasurement');
            $table->string('parcel_dimension_length');
            $table->string('parcel_dimension_width');
            $table->string('parcel_dimension_height');
            $table->string('parcel_dimension_irregularParcelGirth');
            $table->string('rates_carrier');
            $table->string('rates_parcelType');
            $table->string('rates_serviceId');
            $table->string('rates_rateTypeId');
            $table->string('rates_deliveryCommitment_minEstimatedNumberOfDays');
            $table->string('rates_deliveryCommitment_maxEstimatedNumberOfDays');
            $table->string('rates_deliveryCommitment_estimatedDeliveryDateTime');
            $table->string('rates_deliveryCommitment_guarantee');
            $table->string('rates_deliveryCommitment_additionalDetails');
            $table->string('rates_dimensionalWeight_weight');
            $table->string('rates_dimensionalWeight_unitOfMeasurement');
            $table->string('rates_baseCharge');
            $table->string('rates_totalCarrierCharge');
            $table->string('rates_alternateBaseCharge');
            $table->string('rates_currencyCode');
            $table->string('rates_destinationZone');
            $table->string('rates_alternateTotalCharge');
            $table->string('documents_type');
            $table->string('documents_contentType');
            $table->string('documents_size');
            $table->string('documents_fileFormat');
            $table->string('documents_contents');
            $table->string('shipperId');
            $table->string('shipmentId');
            $table->string('parcelTrackingNumber');
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
        Schema::drop('labels');
    }
}
