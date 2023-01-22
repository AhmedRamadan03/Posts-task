<div class="flash_messages" style="width: 100%;">
    @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" style="border: none;background-color: transparent;color: white;" class="close" data-dismiss="alert" aria-label="Close" onclick="$(this).parent().parent().remove()">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('success')}}
        </div>
    @endif

    @if(Session::has('warning'))
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('warning')}}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$(this).parent().parent().remove()">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('error')}}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$(this).parent().parent().remove()">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul style="margin-bottom: 0;">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
