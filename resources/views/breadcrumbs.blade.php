<div class="page-nav">
    <span>
        <a href="/">首页</a>
    </span>
    @if (isset($forum))
        <span>
            <a href="{{ route('forum.show',$forum->id) }}">{{$forum->forum_name}}</a>
        </span>
    @endif

    @if (isset($topic))
        <span>
            <a href="{{ route('forum.show',$topic->forum->id) }}">{{$topic->forum->forum_name}}</a>
        </span>
        <span>
            <a href="">xxx</a>
        </span>
    @endif


</div>


