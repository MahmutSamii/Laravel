@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary">
                <strong>{{$pages->count()}}</strong> Makale Bulundu
            </h6>
        </div>
        <div class="card-body">
            <div id="orderSuccess" style="display: none" class="alert alert-success">
                Sıralama Başarıyla Güncellendi
            </div>
            <div class="table-responsive">
                <table style="width:100%;" class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($pages as  $page)
                    <tr id="page_{{$page->id}}">
                        <td style=" width:10px !important;"><i style="cursor: move; color: yellowgreen; margin-top: 30px; margin-left: 30px;" class="fa fa-arrows-alt-v fa-2x handle"></i></td>
                        <td><img src="{{asset($page->image)}}" width="150"></td>
                        <td>{{$page->title}}</td>
                        <td><input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif"  @if($page->status===1) data-on="Aktif" data-onstyle="success" checked @else data-offstyle="danger" data-off="Pasif" @endif data-toggle="toggle"></td>
                        <td class="col-2">
                            <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.page.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $('#orders').sortable({
         handle:'.handle',
         update:function(){
             var siralama = $('#orders').sortable('serialize');
             $.get('{{route('admin.page.orders')}}?'+siralama,function(data, status){
                 $('#orderSuccess').show().delay(1000).fadeOut();
             });
         }
        })
    </script>
    <script>
        $(function() {
            $('.switch').change(function() {
                var id = $(this)[0].getAttribute('page-id');
                var statu = $(this).prop('checked') === true ? 1 : 0;
                $.get("{{route('admin.page.switch')}}",{id:id,statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection
