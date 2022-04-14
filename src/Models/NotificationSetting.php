<?php

namespace Osoobe\NotificationSettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Osoobe\Laravel\Settings\Traits\HasMetas;
use Osoobe\LaravelTraits\Support\TimeDiff;

class NotificationSetting extends Model
{
    use HasFactory;
    use HasMetas;
    use TimeDiff;

    protected $fillable = [
        'name',
        'event',
        'enable_email',
        'enable_web',
        'enable_fcm',
        'enable_sms',
        'data',
        'notifiable_id',
        'notifiable_type',
        'subject_id',
        'subject_type',
        'notified_at'
    ];

    protected $casts = [
        'data' => 'array',
        'notified_at' => 'datetime'
    ];

    /**
     * Get the parent notifiable model (user).
     *
     * @return mixed
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Get the parent notifiable model (user).
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }


    /**
     * Get notification setting
     *
     * @param mixed $notifiable
     * @param string $name
     * @return mixed
     */
    public static function getSetting($notifiable, string $name) {
        return $notifiable->notificationSettings()
            ->where('name', $name)
            ->first();
    }


    public function scopeForName($query, $name) {
        return $query->where('name', $name);
    }

    public function scopeForType($query, $type) {
        return $query->where('notifiable_type', $type);
    }

    public function scopeForNotifiable($query, $notifiable) {
        return $query->where(function($q) use($notifiable) {
            return $q->where('notifiable_type', $notifiable->getMorphClass())
                ->where('notifiable_id', $notifiable->getKey());
        });
    }

    public function scopeForEvent($query, string $event) {
        return $query->where('event', "App\Events\CryptoUpdated");
    }

    public function scopeNofityBefore($query, $date) {

    }

    public function scopeIsActive($query) {
        return $query->where(function($q) {
            return $q->where('enable_web', 1)
                ->orWhere('enable_fcm', 1)
                ->orWhere('enable_sms', 1)
                ->orWhere('enable_email', 1);
        });
    }

}
