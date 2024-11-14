<?php

namespace App\Http\Controllers;

use App\Models\HubModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function hub()
    {
        $data['getResult'] = HubModel::getResult();
        return view('backend.hub.list', $data);
    }

    public function add_hub()
    {
        $data['getCategory'] = CategoryModel::getCategory();
        return view('backend.hub.add', $data);
    }

    public function insert_hub(Request $request)
    {

        $get = new HubModel;
        $get->user_id = Auth::user()->id;
        $get->title = trim($request->title);
        $get->category_id = trim($request->category_id);
        $get->description = trim($request->description);
        $get->meta_description = trim($request->meta_description);
        $get->meta_keywords = trim($request->meta_keywords);
        $get->is_publish = trim($request->is_publish);
        $get->status = trim($request->status);
        $get->save();

        $slug = Str::slug($request->title);

        $checkSlug = HubModel::where('slug', '=', $slug)->first();
        if(!empty($checkSlug))
        {
            $dbslug = $slug.'-'.$get->id;
        }
        else
        {
            $dbslug = $slug;
        }

        $get->slug = $dbslug;

        if(!empty($request->file('image_file')))
        {
            $ext = $request->file('image_file')->getClientOriginalExtension();
            $file = $request->file('image_file');
            $filename = $dbslug.'.'.$ext;
            $file->move('upload/hub/', $filename);
            $get->image_file = $filename;

        }

            $get->save();

            return redirect('panel/hub/list')->with('success', 'Hub successfully created');
    }


    public function edit_hub($id)
    {
        $data['getCategory'] = CategoryModel::getCategory();
        $data['getResult'] = HubModel::getSingle($id);
        return view('backend.hub.edit', $data);
    }

    public function update_hub($id, Request $request)
    {
        $get = HubModel::getSingle($id);
        $get->title = trim($request->title);
        $get->category_id = trim($request->category_id);
        $get->description = trim($request->description);
        $get->meta_description = trim($request->meta_description);
        $get->meta_keywords = trim($request->meta_keywords);
        $get->is_publish = trim($request->is_publish);
        $get->status = trim($request->status);

        if(!empty($request->file('image_file')))
        {
            if(!empty($get->getImage()))
            {
                unlink('upload/hub/'.$get->image_file);
            }
            $ext = $request->file('image_file')->getClientOriginalExtension();
            $file = $request->file('image_file');
            $filename = $get->slug.'.'.$ext;
            $file->move('upload/hub/', $filename);
            $get->image_file = $filename;

        }

            $get->save();

            return redirect('panel/hub/list')->with('success', 'Hub successfully updated');
    }


    public function delete_hub($id)
    {
        $get = HubModel::getSingle($id);
        $get->is_delete = 1;
        $get->save();

        return redirect()->back()->with('success', 'Hub successfully deleted');
    }

}


