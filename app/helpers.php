<?php

use App\Models\News;

if (!function_exists('seed_news')) {
    function seed_news($articles)
    {
        foreach ($articles as $article) {
            $articleDate= date('Y-m-d', strtotime($article->publishedAt));
            $articleTime = date('H:i', strtotime($article->publishedAt));
            $articleContent= substr($article->content, 0, 199);
            News::updateOrCreate([
                'source'=> $article->source->name,
                'author'=> $article->author,
                'title'=> $article->title,
                'description'=> $article->description,
                'content'=> utf8_encode($articleContent),
                'date'=> $articleDate,
                'time'=>$articleTime,
                'url'=> $article->url,
                'urlToImage'=> $article->urlToImage,
            ]);
        }
        return "done";
    }
}
