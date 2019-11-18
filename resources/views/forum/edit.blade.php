@extends('layouts.app') @section('title','Edit Pertanyaan') @section('content')
<div class="container">
    <div class="jumbotron" id="tc_jumbotron">
        <div class="col-md-8 offset-md-2">
            <div class="text-center">
                <h3 style="color: #fff;">Edit Pertanyaan</h3>
            </div>
            <hr style="background: #fff">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('forum.update', $forum->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}} {{method_field('PUT')}}
                            <div class="form-group">
                                <input type="text" id="tc_input" class="form-control" name="title" value="{{$forum->title}}">
                            </div>

                            <div class="des">
                                <a class="btn btn_tc btn-block" data-toggle="collapse" data-target="#description-textarea" style="color: #777">Description</a>
                                <div id="description-textarea" class="collapse">
                                    <div class="bg">
                                        <div class="form-group">
                                            <textarea type="text" class="form-control" id="tc_input" name="description" placeholder="description">
                            {{$forum->description}}
                        </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="tags[]" multiple="multiple" id="tc_input" class="form-control tags" id="">
                        @foreach($tags as $tag)
                         <option value="{{$tag->id}}">{{$tag->name}}</option>
                         @endforeach
                       </select>
                            </div>

                            <a data-toggle="collapse" data-target="#screenshot-open"><i class="fa fa-image" id="upload_image"></i></a>
                            <div id="screenshot-open" class="collapse">
                                <div class="bg">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image" placeholder="image" style="background-color: #f5f8fa;">
                                    </div>
                                </div>
                            </div>
                            @if (empty($forum->image))
                            <small><i class="fa fa-info-circle"></i>Tidak terdapat gambar/screenshot pada postingan ini</small> @else
                            <div class="form-group">
                                <div class="col-md-4">
                                    <img src="{{asset('images/' .$forum->image)}}" alt="" width="100%">
                                </div>
                            </div>
                            @endif
                            <br>

                            <button type="submit" class="btn btn-success btn-block">Edit</button>
                        </form>
                    </div>
                </div>
                <br>

                <div class="create_info" style="color: #fff;">
                    <h5><i class="fa fa-info-circle"></i> Info</h5>
                    <span>- Klik icon <strong>Gambar</strong> untuk mengupload gambar atau screenshot.</span>
                </div><br>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    @forelse($forums as $forum)
                    <b>Pertanyaan Terakhir Anda:</b><br>

                    <a href="#" style="color: #444">
                        <h5 style="margin-top: 4px;"><i class="fa fa-newspaper-o"></i> {{$forum->title}}</h5>
                    </a>
                    @empty
                    <strong> Pertanyaan baru akan muncul disini.</strong><br> @endforelse
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('js')
<script>
    $(document).ready(function() {
        $('.tags').select2().val({!!json_encode($forum - > tags() - > allRelatedIds()) !!
        }).trigger('change');
    });

    CKEDITOR.replace('description', {
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'dark'
    });
</script>
@endsection