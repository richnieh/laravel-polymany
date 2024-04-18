<?php

use App\Models\Posts;
use App\Models\Tags;
use App\Models\Videos;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//first two php regarding, second two JS regarding
Route::get('/insertPost/{title}/{content}', function($title, $content){
    return Posts::create(['title'=>$title, 'content'=>$content]);
});

//first two php regarding, second two JS regarding
Route::get('/insertVideo/{path}', function($path){
    return Videos::create(['path'=>$path]);
});

//php and javascript
Route::get('/insertTag/{tag}', function($tag){
    return Tags::create(['name'=>$tag]);
});

//establishing taggable data, linking tables
Route::get('insertData/{postId}/{vidId}', function($postId, $vidId){
    $post = Posts::findOrFail($postId); //find first php post
    $tag1 = Tags::findOrFail(2); //find php tag
    $post->tags()->save($tag1); //Save the tag to taggable
    $video = Videos::findOrFail($vidId);
    $tag2 = Tags::findOrFail(2);
    $video->tags()->save($tag2);
});

//read tags through posts
Route::get('readTagFromPost/{postId}', function($postId){
    $post = Posts::findOrFail($postId);
    foreach($post->tags as $tag){
        echo $tag->name."<br />";
    }
});

//read tags through videos
Route::get('readTagFromVid/{videoId}', function($videoId){
    $video = Videos::findOrFail($videoId);
    foreach($video->tags as $tag){
        echo $tag->name."<br />";
    }
});

//update tag with post
Route::get('updateTagTitle/{postId}', function($postId){
    $post = Posts::findOrFail($postId);
    foreach($post->tags as $tag){
        return $tag->whereName('JS')->update(['name'=>'javascript']);
    }
});

//update tag by tag id
Route::get('updateTagByVid/{videoId}/{tagId}', function($videoId, $tagId){
    $video = Videos::findOrFail($videoId);
    $tag = Tags::findOrFail($tagId);
    $video->tags()->save($tag);
});

//attach tag to video
Route::get('attachTagToVid/{videoId}/{tagId}', function($videoId, $tagId){
    $video = Videos::findOrFail($videoId);
    $tag = Tags::findOrFail($tagId);
    $video->tags()->attach($tag);
});

//delete tag by post
Route::get('deleteTagPost', function(){
    $post = Posts::findOrFail(1);
    foreach($post->tags as $tag){
        return $tag->whereId(3)->delete();
    }
});

//detach tag
Route::get('detachTag/{videoId}/{tagId}', function($videoId, $tagId){
    $video = Videos::findOrFail($videoId);
    $tag = Tags::findOrFail($tagId);
    $video->tags()->detach($tag);
});
