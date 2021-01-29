<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequset;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class ArticleController extends Controller
{
    //展示文章列表
    public function show()
    {
        $data=Article::get();
        return view("show",compact("data"));
    }

    public function create()
    {
        return view("form");
    }

    //文件上传
    public function uploader(Request $request)
    {
        if ($request->hasFile("pic")){
            $img=$request->file("pic")->store("","article");
//        dump($img);die();
            $path="uploads/article/".$img;
            $accessKey="oCVqO_L6pVZm0cb7dZK8f02CMbrAEvbf4kgra2UX";
            $secretKey="UYIsxzghR4QfcKeUPvXR45GvRnE1h7E1ZCiwUQi_";
            $uploadMgr = new UploadManager();
            $auth = new Auth($accessKey, $secretKey);
            $token = $auth->uploadToken("space222");
            list($ret, $error) = $uploadMgr->putFile($token, time(), $path);
        }

            return ['code'=>200,'msg'=>'success','path'=>$path];

    }

    //添加入库
    public function store(ArticleRequset $requset)
    {
        //过滤
        $param=$requset->except("_token");
        $data= Article::create($param);
        if ($data){
          return  redirect("show");
        }
    }

    //删除数据
    public function del($id)
    {
        Article::where("id",$id)->delete();
        return redirect("show")."<script>confirm('确定要删除吗?')</script>";
    }



    //采集数据
    public function spider()
    {
        require 'Querylist/QueryList.php';
        require 'Querylist/phpQuery.php';
        // 待采集的页面地址
        $url = 'https://www.cnbeta.com/category/soft.htm';

        // 采集规则
        $rules = [
            // 文章标题
            'title' => ['.items-area .item dl dt a','text'],
            'author' => ['.items-area .item .meta-data .soft','text'],
            'desn' => ['.items-area .item dl dd p','text'],
            'pic' => ['.items-area .item dl a img','src'],
        ];


        $data = @\QL\QueryList::Query($url,$rules)->data;

//        print_r($data);die();
        DB::table("articles")->insert($data);
        \Illuminate\Support\Facades\Cache::put('article', $data);
    }
    public function read()
    {
        require 'Querylist/QueryList.php';
        require 'Querylist/phpQuery.php';
        // 待采集的页面地址
        $url = 'https://www.cnbeta.com/articles/soft/1083831.htm';

        // 采集规则
        $rules = [
            // 文章标题
            'title' => ['.w1200 .cnbeta-article .title h1','text'],
            'desn' => ['.cnbeta-article-body .article-summary p','text'],
            'pic' => ['.cnbeta-article-body .article-content p a img','src'],
        ];
        $data = @\QL\QueryList::Query($url,$rules)->data;
        unset($data[1]);
        DB::table("articles")->insert($data);
        \Illuminate\Support\Facades\Cache::put('article', $data);
    }

}
