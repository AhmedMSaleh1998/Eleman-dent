<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model 
{

    protected $table = 'event_images';
    public $timestamps = true;
    protected $fillable = array('event_id', 'image', 'alt', 'type');

    /** المجلد اللي الملف متخزن فيه حسب نوعه */
    public function folder()
    {
        return $this->type === 'video' ? 'admin_assets/videos/events/' : 'admin_assets/images/events/';
    }

    /** الرابط الكامل للملف */
    public function getUrlAttribute()
    {
        return $this->image ? asset($this->folder() . $this->image) : null;
    }

    /** المسار على السيرفر — بيستخدم وقت الحذف */
    public function getFilePathAttribute()
    {
        return $this->image ? public_path($this->folder() . $this->image) : null;
    }

    public function getIsVideoAttribute()
    {
        return $this->type === 'video';
    }

}