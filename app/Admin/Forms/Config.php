<?php

namespace App\Admin\Forms;

use App\Models\AdminConfig;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Config extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '配置项';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //echo $request->url();
        //dump($request->all());
       // dump($request->get('base'));
       // admin_success('数据处理成功');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('base.website_title','站点标题')->rules('required');
        $this->text('base.website_keyword','站点关键词');
        $this->image('base.website_icon','站点ICON');
        $this->text('base.website_desc','站点描述');
        $this->text('base.website_keep','备案信息');
        $this->text('base.home_title','HOME标题');
        $this->text('base.home_slogan','HOME标语');
        $this->text('user_info.user_qq','用户QQ');
        $this->text('user_info.user_wechat','用户微信号');
        $this->text('user_info.full_name','个人姓名');
        $this->image('user_info.portrait','个人头像');
        $this->image('user_info.background','个人背景');
        $this->text('user_info.occupation','一句话简介');
        $this->text('user_info.motto','个人座右铭');
        $this->text('base.motto','右下角座右铭');
        $this->image('base.website_background','博客背景');
        $this->radio('base.website_open_bg','启用博客背景')->options(['1' => '启用', '0'=> '不启用'])->default('1');;
        $this->text('base.website_seo_title','网站SEO');
        $this->image('base.home_background','HOME页背景');
        //$this->setAction('get');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $adminConfig = new AdminConfig();
        $config_data = $adminConfig->get();
        //dd($config_data);
        $config_index_data = [];
        foreach ($config_data as $data){
            if ($data->id !== 1){
                $config_index_data[$data->name] = $data->value;
            }
        }
        return $config_index_data;
    }
}
