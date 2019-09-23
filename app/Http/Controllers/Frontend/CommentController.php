<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function insert(Request $request){

        $request->validate([
            'comment_body' => 'required|min:5|max:2000'
        ]);

        $email = \Auth::user()->email;
        $product_id     = $request->product_id;
        $body           = $request->comment_body;
        $star_rating    = $request->star_rating;

        $checkEmailOrName = User::where('email',$email)->first();
       if($checkEmailOrName){
           // insert into the comments table
           Comment::insert([
               'product_id'     => $product_id,
               'name'           => $checkEmailOrName->name,
               'email'          => $checkEmailOrName->email,
               'body'           => $body,
               'star_rating'    => $star_rating,
               'created_at'     => Carbon::now(),

           ]);
           return back()->with('success','Thanks for your comment!!');
       }


    }
}
