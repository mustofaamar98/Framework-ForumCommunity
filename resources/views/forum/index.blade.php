@extends('layouts.app') @section('title','Forum') @section('content')
<div class="container">
    <div class="jumbotron" id="tc_jumbotron">
        <div class="card-body" id="xx" style="color:#fff; border:1px solid #fff;">
            <div class="text-center">
                <h1 style="font-family: 'Lobster', cursive;, font-size:40px;">Forum Community</h1>
                <p>Forum tanya jawab, Membantu Solusi Pencarian Masalah Anda</p>
                
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12" id="tc_container_wrap">
            <div class="card" id="tc_paneldefault">
                <div class="card-body" id="tc_panelbody">
                    <div class="row">
                        <div class="col-md-8" style="padding-right:0;"><br>
                            
                            <div class="table100 ver2 m-b-110">
                                <div class="table100-head">
                                    <table>
                                        <thead>
                                            <tr class="row100 head">
                                                <th class="cell100 column1">Thread</th>
                                                <th class="cell100 column2">Comments</th>
                                                <th class="cell100 column3">View</th>
                                                <th class="cell100 column4">Info</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="table100-body js-pscroll">
                                    <table>
                                        <tbody>
                                            @foreach ($forums as $forum)
                                            <tr class="row100 body">
                                                <td class="cell100 column1">
                                                    <div class="forum_title">
                                                        <h4><a href="{{route('forumslug', $forum->id)}}">{{ str_limit ($forum->title, 35)}}</a></h4>
                                                        <p>{!! strip_tags(str_limit ($forum->description, 50)) !!}</p>
                                                        @foreach ($forum->tags as $tag)
                                                        <a href="#" class="badge badge-suc  cess tag_label">{{$tag->name}}</a> 
                                                        @endforeach 
                                                        @if(empty($forum->image)) 
                                                        @else
                                                        <div class="badge badge-success tag_label_image"><i class="fa fa-image"></i></div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="cell100 column2"><small>{{$forum->comments->count()}}</small></td>
                                                <td class="cell100 column3"><small>
                                                    @if ($forum->view != null)
                                                        {{$forum->view}}
                                                        @else
                                                        0
                                                    @endif
                                                </small></td>
                                                <td class="cell100 column4">
                                                    <div class="forum_by">
                                                        <small style="margin-bottom:0; color:#666;">{{$forum->created_at->diffForHumans()}}</small>
                                                        <small>by <a href="{{route('profile' , $forum->user->name)}}">{{$forum->user->name}}</a></small>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- pagination -->
                            <div class="row justify-content-center">
                                {!!$forums->links()!!}
                            </div>
                        </div>
                        <div class="col-md-4"><br>
                            <div class="card">
                                <div class="vard-header" style="color: #fff; padding: 8px 1.25rem;">Popular</div>
                                <?php $count = 0; ?>
                                @foreach ($forumview as $view)
                                <?php if($count == 6) break; ?>
                                <div class="list-group">
                                        <a href="#" class="list-group-item" id="index_hover">{{ str_limit ($view->title, 35)}}</a>
                                    </div>
                                    <?php $count++; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <hr style="margin-top:0;">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body" style="background: #505B60;"></div>
                        <div class="card-header"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br> @endsection