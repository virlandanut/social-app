<x-layout>

    <div class="container py-md-5 container--narrow">
        <p><strong><a href="/post/{{$post->id}}">&laquo; Back</a></strong></p>
        <form action="/post/{{$post->id}}/edit" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
                <input name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text"
                    placeholder="" autocomplete="off" value="{{old('title', $post->title)}}" />
            </div>
            @error('title')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            <div class="form-group">
                <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
                <textarea name="body" id="post-body" class="body-content tall-textarea form-control"
                    type="text">{{old('body', $post->body)}}</textarea>
            </div>
            @error('body')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            <button class="btn btn-primary">Save Changes</button>
        </form>
    </div>

</x-layout>
