<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','ASC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->get('content');
        $article->slug=str_slug($request->title);
        if ($request->hasFile('images')){
            $imageName=str_slug($request->title).'.'.$request->images->getClientOriginalExtension();
            $request->images->move(public_path('uploads'),$imageName);
            $article->images='uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Başarılı', 'Makale Başarıyla Oluşturuldu');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories=Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'images'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article=Article::findOrFail($id);
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->get('content');;
        $article->slug=str_slug($request->title);

        if ($request->hasFile('images')){
            $imageName=str_slug($request->title).'.'.$request->images->getClientOriginalExtension();
            $request->images->move(public_path('uploads'),$imageName);
            $article->images='uploads/'.$imageName;
        }

        $article->save();
        toastr()->success('Başarılı', 'Makale Başarıyla Güncellendi');
        return redirect()->route('admin.makaleler.index');
    }

    public function switch(Request $request){
      $article = Article::findOrFail($request->id);
      $article->status = $request->statu ? 1 : 0;
      $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       Article::find($id)->delete();
       toastr()->success('Makale Silinen Makaleler Bölümüne Alındı');
       return redirect()->route('admin.makaleler.index');
    }

    public function recover($id){
       Article::onlyTrashed()->find($id)->restore();
       toastr()->success('Başarılı', 'Makale Başarıyla Geri Alındı');
       return redirect()->route('admin.makaleler.index');
    }

    public function trashed(){
        $articles = Article::onlyTrashed()->orderBy('deleted_at','ASC')->get();
        return view('back.articles.trashed',compact('articles'));
    }

    public function harddelete($id)
    {
        $article = Article::onlyTrashed()->find($id);
        if(File::exists($article->images)){
            File::delete(public_path($article->images));
        }
        $article->forceDelete();
        toastr()->success('Makale Başarıyla Silindi');
        return redirect()->route('admin.makaleler.index');
    }

    public function destroy($id)
    {

    }
}
