<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Event extends Model 
{
    use Translatable;

    protected $table = 'events';
    public $timestamps = true;
    public $translatedAttributes = ['name',  'description'];
    protected $fillable = array('image', 'video', 'date','status','location_one' , 'location_two' , 'src_one' , 'src_two');

    // بيتضاف تلقائياً في أي JSON للحدث عشان الفرونت ياخد رابط الفيديو كامل جاهز
    protected $appends = ['video_url'];

    public function getVideoUrlAttribute()
    {
        return $this->video ? asset('admin_assets/videos/events/' . $this->video) : null;
    }

    public function eventImage()
    {
        return $this->hasMany('App\Models\EventImage');
    }

    public function all_images()
    {
        // الصور بس — الفيديوهات ليها all_media()
        $images[] = $this->eventImage->where('type', '!=', 'video')->pluck('image')->prepend($this->image);
        return $images;
    }

    /**
     * كل وسائط الحدث (الصورة الرئيسية + معرض الصور والفيديوهات) بروابط كاملة
     * وبالترتيب اللي هيتعرض بيه في الموقع.
     */
    public function all_media()
    {
        $media = [];

        if ($this->image) {
            $media[] = [
                'type' => 'image',
                'url'  => asset('admin_assets/images/events/' . $this->image),
                'alt'  => $this->name,
            ];
        }

        // الوسيط الرئيسي لو فيديو — يظهر في معرض صفحة التفاصيل زي فيديوهات المعرض
        if ($this->video) {
            $media[] = [
                'type' => 'video',
                'url'  => $this->video_url,
                'alt'  => $this->name,
            ];
        }

        foreach ($this->eventImage as $item) {
            if (!$item->image) {
                continue;
            }

            $media[] = [
                'type' => $item->type === 'video' ? 'video' : 'image',
                'url'  => $item->url,
                'alt'  => $item->alt ?: $this->name,
            ];
        }

        return $media;
    }

}