<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetOptInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
           CREATE TABLE `widget_opt_in` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
             `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
             `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
             `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
             `opt_in` tinyint(1) NOT NULL,
             `created_at` timestamp NULL DEFAULT NULL,
             `updated_at` timestamp NULL DEFAULT NULL,
             PRIMARY KEY (`id`),
             UNIQUE KEY `widget_opt_in_email_unique` (`email`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        */

        Schema::create('widget_opt_ins', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('opt_in');
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
        Schema::dropIfExists('widget_opt_ins');
    }
}
