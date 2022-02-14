@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
              <form action="{{route('admin.config.update')}}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Başlığı</label>
                                <input type="text" value="{{$config->title}}" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Aktiflik Durumu</label>
                                <select name="active" class="form-control">
                                    <option @if($config->active==1) selected @endif value="1">Açık</option>
                                    <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Site Logo</label>
                              <input type="file" value="{{$config->logo}}" name="logo" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Site Favicon</label>
                              <input type="file" value="{{$config->favicon}}" name="favicon" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Facebook</label>
                              <input type="text" value="{{$config->facebook}}" name="facebook" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Twitter</label>
                              <input type="text" value="{{$config->twitter}}" name="twitter" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Github</label>
                              <input type="text" value="{{$config->github}}" name="github" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Linkedin</label>
                              <input type="text" value="{{$config->linkedin}}" name="linkedin" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Youtube</label>
                              <input type="text" value="{{$config->youtube}}" name="youtube" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">İnstagram</label>
                              <input type="text" value="{{$config->instagram}}" name="instagram" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
                  </div>
              </form>
        </div>
    </div>

@endsection

