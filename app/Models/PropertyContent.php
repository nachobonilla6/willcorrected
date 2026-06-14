<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyContent extends Model
{
    protected $table = 'property_contents';
    protected $fillable = [
        'meta_title', 'meta_description', 'is_active',
        'hero_image', 'hero_badge', 'hero_subtitle', 'hero_title', 'hero_accent', 'hero_tagline',
        'details_image', 'details_title', 'details_intro', 'details_description', 'feature_list',
        'life_title', 'surf_title', 'life_text', 'surf_text', 'life_highlights',
        'beach_image_1', 'beach_image_2', 'beach_intro', 'beach_text_1', 'beach_text_2',
        'beach_highlights_title', 'surfing_title', 'sunset_title', 'surfing_text', 'sunset_text',
        'beach_highlights',
        'video_1_src', 'video_1_label', 'video_2_src', 'video_2_label', 'video_title', 'video_intro',
        'contact_title', 'owner_name', 'contact_intro', 'contact_email', 'contact_phone', 'contact_whatsapp',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'feature_list' => 'array',
            'life_highlights' => 'array',
            'beach_highlights' => 'array',
        ];
    }
}
