<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * الأعمدة النصية الطويلة كانت varchar(255/2500) وتسبب خطأ
     * 1406 Data too long عند إدخال نصوص كبيرة، وعمود seq كان tinyint
     * على بعض البيئات ويرفض أي ترتيب أكبر من 127.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE `product_translations`
            MODIFY `title` MEDIUMTEXT NULL,
            MODIFY `description` MEDIUMTEXT NULL,
            MODIFY `description_meta` MEDIUMTEXT NULL,
            MODIFY `keywords` MEDIUMTEXT NULL,
            MODIFY `keywords_meta` MEDIUMTEXT NULL');

        DB::statement('ALTER TABLE `products` MODIFY `seq` INT NOT NULL DEFAULT 1');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `product_translations`
            MODIFY `title` VARCHAR(255) NULL,
            MODIFY `description` VARCHAR(2500) NULL,
            MODIFY `description_meta` VARCHAR(2500) NULL,
            MODIFY `keywords` VARCHAR(2500) NULL,
            MODIFY `keywords_meta` VARCHAR(2500) NULL');

        DB::statement('ALTER TABLE `products` MODIFY `seq` TINYINT NOT NULL DEFAULT 1');
    }
};
