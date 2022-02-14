@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Yeni Kategori Oluştur
                </h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.category.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    @yield('title')
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%;" class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Makale Sayısı</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as  $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td><input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif"  @if($category->status===1) data-on="Aktif" data-onstyle="success" checked @else data-offstyle="danger" data-off="Pasif" @endif data-toggle="toggle"></td>
                                <td class="col-2">
                                    <a category-id="{{$category->id}}" class="btn btn-primary btn-sm edit-click" title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                                    <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" class="btn btn-danger btn-sm remove-click" title="Kategoriyi Sil"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input id="category" type="text" class="form-control" name="category">
                        <input type="hidden" name="id" id="category-id">
                    </div>
                    <div class="form-group">
                        <label>Kategori Slug</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Sil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="body" class="modal-body">
                <div class="alert alert-danger" id="articleAlert">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                <form action="{{route('admin.category.delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                </form>
            </div>
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
            $('.remove-click').click(function (){
                var id = $(this)[0].getAttribute('category-id');
                var count = $(this)[0].getAttribute('category-count');
                var name = $(this)[0].getAttribute('category-name');
                if(id == 1){
                    $('#articleAlert').html(name+' Kategorisi Sabit Bir Kategoridir.Silinen Diğer ' +
                        'Kategorilere Ait Makaleler Bu Kategoriye Eklenecektir.')
                    $('#body').show();
                    $('#deleteButton').hide();
                    $('#deleteModal').modal();
                    return
                }
                $('#deleteId').val(id);
                $('#deleteButton').show();
                $('#body').hide();
                if (count > 0) {
                 $('#articleAlert').html('Bu Kategoriye ait '+count+' Makale Bulunmaktadır.Silmek İstediğinizden Emin misiniz?')
                 $('#body').show();
                }
               $('#deleteModal').modal();
            });
            $('.edit-click').click(function (){
                var id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.category.getdata')}}',
                    data:{id:id},
                    success: function(data){
                        $('#category').val(data.name);
                        $('#slug').val(data.slug);
                        $('#category-id').val(data.id);
                        $('#myModal').modal();
                    }
                });
            });

            $('.switch').change(function() {
                var id = $(this)[0].getAttribute('category-id');
                var statu = $(this).prop('checked') === true ? 1 : 0;
                $.get("{{route('admin.category.switch')}}",{id:id,statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection

