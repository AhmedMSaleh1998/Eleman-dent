<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateForeignKeys extends Migration {

	public function up()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		if (Schema::hasColumn('users', 'city_id') && !$this->_foreign_key_exists('users', 'users_city_id_foreign')) {
			Schema::table('users', function(Blueprint $table) {
				$table->foreign('city_id')->references('id')->on('cities')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		if (Schema::hasColumn('cities_translations', 'city_id') && !$this->_foreign_key_exists('cities_translations', 'cities_translations_city_id_foreign')) {
			Schema::table('cities_translations', function(Blueprint $table) {
				$table->foreign('city_id')->references('id')->on('cities')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('brand_translations', 'brand_id') && !$this->_foreign_key_exists('brand_translations', 'brand_translations_brand_id_foreign')) {
			Schema::table('brand_translations', function(Blueprint $table) {
				$table->foreign('brand_id')->references('id')->on('brand')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('products', 'category_id') && !$this->_foreign_key_exists('products', 'products_category_id_foreign')) {
			Schema::table('products', function(Blueprint $table) {
				$table->foreign('category_id')->references('id')->on('categories')
							->onDelete('set null')
							->onUpdate('set null');
			});
		}
		if (Schema::hasColumn('products', 'brand_id') && !$this->_foreign_key_exists('products', 'products_brand_id_foreign')) {
			Schema::table('products', function(Blueprint $table) {
				$table->foreign('brand_id')->references('id')->on('brand')
							->onDelete('set null')
							->onUpdate('set null');
			});
		}
		if (Schema::hasColumn('category_translations', 'category_id') && !$this->_foreign_key_exists('category_translations', 'category_translations_category_id_foreign')) {
			Schema::table('category_translations', function(Blueprint $table) {
				$table->foreign('category_id')->references('id')->on('categories')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('product_translations', 'product_id') && !$this->_foreign_key_exists('product_translations', 'product_translations_product_id_foreign')) {
			Schema::table('product_translations', function(Blueprint $table) {
				$table->foreign('product_id')->references('id')->on('products')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('banner_translations', 'banner_id') && !$this->_foreign_key_exists('banner_translations', 'banner_translations_banner_id_foreign')) {
			Schema::table('banner_translations', function(Blueprint $table) {
				$table->foreign('banner_id')->references('id')->on('banners')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('cart_items', 'product_id') && !$this->_foreign_key_exists('cart_items', 'cart_items_product_id_foreign')) {
			Schema::table('cart_items', function(Blueprint $table) {
				$table->foreign('product_id')->references('id')->on('products')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('cart_items', 'user_id') && !$this->_foreign_key_exists('cart_items', 'cart_items_user_id_foreign')) {
			Schema::table('cart_items', function(Blueprint $table) {
				$table->foreign('user_id')->references('id')->on('users')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('orders', 'payment_id') && !$this->_foreign_key_exists('orders', 'orders_payment_id_foreign')) {
			Schema::table('orders', function(Blueprint $table) {
				$table->foreign('payment_id')->references('id')->on('payments')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		if (Schema::hasColumn('user_addresses', 'city_id') && !$this->_foreign_key_exists('user_addresses', 'user_addresses_city_id_foreign')) {
			Schema::table('user_addresses', function(Blueprint $table) {
				$table->foreign('city_id')->references('id')->on('cities')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		if (Schema::hasColumn('user_addresses', 'user_id') && !$this->_foreign_key_exists('user_addresses', 'user_addresses_user_id_foreign')) {
			Schema::table('user_addresses', function(Blueprint $table) {
				$table->foreign('user_id')->references('id')->on('users')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('payment_translations', 'payment_id') && !$this->_foreign_key_exists('payment_translations', 'payment_translations_payment_id_foreign')) {
			Schema::table('payment_translations', function(Blueprint $table) {
				$table->foreign('payment_id')->references('id')->on('payments')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('product_images', 'product_id') && !$this->_foreign_key_exists('product_images', 'product_images_product_id_foreign')) {
			Schema::table('product_images', function(Blueprint $table) {
				$table->foreign('product_id')->references('id')->on('products')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('setting_transaltions', 'setting_id') && !$this->_foreign_key_exists('setting_transaltions', 'setting_transaltions_setting_id_foreign')) {
			Schema::table('setting_transaltions', function(Blueprint $table) {
				$table->foreign('setting_id')->references('id')->on('settings')
							->onDelete('cascade')
							->onUpdate('cascade');
			});
		}
		if (Schema::hasColumn('achievement_translations', 'achievement_id') && !$this->_foreign_key_exists('achievement_translations', 'achievement_translations_achievement_id_foreign')) {
			Schema::table('achievement_translations', function(Blueprint $table) {
				$table->foreign('achievement_id')->references('id')->on('achievements')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		if (Schema::hasColumn('event_translations', 'event_id') && !$this->_foreign_key_exists('event_translations', 'event_translations_event_id_foreign')) {
			Schema::table('event_translations', function(Blueprint $table) {
				$table->foreign('event_id')->references('id')->on('events')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		if (Schema::hasColumn('event_images', 'event_id') && !$this->_foreign_key_exists('event_images', 'event_images_event_id_foreign')) {
			Schema::table('event_images', function(Blueprint $table) {
				$table->foreign('event_id')->references('id')->on('events')
							->onDelete('restrict')
							->onUpdate('restrict');
			});
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
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
		Schema::table('setting_transaltions', function(Blueprint $table) {
			$table->dropForeign('setting_transaltions_setting_id_foreign');
		});
		Schema::table('achievement_translations', function(Blueprint $table) {
			$table->dropForeign('achievement_translations_achievement_id_foreign');
		});
		Schema::table('event_translations', function(Blueprint $table) {
			$table->dropForeign('event_translations_event_id_foreign');
		});
		Schema::table('event_images', function(Blueprint $table) {
			$table->dropForeign('event_images_event_id_foreign');
		});
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	private function _foreign_key_exists($table, $name)
    {
        $keys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($table);
        foreach ($keys as $key) {
            if ($key->getName() === $name) {
                return true;
            }
        }
        return false;
    }
}