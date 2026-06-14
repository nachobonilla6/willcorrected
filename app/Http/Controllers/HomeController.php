<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\PropertyContent;

class HomeController extends Controller
{
    public function index()
    {
        $content = PropertyContent::first() ?? new PropertyContent();
        $amenities = Amenity::where('is_active', true)->orderBy('sort_order')->get();
        $articles = Article::where('is_active', true)->orderBy('sort_order')->get();
        $images = GalleryImage::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($img) {
                return (object) [
                    'image_path' => $img->image_path,
                    'alt_text' => $img->alt_text ?? 'Gallery photo',
                ];
            });

        return view('welcome', compact('content', 'amenities', 'articles', 'images'));
    }
}
