<div class="modal fade post-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">
            @if ($post_id->id)
                Edit Post
            @else
            Create Post
            @endif
        </h5>
        <a href="{{ route('home') }}" class="btn">X</a>
        </div>
        <form action="{{$post_id->id ?  route('posts.update' , $post_id->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-2 text-center">
                    <img width="50" height="50" src="{{ auth()->user()->image? asset(auth()->user()->image) : asset('images/user.svg') }}" alt="">
                </div>
                <div class="col-10 pt-3">
                    <h5><b>{{ auth()->user()->name }}</b></h5>
                </div>

                <div class="col-12 pt-4">
                    <div class="form-group">
                        <label for=""><b>Title :</b></label>
                        <input type="text" class="form-control " name="title" required placeholder="Title" value="{{ $post_id->title }}">
                    </div>
                </div>
                <div class="col-12 pt-4">
                    <div class="form-group">
                        <label for=""><b>Content Post :</b></label>
                        <textarea name="content" id="" class="form-control " placeholder=" What's on Your mind , {{ auth()->user()->name }}" cols="20" rows="5">
                            {{ $post_id->content }}
                        </textarea>
                    </div>
                </div>
                <div class="col-12 pt-3 ">
                    <label for=""><b>Upload Image :</b></label>
                    <div class="image w3-light-gray p-2 w3-round-xxlarge  text-center" style="border: 2px dashed #afafaf;">
                        <img src="{{ asset($post_id->image) }}" height="250" style="width: 100%" class="image-preview" style="display:none"  alt="">
                        <label for="fileId" class="btn "><i data-feather="upload-cloud"></i></label>
                        <input id="fileId" style="display:none" type="file" name="image" class="form-control image" >

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="width: 100%">Post</button>
        </div>
    </form>
    </div>
    </div>
</div>
