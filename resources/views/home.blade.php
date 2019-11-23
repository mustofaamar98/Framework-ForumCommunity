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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            
                        @php
                            $num = 1;
                            $type;
                        @endphp
                            @foreach ($forums as $forum)
                            <li class="nav-item">
                                    
                                        @foreach ($forum->tags as $tag)
                                        @if ($num==1)
                                        @php
                                            $type = $tag->name;
                                        @endphp
                                        <a class="nav-link active" id="" data-toggle="pill" href="#pills{{$tag->name}}" role="tab" aria-controls="pills-home" aria-selected="true">{{$tag->name}}</a>
                                        @php
                                            $num++;
                                        @endphp
                                        
                                        @else
                                        <a class="nav-link" id="" data-toggle="pill" href="#pills{{$tag->name}}" role="tab" aria-controls="pills-home" aria-selected="true">{{$tag->name}}</a>
                                        @php
                                            $num++;
                                        @endphp
                                        @endif
                                        @endforeach
                                    
                                </li>
                            @endforeach
                          </ul>

                          
                          <div class="tab-content" id="pills-tabContent">
                              @php
                                  $number = 1;
                              @endphp
                              @foreach ($forums as $forum)
                            <div class="tab-pane fade show @if ($type == $forum->tags->first()->name) active @endif" id="pills{{$forum->tags->first()->name}}" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="col-md-4">
                                            <div class="card">
                                                <img src="{{url('/images/'.$forum->image)}}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$forum->title}}</h5>
                                                    @foreach ($forum->tags as $tag)
                                                    <a href="#" class="badge badge-success tag_label">{{$tag->name}}</a> @endforeach @if(empty($forum->image)) @else
                                                    <div class="badge badge-success tag_label_image"><i class="fa fa-image"></i></div>
                                                    @endif
                                                    <p class="card-text">{{Illuminate\Support\Str::limit($forum->description, $limit = 120, $end = '...')}}</p>
                                                    <a href="{{route('forumslug', $forum->id)}}" class="btn btn-gradient">View Forum</a>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            @php
                                $number++;
                            @endphp
                            @endforeach
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