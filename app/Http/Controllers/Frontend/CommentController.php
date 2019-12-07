<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\LikeUnlike;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function insert(Request $request){

       $validate =  $request->validate([
            'comment_body' => 'required|min:4|max:3000'
        ]);

        if ($validate){
            $email = Auth::user()->email;
            $product_id     = $request->product_id;
            $body           = $request->comment_body;
            $star_rating    = $request->star_rating;
            $checkEmail = User::where('email',$email)->first();
            if($checkEmail){
                // insert into the comments table
                Comment::insert([
                    'product_id'     => $product_id,
                    'name'           => $checkEmail->name,
                    'email'          => $checkEmail->email,
                    'body'           => $body,
                    'star_rating'    => $star_rating,
                    'created_at'     => Carbon::now(),

                ]);
                /*return back()->with('success','Thanks for your comment!!');*/

                return response()->json([
                    'success' => "Comment Added Successfully !",
                ]);
            }

        }else{
            return response()->json(['error'=>$validate->errors()->all()]);
        }


    }


    public function getComment(Request $request){

         $comments = Comment::latest()->where('product_id', $request->product_id)->get();

         return view('fontend.pages.comment', compact('comments'));
    }




    public function like(Request $request)
    {

        $like_status = $request->like_s;

        $comment_id = $request->comment_id;
        $change_like = 0;

        $find = LikeUnlike::where('comment_id', $comment_id)->where('user_id', Auth::id())->first();

        if (!$find){
            $new_like =new LikeUnlike;
            $new_like->comment_id = $comment_id;
            $new_like->user_id = Auth::id();
            $new_like->like = 1;
            $new_like->save();
            $is_like = 1;

        }elseif ($find->like == 1){
            LikeUnlike::where(['comment_id' => $comment_id,  'user_id' => Auth::id()])->delete();
            $is_like = 0;


        }elseif($find->like == 0){
            LikeUnlike::where(['comment_id' => $comment_id,  'user_id' => Auth::id()])->update(['like' => 1]);
            $is_like = 1;
            $change_like = 1;

        }
        $response = array(
            'is_like' =>$is_like,
            'change_like' =>$change_like,
        );

        return response()->json($response,200);

    }


    public function dislike(Request $request){

        $like_status = $request->like_s;
        $comment_id = $request->comment_id;
        $change_dislike = 0;

        $findDislike = LikeUnlike::where(['comment_id'=>$comment_id,  'user_id'=>Auth::id()])->first();

        if (!$findDislike){
            $new_like =new LikeUnlike;
            $new_like->comment_id = $comment_id;
            $new_like->user_id = Auth::id();
            $new_like->like = 0;
            $new_like->save();

            $is_dislike = 1;

        }elseif ($findDislike->like == 0){
            LikeUnlike::where(['comment_id' => $comment_id,  'user_id' => Auth::id()])->delete();
            $is_dislike = 0;


        }elseif($findDislike->like == 1){
            LikeUnlike::where(['comment_id' => $comment_id,  'user_id' => Auth::id()])->update(['like' => 0]);
            $is_dislike = 1;
            $change_dislike = 1;

        }
        $response = array(
            'is_dislike' =>$is_dislike,
            'change_dislike' =>$change_dislike,
        );

        return response()->json($response,200);

    }

}
