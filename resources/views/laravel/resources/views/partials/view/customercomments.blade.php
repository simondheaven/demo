<div class="panel panel-default">
    <div class="panel-heading custom-heading">
      Customer Comments for {{$customer->full_name}}
    </div>
    <div class="panel-body custom-body">
      <a name="comments"></a>
    <legend>Comments</legend>

      @foreach ($customer->comments()->orderBy('id','desc')->get() as $comment)
      <div style="border-top: 1px dotted gray;">
          Added by <strong>{{ $comment->user()->get()[0]->name }}</strong> on {{ date('dS M Y g:i A', strtotime($comment->created_at)) }}
      </div>
      <div style="border-top: 1px dotted gray;border-bottom: 1px dotted gray; margin-bottom:15px;">
        <p>{{$comment->comment}}</p>
      </div>
      @endforeach
      <legend>Add Comment</legend>
      <div>
        {{ Form::open(['route' => 'view.add.comment']) }}
          <input name="uid" type="hidden" value="{{\Auth::user()->id}}">
          <input name="cid" type="hidden" value="{{$customer->id}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <textarea id="commentbox" required name="comment" class="form-control"></textarea>

          </br>
          <div style="text-align:right;">
            <button class="btn btn-primary custom-btn custom-btn-submit">Add Customer Comment</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
