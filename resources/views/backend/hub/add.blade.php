@extends('backend.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Hub</h5>


                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label class="form-label">Title *</label>
                                <input type="text" class="form-control" required name="title">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Category *</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($getCategory as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Image *</label>
                                <input type="file" class="form-control" name="image_file" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description *</label>
                                <textarea name="description" class="form-control tinymce-editor"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Description *</label>
                                <textarea name="meta_description" class="form-control"></textarea>
                                <div style="color: red">{{ $errors->first('meta_description') }}</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Keywords *</label>
                                <input type="text" class="form-control" value="{{ old('meta_keywords') }}"
                                    name="meta_keywords">
                                <div style="color: red">{{ $errors->first('meta_keywords') }}</div>
                            </div>

                            <hr>

                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Publish *</label>
                                <select class="form-control" name="is_publish">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Status *</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
