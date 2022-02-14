@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary">
                <strong>{{$articles->count()}}</strong> Makale Bulundu
            </h6>
            <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm" title="Silinen Makaleler"><i class="fa fa-trash"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="width:100%;" class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as  $article)
                    <tr>
                        <td><img src="{{asset($article->images)}}" width="150"></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td><input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif"  @if($article->status===1) data-on="Aktif" data-onstyle="success" checked @else data-offstyle="danger" data-off="Pasif" @endif data-toggle="toggle"></td>
                        <td class="col-2">
                            <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                var id = $(this)[0].getAttribute('article-id');
                var statu = $(this).prop('checked') === true ? 1 : 0;
                $.get("{{route('admin.switch')}}",{id:id,statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection
