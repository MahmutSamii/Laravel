<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function switch(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu ? 1 : 0;
        $category->save();
    }

    public function create(Request $request){
       $isExist =Category::whereSlug(str_slug($request->category))->first();
       if ($isExist){
        toastr()->error($request->category.' adında bir kategori zaten mevcut!');
        return redirect()->back();
       }
       $category = new Category();
       $category->name = $request->category;
       $category->slug=str_slug($request->slug);
       $category->save();
       toastr()->success('Kategori Başarıyla Oluşturuldu');
       return redirect()->back();
    }

    public function getData(Request $request) {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function update(Request $request){
        $isSlug =Category::whereSlug(str_slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName =Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->category.' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug=str_slug($request->slug);
        $category->save();
        toastr()->success('Kategori Başarıyla Güncellendi');
        return redirect()->back();
    }

    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
        if($category->id === 1){
            toastr()->error('This Category is not allowed to be deleted');
            return redirect()->back();
        }
        $message='';
        $categoryId = $category->articleCount();
        if ($category->articleCount()>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory=Category::find(1);
            $message='Bu kategoriye ait '.$categoryId.' makale '.$defaultCategory->name.' katgorisine taşındı';
        }
        $category->delete();
        toastr()->success($message,'Kategori Başarıyla Silindi');
        return redirect()->back();

    }
}
