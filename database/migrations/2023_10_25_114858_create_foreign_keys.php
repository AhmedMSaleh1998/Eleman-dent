<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('product_sizes', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('payment_id')->references('id')->on('payment_methods')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('address_id')->references('id')->on('payment_methods')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('coupon_id')->references('id')->on('coupons')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('deliver_time_id')->references('id')->on('delivery_times')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->foreign('product_size_id')->references('id')->on('product_sizes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('color_product', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('color_product', function(Blueprint $table) {
			$table->foreign('color_id')->references('id')->on('colors')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->foreign('related_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('product_type', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('product_type', function(Blueprint $table) {
			$table->foreign('type_id')->references('id')->on('types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('coupon_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('coupon_user', function(Blueprint $table) {
			$table->foreign('coupon_id')->references('id')->on('coupons')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
		Schema::table('product_sizes', function(Blueprint $table) {
			$table->dropForeign('product_sizes_product_id_foreign');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->dropForeign('product_images_product_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_district_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_user-id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_payment_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_address_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_coupon_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_user_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_deliver_time_id_foreign');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->dropForeign('cart_items_product_size_id_foreign');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->dropForeign('cart_items_user_id_foreign');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->dropForeign('cart_items_order_id_foreign');
		});
		Schema::table('color_product', function(Blueprint $table) {
			$table->dropForeign('color_product_product_id_foreign');
		});
		Schema::table('color_product', function(Blueprint $table) {
			$table->dropForeign('color_product_color_id_foreign');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->dropForeign('related_products_product_id_foreign');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->dropForeign('related_products_related_id_foreign');
		});
		Schema::table('product_type', function(Blueprint $table) {
			$table->dropForeign('product_type_product_id_foreign');
		});
		Schema::table('product_type', function(Blueprint $table) {
			$table->dropForeign('product_type_type_id_foreign');
		});
		Schema::table('coupon_user', function(Blueprint $table) {
			$table->dropForeign('coupon_user_user_id_foreign');
		});
		Schema::table('coupon_user', function(Blueprint $table) {
			$table->dropForeign('coupon_user_coupon_id_foreign');
		});
	}
}
