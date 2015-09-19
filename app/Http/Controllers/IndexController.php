<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Bulletin;
use App\Models\Advertisement;
use App\Models\Header;
use App\Models\Entrance;
use App\Models\Article;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share("headers", Header::orderBy("display_order")->get());
        view()->share("bulletin", Bulletin::first());
        view()->share("banners", Advertisement::where("ad_place_id", 0)->get());
        view()->share("entrances", Entrance::get());

        parent::__construct();
    }
    public function getIndex()
    {

        return view()->make('index',
            [
                'articles'=>Article::orderBy('priority')->orderBy('created_at', 'desc')->paginate(10),
                    ]
        
        );
    }

    public function getArticle()
    {
        $article = Article::find(intval(Input::get("id")));
        if($article)
        {
            $article->increment('read');
            return view()->make('show_article', ['article'=>$article]);
        }
        else
        {
            return view()->make('no_article');
        }
    }
}
