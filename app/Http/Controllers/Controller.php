<?php

namespace App\Http\Controllers;
// コントローラが入っているフォルダまでのパス

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// この後の行でパスを省略するため

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

/*コントローラーとは
データベースから必要な情報を引き出したり、
逆にデータベースに投稿を保存したりするPHPファイル*/
