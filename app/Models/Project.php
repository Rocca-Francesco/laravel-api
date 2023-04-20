<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{   
    use HasFactory;
    protected $fillable = ['title', 'lenguages', 'link', 'type_id'];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    public static function generateSlug($title) {
        $possible_slug = Str::of($title)->slug('-');
        $projects = Project::where('slug', $possible_slug)->get();
        $original_slug = $possible_slug;
        $i = 2;

        while(count($projects)) {
            $possible_slug = $original_slug . '-' . $i;
            $projects = Project::where('slug', $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }

    public function getLinkUrl() {
        return $this->link ? asset('storage/' . $this->link) : 'https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg';
    }
}
