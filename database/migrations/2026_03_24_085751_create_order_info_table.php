<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInfoTable extends Migration
{
    public function up()
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->id();

            // Optional references for analytics
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            // Snapshot of product info
            $table->string('item_name');
            $table->string('item_image')->nullable(); // URL or path
            $table->decimal('price', 10, 2);          // price at the time of order
            $table->integer('quantity');
            $table->decimal('total', 10, 2);         // quantity * price

            // Delivery info snapshot
            $table->string('name');
            $table->string('email');
            $table->string('phone');                 // renamed from 'number'
            $table->string('address');
            $table->string('province')->nullable();

            // Order status
            $table->enum('status', ['pending','shipped','completed','cancelled'])->default('pending');

            $table->timestamps();

            // Optional foreign keys if you want to keep analytics
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_info');
    }
}