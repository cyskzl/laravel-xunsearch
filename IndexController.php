<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Search;
use  App\Http\Controllers\Api\Common;

/**
 * @author Linz <[gzphper@163.com]>
 * @domain www.3maio.com
 */
class IndexController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * [index description]
     * @param  string $keyword 用户在搜索框传递过来的搜索内容
     * @return view   显示搜索结果的页面
     */
    public function index($keyword)
    {
        if (!$keyword) {
          about(404);
        }

        $search = new Search('blog');
        $searchRes = $search->doSearch($keyword);

        //调用自定义分页，将搜索结果分页
        $pageRes = Common::CustomPagination($this->request, $searchRes, 1);

        return view('Home/search', ['list' => $pageRes]);
    }
}
