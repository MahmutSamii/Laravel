@if(count($articles) > 0)
@foreach($articles as $article)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
            <h2 class="post-title">{{$article->title}}</h2>
            <img width="800" height="400" src="{{asset($article->images)}}">
            <h3 class="post-subtitle">{!!  str_limit($article->content,75) !!}</h3>
        </a>
        <p class="post-meta">
            Kategori :
            <a href="#!">{{$article->getCategory->name}}</a>
            <span style="float: right">{{$article->created_at->diffForHumans()}}</span>
        </p>
    </div>
    @if(!$loop->last)
        <hr class="my-4" />
    @endif
@endforeach
<div class="">
    {{$articles->links()}}
</div>
@else
    <div class="alert alert-danger">
        <h1>Bu Kategoriye Ait Yazı Bulunamadı.</h1>
    </div>
@endif

