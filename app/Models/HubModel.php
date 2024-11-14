<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use illuminate\support\facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HubModel extends Model
{
    use HasFactory;

    protected $table = 'hub';


    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getResultSlug($slug)
    {
         // Start building the query
         return self::select('hub.*', 'users.name as user_name', 'category.name as category_name')
         ->join('users', 'users.id', '=', 'hub.user_id')
         ->join('category', 'category.id', '=', 'hub.category_id')
         ->where('hub.status', '=', 1)
         ->where('hub.is_publish', '=', 1)
         ->where('hub.is_delete', '=', 0)
         ->where('hub.slug', '=', $slug)
         ->first();
    }

    static public function getRecentPost()
    {
         // Start building the query
        return self::select('hub.*', 'users.name as user_name', 'category.name as category_name')
        ->join('users', 'users.id', '=', 'hub.user_id')
        ->join('category', 'category.id', '=', 'hub.category_id')
        ->where('hub.status', '=', 1)
        ->where('hub.is_publish', '=', 1)
        ->where('hub.is_delete', '=', 0)
        ->orderBy('hub.id', 'desc')
        ->limit(3)
        ->get();

    }

    public static function getResultFront()
{
    $query = HubModel::select('hub.*', 'users.name as user_name', 'category.name as category_name')
        ->join('users', 'users.id', '=', 'hub.user_id')
        ->join('category', 'category.id', '=', 'hub.category_id');

    // Check if the 'q' parameter exists and apply the search filter
    if (!empty(request()->get('q'))) {
        $query->where('hub.title', 'like', '%' . request()->get('q') . '%');
    }

    // Apply filters and paginate the results
    return $query->where('hub.status', '=', 1)
        ->where('hub.is_publish', '=', 1)
        ->where('hub.is_delete', '=', 0)
        ->orderBy('hub.id', 'desc')
        ->paginate(10);  // Use paginate() instead of get()
}


    static public function getResult()
    {
       // Start building the query
    $return = self::select('hub.*', 'users.name as user_name', 'category.name as category_name')
        ->join('users', 'users.id', '=', 'hub.user_id')
        ->join('category', 'category.id', '=', 'hub.category_id');

        if(!empty(Auth::check()) && Auth::user()->is_admin != 1)
        {
            $return = $return->where('hub.user_id', '=', Auth::user()->id);
        }

    // Apply filters based on the request parameters

    // Check for 'id' parameter in the request
    if (!empty(request('id'))) {
        $return = $return->where('hub.id', '=', request('id'));
    }

    // Check for 'username' parameter in the request
    if (!empty(request('username'))) {
        $return = $return->where('users.name', 'like', '%' . request('username') . '%');
    }

    // Check for 'title' parameter in the request
    if (!empty(request('title'))) {
        $return = $return->where('hub.title', 'like', '%' . request('title') . '%');
    }

    // Check for 'category' parameter in the request
    if (!empty(request('category'))) {
        $return = $return->where('hub.category_id', '=', request('category'));
    }

    $is_publish = request('is_publish');

    // Only apply filter if 'is_publish' is present in the request
    if (!empty($is_publish)) {
        // If 'is_publish' is 100, change it to 0
        if ($is_publish == 100) {
            $is_publish = 0;
        }

        // Apply the filter to the query
        $return = $return->where('hub.is_publish', '=', $is_publish);
    }

    $status = request('status');

    // Only apply filter if 'is_publish' is present in the request
    if (!empty($status)) {
        // If 'is_publish' is 100, change it to 0
        if ($status == 100) {
            $status = 0;
        }

        // Apply the filter to the query
        $return = $return->where('hub.status', '=', $status);
    }

    if (!empty(request('start_date'))) {
        $return = $return->whereDate('hub.created_at', '>=', request('start_date'));
    }

    if (!empty(request('end_date'))) {
        $return = $return->whereDate('hub.created_at', '<=', request('end_date'));
    }

    // Filter by non-deleted items
    $return = $return->where('hub.is_delete', '=', 0);

    // Return the paginated results
    return $return->orderBy('hub.id', 'desc')->paginate(30);
    }

    public function getImage()
    {
        if(!empty($this->image_file) && file_exists('upload/hub/'.$this->image_file))
        {
            return url('upload/hub/'.$this->image_file);
        }
        else
        {
            return '';
        }
    }

    public function getComment()
    {
        return $this->hasMany(CommentModel::class, 'hub_id')->orderBy('hub_comment.id', 'desc');
    }

    public function getCommentCount()
    {
        return $this->hasMany(CommentModel::class, 'hub_id')->count();
    }
}
