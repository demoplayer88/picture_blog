<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Config;
use App\Http\Controllers\Controller;
use App\Models\AdminConfig;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ConfigController extends Controller
{
    public function setting(Content $content){

        $content->description("网站基础配置包括备案号等");

        return $content
            ->title("网站配置")
            ->body(new Config());
    }
    // 这里 修改了 vender/laravel-admin 核心文件 home/wwwroot/youfun.work/vendor/encore/laravel-admin/src/Widgets/Form.php 477行
    public function configPost(Request $request,AdminConfig $adminConfig){
        $data = $request->all();

        $config = [];
        foreach ($data as $k=>$v){
            if ($k == 'base' || $k == 'user_info'){
                foreach ($v as $k1=>$v1){
                    if (strpos($v1,'tmp/')){
                        // 照片
                        $disk = Storage::disk('qiniu');
                        if (strpos($k1,'icon')){
                            $image_name = 'youfun-'.uniqid().'.png';
                        }else{
                            $image_name = 'youfun-'.uniqid().'.jpg';
                        }
                        $disk->put($image_name,file_get_contents($v1));
                        //$url = $disk->url('images/');
                        $config[$k.'.'.$k1] = $image_name;
                    }else{
                        $config[$k.'.'.$k1] = $v1;
                    }
                }
            }
        }
        //dd($config);
        foreach ($config as $k=>$v){
//            echo $k;
//            echo $v;
//            die;
            $adminConfig->where('name',$k)->update(['value'=>$v]);
        }
        admin_success('数据更新成功');
        return back();
    }
}
