@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary">
                <strong>{{$articles->count()}}</strong> Makale Bulundu
            </h6>
            <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm">Aktif Makaleler</a>
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
                        <th>Silinme Tarihi</th>
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
                            <td>{{$article->deleted_at->diffForHumans()}}</td>
                            <td class="col-1">
                                <a href="{{route('admin.recover.article',$article->id)}}" title="Geri Al" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Tamamen Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

