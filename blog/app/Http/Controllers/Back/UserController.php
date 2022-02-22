<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function index(){
         $user = Users::all();
         return view('back.users.index',compact('user'));
    }

    public function create(){

    }

    public function delete($id){
        Users::find($id)->delete();
        toastr()->success('Başarılı', 'Kullanıcı Başarıyla Silindi');
        return redirect()->route('admin.users');
    }
}
