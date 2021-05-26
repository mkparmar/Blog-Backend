<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ArticleTags;

class Articles extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'body', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function tags() {
        return $this->hasMany(ArticleTags::class, 'article_id');
    }

    public function syncTags($id, $tags) {
        //DB::table('article_tags')->where('article_id', $id)->delete();
        foreach ($tags as $tag) {
            ArticleTags::create(['article_id'=> $id, 'tag'=> $tag]);
        }
    }
}
