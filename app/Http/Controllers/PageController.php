<?php

namespace App\Http\Controllers;

use App\Models\HubModel;
use App\Models\CommentModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\Reply_SubmitModel;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function page()
    {
        return view('page');
    }

    public function about()
    {
        return view('about');
    }

    public function hub()
    {
        $data['getResult'] = HubModel::getResultFront();
        return view('hub', $data);
    }

    public function contact()
    {
        return view('contact');
    }

    public function contentdetail($slug)
    {

        $getResult = HubModel::getResultSlug($slug);
        if(!empty($getResult))
        {
            $data['getCategory'] = CategoryModel::getCategory();
            $data['getRecentPost'] = HubModel::getRecentPost();
            $data['getResult'] = $getResult;
            return view('content', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function submit(Request $request)
    {
        $get = new CommentModel;
        $get->user_id = Auth::user()->id;
        $get->hub_id  = $request->hub_id;
        $get->comment = $request->comment;
        $get->save();

        return redirect()->back()->with('success', 'Your comment successfully');
    }

    public function ReplySubmit(Request $request)
    {
        $get = new Reply_SubmitModel();
        $get->user_id = Auth::user()->id;
        $get->comment_id  = $request->comment_id;
        $get->comment = $request->comment;
        $get->save();

        return redirect()->back()->with('success', 'Your reply successfully');
    }

}
