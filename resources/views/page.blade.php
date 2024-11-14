@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="px-0 mb-5 container-fluid bg-primary px-md-5">
        <div class="px-3 row align-items-center">
            <div class="text-center col-lg-6 text-lg-left">
                <h4 class="mt-5 mb-4 text-white mt-lg-0"></h4>
                <p class="mb-4 text-white">
                    It's More Fun in Cebu City.
                </p>
                <a href="" class="px-5 py-3 mt-1 btn btn-secondary">Jump on</a>
            </div>
            <div class="text-center col-lg-6 text-lg-right">
                <img class="mt-5 img-fluid" src="{{ url('front/img/header.png') }}" alt="" />
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
