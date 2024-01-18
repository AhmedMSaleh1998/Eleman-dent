<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('cities_translations', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('brand_translations', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brand')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brand')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('category_translations', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_translations', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('banner_translations', function(Blueprint $table) {
			$table->foreign('banner_id')->references('id')->on('banners')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('payment_id')->references('id')->on('payments')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_addresses', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_addresses', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('payment_translations', function(Blueprint $table) {
			$table->foreign('payment_id')->references('id')->on('payments')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_city_id_foreign');
		});
		Schema::table('cities_translations', function(Blueprint $table) {
			$table->dropForeign('cities_translations_city_id_foreign');
		});
		Schema::table('brand_translations', function(Blueprint $table) {
			$table->dropForeign('brand_translations_brand_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_brand_id_foreign');
		});
		Schema::table('category_translations', function(Blueprint $table) {
			$table->dropForeign('category_translations_category_id_foreign');
		});
		Schema::table('product_translations', function(Blueprint $table) {
			$table->dropForeign('product_translations_product_id_foreign');
		});
		Schema::table('banner_translations', function(Blueprint $table) {
			$table->dropForeign('banner_translations_banner_id_foreign');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->dropForeign('cart_items_product_id_foreign');
		});
		Schema::table('cart_items', function(Blueprint $table) {
			$table->dropForeign('cart_items_user_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_payment_id_foreign');
		});
		Schema::table('user_addresses', function(Blueprint $table) {
			$table->dropForeign('user_addresses_city_id_foreign');
		});
		Schema::table('user_addresses', function(Blueprint $table) {
			$table->dropForeign('user_addresses_user_id_foreign');
		});
		Schema::table('payment_translations', function(Blueprint $table) {
			$table->dropForeign('payment_translations_payment_id_foreign');
		});
		Schema::table('product_images', function(Blueprint $table) {
			$table->dropForeign('product_images_product_id_foreign');
		});
	}
}