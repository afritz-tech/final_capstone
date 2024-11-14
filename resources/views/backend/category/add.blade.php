@extends('backend.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Category</h5>


                        <form class="row g-3" action="" method="post">
                            @csrf
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Name *</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" required
                                    name="name" id="inputName5">
                                <div style="color: red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Title *</label>
                                <input type="text" class="form-control" value="{{ old('title') }}" required
                                    name="title">
                                <div style="color: red">{{ $errors->first('title') }}</div>
                            </div>

                            <hr>

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
                                <label for="inputPassword5" class="form-label">Status *</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="text-center">
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
