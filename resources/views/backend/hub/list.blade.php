@extends('backend.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">


            <div class="col-lg-12">
                @include('layouts.message')
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Hub List (total: {{ $getResult->total() }})
                            <a href="{{ url('panel/hub/add') }}" class="btn btn-primary"
                                style="float: right;margin-top: -12px;">Add
                                New (+)</a>
                        </h5>

                        <form class="row g-3" accept="get">

                            <div class="col-md-1" style="margin-bottom: 10px;">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" value="{{ Request::get('id') }}" name="id">
                            </div>
                            @if (Auth::user()->is_admin == 1)
                                <div class="col-md-2">
                                    <label class="form-label" style="margin-bottom: 10px;">Username</label>
                                    <input type="text" class="form-control" value="{{ Request::get('username') }}"
                                        name="username">
                                </div>
                            @endif
                            <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 10px;">Title</label>
                                <input type="text" class="form-control" value="{{ Request::get('title') }}"
                                    name="title">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 10px;">Category</label>
                                <input type="text" class="form-control" value="{{ Request::get('category') }}"
                                    name="category">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 10px;">Publish</label>
                                <select class="form-control" name="is_publish">
                                    <option value="">Select</option>
                                    <option {{ Request::get('is_publish') == 1 ? 'selected' : '' }} value="1">
                                        Active</option>
                                    <option {{ Request::get('is_publish') == 100 ? 'selected' : '' }} value="100">
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 10px;">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option {{ Request::get('status') == 1 ? 'selected' : '' }} value="1">Active
                                    </option>
                                    <option {{ Request::get('status') == 100 ? 'selected' : '' }} value="100">
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 10px;">Start Date</label>
                                <input type="date" class="form-control" value="{{ Request::get('start_date') }}"
                                    name="start_date">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 10px;">End Date</label>
                                <input type="date" class="form-control" value="{{ Request::get('end_date') }}"
                                    name="end_date">
                            </div>

                            <div class="col-12">
                                <label class="form-label" style="display: block;">&nbsp;</label>
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ url('panel/hub/list') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>

                        <hr>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    @if (Auth::user()->is_admin == 1)
                                        <th scope="col">Username</th>
                                    @endif
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Publish</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($getResult as $value)
                                    <tr>
                                        <th scope="row">{{ $value->id }}</th>
                                        <td>
                                            @if (!empty($value->getImage()))
                                                <img src="{{ $value->getImage() }}" style="height: 100px; width: 100px;">
                                            @endif
                                        </td>
                                        @if (Auth::user()->is_admin == 1)
                                            <td>{{ $value->user_name }}</td>
                                        @endif
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>{{ !empty($value->status) ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ !empty($value->is_publish) ? 'Yes' : 'No' }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('panel/hub/edit' . $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete it?');"
                                                href="{{ url('panel/hub/delete' . $value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">Result not found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $getResult->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
