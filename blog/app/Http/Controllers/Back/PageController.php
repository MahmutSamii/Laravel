<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    public function orders(Request $request){
        foreach ($request->get('page') as $key => $order){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }

    public function index(){
        $pages = Page::all();
        return view('back.pages.index',compact('pages'));
    }

    public function create(){
        return view('back.pages.create');
    }

    public function post(Request $request){
        $last = Page::orderBy('order', 'desc')->first();

        $page=new Page;
        $page->title=$request->title;
        $page->content=$request->get('content');;
        $page->order=$last->order+1;
        $page->slug=str_slug($request->title);

        if ($request->hasFile('image')){
            $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Başarılı', 'Sayfa Başarıyla Oluşturuldu');
        return redirect()->route('admin.page.index');
    }

    public function update($id){
        $page = Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function updatePost(Request $request, $id)
    {
        $page=Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->get('content');;
        $page->slug=str_slug($request->title);

        if ($request->hasFile('image')){
            $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }

        $page->save();
        toastr()->success('Başarılı', 'Sayfa Başarıyla Güncellendi');
        return redirect()->route('admin.page.index');
    }

    public function delete($id){
        $page = Page::find($id);
        if(File::exists($page->images)){
            File::delete(public_path($page->images));
        }
        $page->forceDelete();
        toastr()->success('Sayfa Başarıyla Silindi');
        return redirect()->route('admin.page.index');
    }

    public function switch(Request $request){
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu ? 1 : 0;
        $page->save();
    }
}
