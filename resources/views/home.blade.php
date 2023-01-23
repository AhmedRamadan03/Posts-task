@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                   <div class="row">
                        <div class="col-2 text-center">
                            <img width="50" height="50" src="{{ auth()->user()->image? asset(auth()->user()->image) : asset('images/user.svg') }}" alt="">
                        </div>
                        <div class="col-10">
                            <!-- Button trigger modal -->
                            <button style="border-radius: 50px; width: 100%"class="btn btn-secondary" onclick="$('.post-modal').modal('show')">
                                What's on Your mind , {{ auth()->user()->name }}
                            </button>

                            <!-- Modal -->
                            @include('layouts.posts.model_form')
                        </div>
                   </div>
                </div>
            </div>

            <br><br>
            <div class="content bg-white p-2">
                @foreach ($posts as $item)
                <div class="card m-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 text-center">
                                <img width="50" height="50" src="{{ optional($item->user)->image? asset(optional($item->user)->image) : asset('images/user.svg') }}" alt="">
                            </div>
                            <div class="col-10 pt-3">
                                <h5><b>{{ optional($item->user)->name }}</b></h5>
                                <p><small>{{ $item->updated_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row pt-3">
                            <div class="col-12">
                                <h5><b>{{ $item->title }}</b></h5>
                                <p>{{ $item->content }}</p>
                            </div>
                            <div class="col-12 ">
                                <img src="{{ $item->image_path }}" style="width: 100%; height: 300px;" alt="">
                            </div>
                            <div class="col-12 pt-2">
                                <hr>
                                <div class="row">
                                    <div class="col-2 d-flex">
                                        @if ( auth()->user()->id  == $item->author)
                                        <a href="{{ route('home' , ['post_id'=>$item->id]) }}" class="btn"> <span data-feather="edit"></span></a>
                                        <a href="{{ route('posts.destroy', $item->id) }}" class="btn  text-danger"> <span data-feather="trash-2"></span></a>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="comment">
                                            <form action="{{ route('comments.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="post_id">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <textarea name="comment" id="" cols="30" rows="1" class="form-control"></textarea>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="submit" class="btn btn-info" value="comment">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pt-2">
                                <hr>
                               @foreach ($item->comments()->get() as $comment)
                               <div class="row">
                                <div class="col-2">
                                    @if ( auth()->user()->id  == $comment->user_id)
                                        <a href="{{ route('comments.destroy' , $comment->id) }}" class="btn text-danger"> <span data-feather="trash-2"></span></a>
                                    @endif
                                </div>
                                <div class="col-10">
                                    <div class="comment">
                                        <b><span>{{ optional($comment->user)->name }}</span> </b><p><small>{{ $comment->created_at->diffForHumans() }}</small></p>
                                        <p class="text-muted"> {{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                               @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
