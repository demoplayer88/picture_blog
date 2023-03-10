@extends('home.main')
@section('title','相册详情')
@section('content')
    <!--引入图片放大的CSS-->
    <link href="{{asset(__STATIC_HOME__)}}/assets/fancybox/jquery.fancybox.min.css" rel="stylesheet" />
    <div class="container pt-5">
        <div class="title">
{{--            <blockquote class="blockquote text-right">--}}
{{--                <p class="mb-0">独在异乡为异客，每逢佳节倍思亲。遥知兄弟登高处，遍插茱萸少一人</p>--}}
{{--                <footer class="blockquote-footer">《九月九日忆山东兄弟》--}}
{{--                    <cite title="Source Title">王维</cite>--}}
{{--                </footer>--}}
{{--            </blockquote>--}}
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>{{$details_result->photo_title}}
                        <br>
                        <small>{{$details_result->description}}</small>
                    </h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($details_result->photo as $v)
                <div class="col-sm-2">
                    <div class="card mb-3" id="photo_group">
                        <a no-pjax href="{{processing_files($v->img_url)}}" data-fancybox="gallery" data-caption="{{$v->img_url}}" data-type="image">
                            <div class="photo-img" data-background="image" style="background-image: url('{{processing_files($v->img_url)}}');"></div>
                        </a>
                        <div class="card-body p-0 text-center">
                            <h5 class="mt-2">{{$v->img_name}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
