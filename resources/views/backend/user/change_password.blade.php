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
                        <h5 class="card-title">Change Password</h5>


                        <form class="row g-3" action="" method="post">
                            @csrf
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Old Password</label>
                                <input type="password" class="form-control" required name="old_password" id="inputName5">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail5" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" required id="inputEmail5">
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" required
                                    id="inputPassword5">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Password</button>
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
