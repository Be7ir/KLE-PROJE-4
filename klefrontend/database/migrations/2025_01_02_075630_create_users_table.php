<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Göç işlemi - tabloyu oluşturur.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID kolonunu otomatik oluşturur
            $table->string('name'); // Kullanıcı adı
            $table->string('email')->unique(); // E-posta adresi (unique olması gerektiği için 'unique' kısıtlaması ekledik)
            $table->string('password'); // Şifre
            $table->timestamps(); // 'created_at' ve 'updated_at' kolonlarını otomatik olarak ekler
        });
    }

    /**
     * Göç geri alınırsa tablonun silinmesi işlemi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users'); // Tabloyu geri alır
    }
}
