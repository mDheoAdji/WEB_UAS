<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show($slug)
    {
        $news = News::with('newsCategory')->where('slug', $slug)->first();
        $newests = News::orderBy('created_at', 'desc')->get()->take(4);

        return view('pages.news.show', compact('news', 'newests'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->first();

        return view('pages.news.category', compact('category'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $news = News::where('title', 'like', '%' . $query . '%')->first();

        if ($news) {
            return response()->json(['slug' => $news->slug]);
        }

        return response()->json(['slug' => null]);
    }

}
