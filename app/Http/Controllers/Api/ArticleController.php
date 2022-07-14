<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::with('media')->get();
//        return Article::last()->getMedia('articles');
    }

    public function store(Request $request)
    {
        $article = Article::create([
            'name' => $request->get('name'),
        ]);

        if (!$request->hasFile('avatar') && !$request->file('avatar')->isValid()) {
            return 'No File';
        }

//        $file = $request->file('avatar');

//        $store_file_path = storeFile($file, 'articles', $article->id, $article->name);
//
//        $article->addMedia(storage_path("app/public/${store_file_path}"))
//            ->toMediaCollection('articles');

//        $store_file_path = storeFile($file, 'articles', $article->id, $article->name);
//        $article->addMedia(storage_path("app/public/${store_file_path}"))
//            ->toMediaCollection('articles');

        $article->addMediaFromRequest('avatar')
            ->withResponsiveImages()
            ->toMediaCollection('articles');

        return $article->loadMissing(['media']);
    }

    public function show(Article $article)
    {
         $article->loadMissing(['media']);
        return [
            'article' => $article,
            'thumb' => $article->getFirstMediaUrl('articles', 'thumb'),
        ];
    }

    public function update(Request $request, Article $article)
    {

        $article->update([
            'name' => $request->get('name'),
        ]);


        if (!$request->hasFile('avatar') && !$request->file('avatar')->isValid()) {
            return 'No File';
        }

//        $file = $request->file('avatar');

//        $store_file_path = storeFile($file, 'articles', $article->id, $article->name);
//
//        $article->addMedia(storage_path("app/public/${store_file_path}"))
//            ->toMediaCollection('articles');

//        $store_file_path = storeFile($file, 'articles', $article->id, $article->name);
//        $article->addMedia(storage_path("app/public/${store_file_path}"))
//            ->toMediaCollection('articles');

        $article->addMediaFromRequest('avatar')
            ->toMediaCollection('articles');

        return $article->loadMissing('media');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return 'Success';
    }

    public function destroyAll()
    {
        Article::all()->each->delete();
        return 'Success';
    }
}
