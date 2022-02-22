@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary">
                <strong>{{$user->count()}}</strong> Kullanıcı Bulundu
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
                        <th>İsim</th>
                        <th>E-mail</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($user as  $page)
                        <tr>
                            <td>{{$page->name}}</td>
                            <td>{{$page->email}}</td>
                            <td class="col-2">
                                <a href="{{route('admin.users.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
@endsection
