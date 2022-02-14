@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
<div class="col-md-9 mx-auto">
@include('front.widgets.article')
</div>
@include('front.widgets.category')
@endsection
