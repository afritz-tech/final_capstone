@extends('backend.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New User</h5>


                        <form class="row g-3" action="" method="post">
                            @csrf
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" required
                                    name="name" id="inputName5">
                                <div style="color: red">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail5" class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                    required id="inputEmail5">
                                <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Password</label>
                                <input type="password" class="form-control" value="{{ old('password') }}" name="password"
                                    required id="inputPassword5">
                                <div style="color: red">{{ $errors->first('password') }}</div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
