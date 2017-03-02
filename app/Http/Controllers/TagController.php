<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
class TagController extends Controller
{
  public function find(Request $request)
   {
       $term = trim($request->q);

       if (empty($term)) {
           return \Response::json([]);
       }

       $tags = Tag::search($term)->limit(20)->get();

       $formatted_tags = [];

       foreach ($tags as $tag) {
           $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
       }

       return \Response::json($formatted_tags);
   }
}
