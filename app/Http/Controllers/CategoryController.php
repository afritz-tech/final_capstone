<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function category()
    {
        $data['getResult'] = CategoryModel::getResult();
        return view('backend.category.list', $data);
    }

    public function add_category()
    {
        return view('backend.category.add');
    }

    public function insert_category(Request $request)
    {
        // Validate the status input
    $request->validate([
        'status' => 'nullable|integer|in:0,1', // Accepts 0 or 1 as valid values for status
    ]);

        // Create a new User instance
        $get = new CategoryModel;

        $get->name = trim($request->name);
        $get->title = trim($request->title);
        $get->meta_description = trim($request->meta_description);
        $get->meta_keywords = trim($request->meta_keywords);

        // If status is not provided or invalid, set it to 0 (inactive)
        $get->status = !empty($request->status) ? (int) $request->status : 0;

        $get->save();

    return redirect('panel/user/list')->with('success', 'Category successfully created');
    }

    public function edit_category($id)
    {
        $data['getResult'] = CategoryModel::getSingle($id);
        return view('backend.category.edit', $data);
    }

    public function update_category($id, Request $request)
    {
         // Validate the status input
    $request->validate([
        'status' => 'nullable|integer|in:0,1', // Accepts 0 or 1 as valid values for status
    ]);

        // Create a new User instance
        $get = CategoryModel::getSingle($id);
        $get->name      = trim($request->name);
        $get->title     = trim($request->title);
        $get->meta_description  = trim($request->meta_description);
        $get->meta_keywords     = trim($request->meta_keywords);

        // If status is not provided or invalid, set it to 0 (inactive)
        $get->status = !empty($request->status) ? (int) $request->status : 0;

        $get->save();

    return redirect('panel/user/list')->with('success', 'Category successfully updated');
    }

    public function delete_category($id)
    {
        $get = CategoryModel::getSingle($id);
        $get->is_delete = 1;
        $get->save();

        return redirect()->back()->with('success', 'Category successfully deleted');
    }
}
