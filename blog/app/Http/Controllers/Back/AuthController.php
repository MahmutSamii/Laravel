<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('back.auth/login');
    }

    public function loginPost(Request $request){
       if (Auth::attempt(['email' => $request->email,'password' => $request->password])){
           toastr()->success('Tekrardan Hoşgeldiniz',Auth::user()->name);
           return redirect()->route('admin.dashboard');
       }
       return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function create(){
        return view('back.auth.register');
    }

    public function createPost(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
        ]);
        $issetEmail = Users::where('email',$request->email)->first();
       if ($issetEmail){
           return redirect()->route('admin.create')->withErrors('Böyle Bir Email Adresi Zaten Bulunmaktadır!');
       }else{
           $users = new Users();
           $users->name=$request->name;
           $users->email=$request->email;
           $users->password=Hash::make($request->password);
           $users->save();
           if ($users->save()){
               return redirect()->route('admin.create')->with('mesaj','Hesabınız Başarıyla Oluşturuldu!');
           }
           else{
               return redirect()->route('admin.create')->withErrors('Hesabınız Oluşturulurken Bir Hata Oluştu!');
           }
       }
    }

    public function forgotPassword(){
        return view('back.auth.forgot-password');
    }

    public function sifreYenile(Request $request){
        $usermail = DB::table('admins')->where('email',$request->email)->first();
        if ($usermail){
            Mail::to($request->email)->send(new TestMail($usermail));
            return redirect()->back()->with('mesaj','Şifre Yenileme Postu Email Adresinize Başarıyla Gönderilmiştir!');
        }
        else{
            return redirect()->route('admin.forgotPassword')->withErrors('Böyle Bir Email adresi Bulunamadı!');
        }
    }

    public function resetPassword($id){
        return view('back.auth.reset-password',compact('id'));
    }

    public function resetPasswordPost(Request $request,$id){
        $request->validate([
            'password' => 'required|min:6'
        ]);

        $userpassword = Users::findOrFail($id);
        $userpassword->password=Hash::make($request->password);
        $userpassword->save();
        return redirect()->route('admin.login')->with('mesaj','Şifre Yenileme Postu Email Adresinize Başarıyla Gönderilmiştir!');


    }
}
