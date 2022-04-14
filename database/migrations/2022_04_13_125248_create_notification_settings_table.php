<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('notification_settings');
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();

            $table->string('name')->index();
            $table->string('event')->nullable()->index();

            $table->nullableMorphs('notifiable');
            $table->nullableMorphs('subject');

            $table->boolean('enable_email')->default(0);
            $table->boolean('enable_web')->default(1);
            $table->boolean('enable_fcm')->default(0);
            $table->boolean('enable_sms')->default(0);

            $table->json('data')->nullable();

            $table->index(['notifiable_id', 'notifiable_type']);

            $table->timestamp('notified_at')->nullable();

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
        Schema::dropIfExists('notification_settings');
    }
}
