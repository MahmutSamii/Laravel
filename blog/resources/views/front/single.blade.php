@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',asset($article->images))
@section('content')
                <div class="col-md-9 mx-auto">
                    {{$article->content}}
                    <div class="mt-3"><span class="text-danger">Okunma Sayısı : <b>{{$article->hit}}</b></span></div>
                </div>
    @include('front.widgets.category')
@endsection
