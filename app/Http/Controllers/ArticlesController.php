<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\ArticleTags;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function getArticles()
    {
        try {
            $articles = Articles::with('tags')->get();
            return response()->json(['status'=> 200, 'data'=> $articles, 'message'=> 'Articles retrieved successfully']);
        } catch (\Exception $e) {
            return ['status'=> 201, 'data'=> [], 'message'=> 'Something went wrong'];
        }
    }

    public function createArticle(Request $request)
    {
        try {
            $article = Articles::create($request->except('tags'));
            $article->syncTags($article->id, $request->input('tags'));
            return response()->json(['status'=> 200, 'data'=> $article, 'message'=> 'Articles saved successfully']);
        } catch (\Exception $e) {
            return ['status'=> 201, 'data'=> [], 'message'=> 'Something went wrong'];
        }
    }

    public function deleteArticle(Request $request)
    {
        try {
            $article = Articles::find($request->id);
            $article->delete();
            return response()->json(['status'=> 200, 'data'=> $article, 'message'=> 'Articles saved successfully']);
        } catch (\Exception $e) {
            return ['status'=> 201, 'data'=> [], 'message'=> 'Something went wrong'];
        }
    }

    public function articleDetails(Request $request)
    {
        try {
            $article = Articles::with('tags')->find($request->id);
            return response()->json(['status'=> 200, 'data'=> $article, 'message'=> 'Article retrieved successfully']);
        } catch (\Exception $e) {
            return ['status'=> 201, 'data'=> [], 'message'=> 'Something went wrong'];
        }
    }

    public function updateArticle(Request $request)
    {
        try {
            $article = Articles::find($request->id);
                $article->title = $request->details['title'];
                $article->body = $request->details['body'];
                $article->status = $request->details['status'];
            $article->save();

            ArticleTags::where('article_id', $request->id)->delete();
            $article->syncTags($request->id, $request->input('details')['tags']);
            return response()->json(['status'=> 200, 'data'=> $article, 'message'=> 'Article retrieved successfully']);
        } catch (\Exception $e) {
            return ['status'=> 201, 'data'=> [], 'message'=> 'Something went wrong'];
        }
    }
}
