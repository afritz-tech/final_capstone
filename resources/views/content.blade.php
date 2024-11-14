@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                @include('layouts.message')
                <div class="d-flex flex-column text-left mb-3">
                    <h1 class="mb-3">{{ $getResult->title }}</h1>
                    <div class="d-flex">
                        <p class="mr-3"><i class="fa fa-user text-primary"></i> {{ $getResult->user_name }}</p>
                        <p class="mr-3">
                            <i class="fa fa-folder text-primary"></i>{{ $getResult->category_name }}
                        </p>
                        <p class="mr-3"><i class="fa fa-comments text-primary"></i> {{ $getResult->getCommentCount() }}
                        </p>
                    </div>
                </div>
                <div class="mb-5">
                    @if (!empty($getResult->getImage()))
                        <img style="max-height: 574px;object-fit:cover;" class="img-fluid rounded w-100 mb-4"
                            src="{{ $getResult->getImage() }}" alt="Image" />
                    @endif

                    {!! $getResult->description !!}

                </div>

                <div class="mb-5">
                    <h2 class="mb-4">{{ $getResult->getComment->count() }}</h2>

                    @foreach ($getResult->getComment as $comment)
                        <div class="media mb-4">
                            <img src="front/img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1"
                                style="width: 45px" />
                            <div class="media-body">
                                <h6>
                                    {{ $comment->user->name }}
                                    <small><i>{{ date('d M Y', strtotime($comment->created_at)) }} at
                                            {{ date('h:i A', strtotime($comment->created_at)) }}</i></small>
                                </h6>
                                <p>
                                    {{ $comment->comment }}
                                </p>
                                <button class="btn btn-sm btn-light ReplyOpen" id="{{ $comment->id }}">Reply</button>

                                {{-- Check if replies exist before looping --}}
                                @if ($comment->getReply && $comment->getReply->count() > 0)
                                    @foreach ($comment->getReply as $reply)
                                        <div class="media mt-4">
                                            <img src="front/img/user.jpg" alt="Image"
                                                class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px" />
                                            <div class="media-body">
                                                <h6>
                                                    {{ $reply->user->name }}
                                                    <small><i>{{ date('d M Y', strtotime($reply->created_at)) }} at
                                                            {{ date('h:i A', strtotime($reply->created_at)) }}</i></small>
                                                </h6>
                                                <p>{{ $reply->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No replies yet.</p>
                                @endif

                                <div class="bg-light p-3 ShowReply{{ $comment->id }}" style="display:none;">
                                    <h2 class="mb-4">Reply a comment</h2>
                                    <form method="post" action="{{ url('comment-reply-submit') }}">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <div class="form-group">
                                            <label for="message">Comment *</label>
                                            <textarea name="comment" required cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Reply" class="btn btn-primary px-3" />
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="bg-light p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form method="post" action="{{ url('comment-submit') }}">
                        @csrf
                        <input type="hidden" name="hub_id" value="{{ $getResult->id }}">
                        <div class="form-group">
                            <label for="message">Comment *</label>
                            <textarea name="comment" required cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave Comment" class="btn btn-primary px-3" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">

                <div class="mb-5">
                    <form action="{{ url('hub') }}" method="GET">
                        <div class="input-group">
                            <input name="q" type="text" required class="form-control form-control-lg"
                                placeholder="Keyword" />
                            <div class="input-group-append">
                                <button class="input-group-text bg-transparent text-primary"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <ul class="list-group list-group-flush">
                        @foreach ($getCategory as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="">{{ $category->name }}</a>
                                <span class="badge badge-primary badge-pill">{{ $category->totalhub() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>

                    @foreach ($getRecentPost as $posts)
                        <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                            @if (!empty($posts->getImage()))
                                <img class="img-fluid" src="{{ $posts->getImage() }}" style="width: 80px; height: 80px" />
                            @endif
                            <div class="pl-3">
                                <a href="{{ url($posts->slug) }}">
                                    <h5 class="">{!! strip_tags(Str::substr($posts->title, 0, 20)) !!}</h5>
                                </a>
                                <div class="d-flex">
                                    <small class="mr-3"><i class="fa fa-user text-primary"></i>
                                        {{ $posts->user_name }}</small>
                                    <small class="mr-3"><i class="fa fa-folder text-primary"></i>
                                        {{ $posts->category_name }}</small>
                                    <small class="mr-3"><i
                                            class="fa fa-comments text-primary"></i>{{ $posts->getCommentCount() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.ReplyOpen').click(function() {
            var id = $(this).attr('id');
            $('.ShowReply' + id).toggle();
        });
    </script>
@endsection
