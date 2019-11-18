@extends('layouts.app') @section('title','Home') @section('content')
<div class="container ">
    <div class="jumbotron home">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <h1>Welcome To Forum Community</h1>
                    <p>Temukan kemudahan solusi permasalahanmu di Forum Community melalui berbagai tanggapan pengguna.</p>
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-popular" role="tab" aria-controls="pills-home" aria-selected="true">Popular Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Forum Category</a>
                        </li>
                    </ul>
                </div>
                <div class="image-home" style="border: none;">
                    <img src="{{asset('/images/vektorkecil.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container home-card">
    <div class="card-konten">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-home-tab">
                <h3 style="margin-bottom:30px;">Popular Forums</h3>
                <div class="row card-row">

                    <?php $count = 0; ?> @foreach ($forumview as $view)
                    <?php if($count == 6) break; ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{url('/images/'.$view->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$view->title}}</h5>
                                @foreach ($view->tags as $tag)
                                <a href="#" class="badge badge-success tag_label">{{$tag->name}}</a> @endforeach @if(empty($view->image)) @else
                                <div class="badge badge-success tag_label_image"><i class="fa fa-image"></i></div>
                                @endif
                                <p class="card-text">{{Illuminate\Support\Str::limit($view->description, $limit = 120, $end = '...')}}</p>
                                <a href="{{route('forumslug', $view->id)}}" class="btn btn-gradient">View Forum</a>
                            </div>
                        </div>
                    </div>
                    <?php $count++; ?> @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @foreach ($forums as $forum)
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    @foreach ($forum->tags as $tag)
                    <li class="nav-item">
                    <a class="nav-link active btn-gradient" id="pills-home-tab" data-toggle="pill" href="#pills-{{$tag->name}}" role="tab" aria-controls="pills-home" aria-selected="true">{{$tag->name}}</a>
                        </li>
                    @endforeach
                    </ul>
                    <br><br>
                @endforeach

                <div class="tab-pane fade show active" id="pills-{{$tag->name}}" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row card-row">
                            
                            @foreach ($forumview as $view)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{url('/images/'.$view->image)}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ str_limit ($view->title,10)}}</h5>
                                        @foreach ($view->tags as $tag)
                                        <a href="#" class="badge badge-success tag_label">{{$tag->name}}</a> @endforeach @if(empty($view->image)) @else
                                        <div class="badge badge-success tag_label_image"><i class="fa fa-image"></i></div>
                                        @endif
                                        <p class="card-text">{!! strip_tags(str_limit ($view->description, 50)) !!}</p>
                                        <a href="{{route('forumslug', $view->id)}}" class="btn btn-gradient">View Forum</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12" id="tc_container_wrap">
        </div>
    </div>
</div>
@endsection