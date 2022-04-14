<?php

namespace Osoobe\NotificationSettings\Traits;

use Osoobe\NotificationSettings\Models\NotificationSetting;

trait NotificationChannel {

    protected $notification_setting = null;

    public function addSetting(NotificationSetting $setting) {
        $this->notification_setting = $setting;
        return $this;
    }

    protected function settingMap() {
        return config('notifications.channel.map', [
            'enable_mail' => 'mail',
            'enable_web' => 'database'
        ]);
    }

    protected function viaSettings() {
        $channels = [];
        $maps = $this->settingMap();

        foreach( $maps as $key => $val ) {
            if ( !empty($this->notification_setting) &&
                 !empty($this->notification_setting->$key) &&
                 (bool) $this->notification_setting->$key
            ) {
                $channels[] = $val;
            }
        }
        return $channels;
    }

}

?>
