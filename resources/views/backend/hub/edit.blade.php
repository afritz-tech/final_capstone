@extends('backend.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Hub</h5>


                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label class="form-label">Title *</label>
                                <input type="text" class="form-control" value="{{ $getResult->title }}" required
                                    name="title">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Category *</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($getCategory as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $getResult->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Image *</label>
                                <input type="file" class="form-control" name="image_file">

                                @if (!empty($getResult->getImage()))
                                    <img src="{{ $getResult->getImage() }}" style="height: 100px; width: 100px;">
                                @endif
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description *</label>
                                <textarea name="description" class="form-control tinymce-editor">{{ $getResult->description }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Description *</label>
                                <textarea name="meta_description" class="form-control">{{ $getResult->meta_description }}</textarea>
                                <div style="color: red">{{ $errors->first('meta_description') }}</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Keywords *</label>
                                <input type="text" class="form-control" value="{{ $getResult->meta_keywords }}"
                                    name="meta_keywords">
                                <div style="color: red">{{ $errors->first('meta_keywords') }}</div>
                            </div>

                            <hr>

                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Publish *</label>
                                <select class="form-control" name="is_publish">
                                    <option {{ $getResult->is_publish == 1 ? 'selected' : '' }} value="1">
                                        Active</option>
                                    <option {{ $getResult->is_publish == 0 ? 'selected' : '' }} value="0">Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Status *</label>
                                <select class="form-control" name="status">
                                    <option {{ $getResult->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $getResult->status == 0 ? 'selected' : '' }} value="0">Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-12" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection

@section('script')
@endsection
