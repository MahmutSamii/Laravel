<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\config;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class Homepage extends Controller
{
    public function __construct(){
        if (config::find(1)->active==0){
          return redirect()->to('aktif-degil')->send();
        }
        view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
    }

    public function index(){
        $data['articles'] = Article::with(['getCategory'])->where('status',1)->whereHas('getcategory',function($query){
            $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category = Category::where('slug',$category)->first()  ?? abort(403,'Böyle Bir Kategori Bulunamadı.');
        $article = Article::where('slug',$slug)->whereCategoryId($category->id)->first()  ?? abort(403,'Böyle Bir Yazı Bulunamadı.');
        $article->increment('hit');
        $data['article'] = $article;
        return view('front.single',$data);
    }

    public function category($slug){
        $category = Category::where('slug',$slug)->first()  ?? abort(403,'Böyle Bir Kategori Bulunamadı.');
        $data['category'] = $category;
        $data['articles']=Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(2);
        return view('front.category',$data);
    }

    public function page($slug){
       $page = Page::whereSlug($slug)->first() ?? abort(403,'Böyle Bir Sayfa Bulunamadı.');
       $data['page']=$page;
       return view('front.page',$data);
    }

    public function contact(){
      return view('front.contact');
    }

    public function contactpost(Request $request){
        $rules =[
            'name' =>'required|min:5',
            'email' =>'required|email',
            'topic' =>'required',
            'message' =>'required|min:10'
        ];
      $validate = Validator::make($request->all(),$rules);

      if ($validate->fails()){
          return redirect()->route('contact')->withErrors($validate)->withInput();
      }

      Mail::send([],[],function($message) use ($request){
          $message->from('ileitism@blogsitesi.com','Blog Sitesi');
          $message->to('samimahmut34@gmail.com','Mahmut Sami');
          $message->setBody('Mesajı Gönderen :'.$request->name.'<br>
                      Gönderen Mail :'.$request->email.'<br>
                      Mesaj Konusu :'.$request->topic.'<br>
                      Mesaj :'.$request->message.'<br><br>
                      Gelen Tarih : '.$request->now().'','text/html');
          $message->subject($request->name.' iletişimden mesaj gönderdi');
      });
      /*$contact = new Contact;
      $contact->name=$request->name;
      $contact->email=$request->email;
      $contact->topic=$request->topic;
      $contact->message=$request->message;
      $contact->save();*/
      return redirect()->route('contact')->with('success', 'İletişim Mesajınız Bize İletildi.');
    }
}
