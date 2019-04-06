<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only(['store', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get articles
        $articles = Article::latest()->with('user')->paginate(5);  

        return $articles;

        // Return collection of articles as a resource
        // return ArticleResource::collection($articles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formatted_data = $this->bulkFormatter($request);

        if(! empty($formatted_data)){

            foreach ($formatted_data as $key => $value) {

                $article = new Article();

                $value['user_id'] = auth()->id();

                $article->create($value);

            }

        }else{
            

            $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

            $article->id = $request->input('article_id');
            $article->title = $request->input('title');
            $article->body = $request->input('body');
            $article->slug = $request->title;
            $article->user_id = auth()->id();           

            if($article->save()) {
                return redirect('/');              
            }

        }       
        
    }

    private function bulkFormatter(Request $request){

        $temp = [];

        foreach($request->all() as $key => $value){

            if( is_array($value) ){
                for($i = 0; $i < sizeof( $value ); $i++){

                    $temp[$i][$key] = $value[$i];

                }
            }

        } 

        return $temp;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show',[
            'article' => $article,
            'comments' => $article->comments
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        $this->authorize('update', $article);

        $article->delete();
        return redirect('/');  
        // if($article->user_id == auth()->id()):
        // else:
        //     abort("permission denied");
        // endif; 

    }
}
