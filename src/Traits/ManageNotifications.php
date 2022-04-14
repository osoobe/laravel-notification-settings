<?php

namespace Osoobe\NotificationSettings\Traits;

use Osoobe\NotificationSettings\Models\NotificationSetting;

trait ManageNotifications {

    /**
     * Get all notification setting
     *
     * @return mixed
     */
    public function notificationSettings() {
        return $this->morphMany(NotificationSetting::class, 'notifiable');
    }

    /**
     * Get notifications setting
     *
     * @param string $name
     * @return \Osoobe\LaravelNotificationSettings\Models\NotificationSetting
     */
    public function getNotificationSetting($name) {
        return NotificationSetting::getSetting($this->notificationSettings, $name);
    }

}


?>
