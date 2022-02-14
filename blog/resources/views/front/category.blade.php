@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi')
@section('content')
    <div class="col-md-9">
        @include('front.widgets.article')
    </div>
    @include('front.widgets.category')
@endsection
