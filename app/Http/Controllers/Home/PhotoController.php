<?php

namespace App\Http\Controllers\home;

use App\Models\BlogNavPhoto;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PhotoController
 * @package App\Http\Controllers\home
 */
class PhotoController extends Controller
{
    /**
     * 相册列表
     */
    public function index(Request $request)
    {
        $nav_id      = $request->route('nav_id');
        $photo_model = new BlogNavPhoto();
        if ($nav_id) {
            $photo_result = $photo_model::where('nav_id', $nav_id)->where('photo_show', 1)->orderBy('photo_sort', 'desc')->orderBy('id', 'desc')->paginate(8);
        } else {
            $photo_result = $photo_model::where('photo_show', 1)->orderBy('photo_sort', 'desc')->orderBy('id', 'desc')->paginate(8);
        }

        return view('home.photo.index', compact('photo_result'));
    }

    /**
     * 相册详情
     */
    public function photo_details(Request $request, BlogNavPhoto $photoModel)
    {
        $pid            = $request->route('pid');
        $details_result = $photoModel::with('photo')->find($pid);
        
        //$photo_result   = empty($details_result->photo_json) ? [] : $details_result->photo_json;
        //点击量自增
        $photoModel::where('id', $pid)->increment('photo_click');
        return view('home.photo.photo_details', compact('details_result'));
    }


    /**
     * 保留接口
     */
    public function quick_post_photo(Photo $photo)
    {
       $arr = [
           'DSC_0748_2.jpg',
           'DSC_0744_2.jpg',
           'DSC_0753_2.jpg',
           'DSC_0761.jpg',
           'DSC_0760.jpg',
           'DSC_0765_2.jpg',
           'DSC_0783_2.jpg',
           'DSC_0783.jpg',
           'DSC_0796_2.jpg',
           'DSC_1025.jpg',
           'DSC_0954.jpg',
           'DSC_0964.jpg',
           'DSC_1002.jpg',
           'DSC_1022.jpg',
           'DSC_1023.jpg',
           'DSC_0911.jpg',
           'DSC_0915.jpg',
       ];
       $pid = 2;
       $adds = [];
       if(!empty($arr)){
        foreach($arr as $v){
            $tmp = [
                'album_id'=>$pid,
                'img_url'=>$v,
                'img_name'=>'请修改',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            $adds[] = $tmp;
        }
        $photo->insert($adds);
       }
       
    }
}
