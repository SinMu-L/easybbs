<div class="page-nav">
    <span>
        <a href="/">话题</a>
    </span>
    @if (isset($topic))

        <span>
            <a href="{{ route('topic.show',$topic->id) }}">{{$topic->title}}</a>
        </span>
    @endif


</div>


