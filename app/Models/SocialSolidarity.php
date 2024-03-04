<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SocialSolidarity extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const ACTIVE_RADIO = [
        '1' => 'Active',
        '0' => 'Non-Active',
    ];

    public $table = 'social_solidarities';

    protected $appends = [
        'images_and_videos',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'date',
        'donation_type_id',
        'target_amount',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(368)
        ->height(232)->keepOriginalImageFormat();
        $this->addMediaConversion('preview')->width(368)
        ->height(232)->keepOriginalImageFormat();  
    }

    public function getImagesAndVideosAttribute()
    {
        return $this->getMedia('images_and_videos');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function donation_type()
    {
        return $this->belongsTo(Donationtype::class, 'donation_type_id');
    }

    public function donation(){

        return $this->hasMany(Donation::class,"social_solidarity_id","id");
        
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
