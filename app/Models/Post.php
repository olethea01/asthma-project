<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\SplFileInfo;

class Post 
//extends Model
{
    //use HasFactory;

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all() 
    {
        // $files = File::files(resource_path("posts"));
        // $posts = [];
        // foreach ($files as $file) {
            // $document = YamlFrontMatter::parse($file);
            // $posts[] = new Post(

        // return collect(File::files(resource_path("posts")))
            // ->map(fn($file) => YamlFrontMatter::parse($file))
            // ->map(fn($document) => new Post(
                // $document->title,
                // $document->excerpt,
                // $document->date,
                // $document->body(),
                // $document->slug
            // ));
        
         $files = File::files(resource_path("posts/"));

         return array_map(fn($file) => $file->getContents(), $files);

    }

    public static function find($slug)
    {
        if(!file_exists($path = resource_path("posts/{slug}.html"))) {
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.($slug)", 1200, fn() => file_get_contents($path));
            // return static::all()->firstWhere("slug", $slug);

            //$posts->firstWhere("slug", $slug);

    }




}
