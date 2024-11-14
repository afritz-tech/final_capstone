@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <h3 class="display-3 font-weight-bold text-white">About Us</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">About Us</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="{{ url('front/img/about-1.jpg') }}" alt="" />
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5">
                        <span class="pr-2">About </span>
                    </p>
                    <h1 class="mb-4"> C.Hub</h1>
                    <p>
                        We're your go-to destination for the latest insights, expert advice, and inspiration in
                        [industry/interest]. Whether you're looking to learn, stay updated, or find solutions to [specific
                        challenges], you've come to the right place.
                    </p>
                    <h2>Our Mission</h2>
                    <p>Our mission is to empower [target audience] with valuable content that educates, informs, and
                        inspires. From in-depth articles and videos to podcasts and webinars, we’re here to provide you with
                        the tools you need to [succeed/learn/grow].</p>

                    <h2>What We Offer</h2>
                    <p>We curate content in a variety of formats, including:</p>
                    <ul>
                        <li><strong>Articles & Blog Posts</strong> – Deep dives into [topics of interest]</li>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
