<div class="">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('addUserComment') }}">
            {{-- <form method="POST" action="{{ url('comments') }}"> --}}
            {{-- <form method="POST" action=""> --}}
                @csrf
                
                <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
                <input type="hidden" name="commentable_id" value="{{ $model->id }}" />
                <div class="form-group">
                    <label for="message">Enter your message here:</label>
                    <textarea class="commentText{{ $model->id }} form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="3"></textarea>
                    <div class="invalid-feedback">
                        Your message is required.
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase submitComment" user="1" receiver_id={{ $model->id }}>Submit</button>
            </form>
        </div>
    </div>
</div>
<br />