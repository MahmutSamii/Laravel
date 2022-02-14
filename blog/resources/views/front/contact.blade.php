@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://startbootstrap.github.io/startbootstrap-clean-blog/assets/img/contact-bg.jpg')
@section('content')
    <div class="col-md-8">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Eğer İsterseniz Bizimle İletişime Geçebilirsiniz.</p>
        <div class="my-5">
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->
            <form method="post" action="{{route('contact.post')}}">
                @csrf
                <div class="">
                    <label for="name">Ad Soyad</label>
                    <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Ad Soyadınız" data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                </div>
                <div class="">
                    <label for="email">Email adresi</label>
                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Email adresiniz" data-sb-validations="required,email" />
                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                    <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                </div>
                <div class="">
                    <label>Konu</label>
                    <select name="topic" class="form-control">
                        <option @if(old('topic')=='Bilgi') selected @endif>Bilgi</option>
                        <option @if(old('topic')=='Destek') selected @endif>Destek</option>
                        <option @if(old('topic')=='Genel') selected @endif>Genel</option>
                    </select>
                </div>
                <div class="">
                    <label for="message">Mesajınız</label>
                    <textarea class="form-control" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required">{{old('message')}}</textarea>
                    <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                </div>
                <br />
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Gönder</button>
            </form>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Panel Content
            </div>
            <div class="card-body">
                adasfasf
            </div>
        </div>
    </div>
@endsection

