@extends('layouts.app')
@section('title',"user: $user->name")
@section('content')
<div class="container">
    <div class="jumbotron" id="tc_jumbotron_profile">
      <div class="card-body">
        <div class="text-center">
         <div class="profile_img"> 
           <img src="{{asset('images/user.jpg')}}" style="background: #fff;">
         </div>
          <div id="user_name">
            <h3>{{$user->name}}</h3> 
            <br>
          </div>
        </div>
        
{{-- 
        @foreach ($user as $users) --}}
        <div class="row text-center admin">
          <div class="col-lg-12">
            <button type="button" class="btn btn-update button-showdataprofil"
            data-toggle="modal" data-target="#modalupdateprofil" data-id=''>Edit Profil</button>
          </div>
        </div>
        <!-- Modal UPDATE -->
    <div class="modal fade" id="modalupdateprofil" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle" style="color: black;">Edit Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" class="form-updatedataprofil">
          <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
              <label for="" style="color: black;">Nama</label>
              <input type="text" class="form-control data-name" id="name" aria-describedby=""
                placeholder="{{$user->name}}" name="name" required>
            </div>
            <div class="form-group">
              <label for="" style="color: black;">Email</label>
              <input type="email" class="form-control data-email" id="email" aria-describedby=""
                placeholder="{{$user->email}}" name="email" required>
            </div>
            <div class="form-group">
              <label for="" style="color: black;">Password</label>
              <input type="password" class="form-control data-email" id="email" aria-describedby=""
                placeholder="{{$user->password}}" name="email" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1" style="color: black;">File Foto</label>
              <input type="file" class="form-control-file data-filefoto" id="exampleFormControlFile1" name="fotoprofil">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="sumbit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    </div>
    
           {{-- end modal --}}
        {{-- @endforeach --}}

    </div>
  </div>
</div>  
<div class="container">
    <div class="row">
        <div class="col-md-12" id="tc_container_wrap">
           <div class="card" id="tc_paneldefault">
              <div class="card-body" id="tc_panelbody"  style="background: #f9f9f9;"> 
                 <div class="card">
                    <div class="card-header" style="background-color: #A29AF7;">
                      <div class="menu_a" style="float: left;">
                      <a href="#">{{$user->name}} Threads</a> 
                      </div> 
                 </div> 
              </div> 
          <div class="row">
           <div class="col-md-12">
            <table class="table table-bordered"> 
            <tbody>
                @forelse($forums as $forum)   
               <tr> 
               <td>{{$forum->title}}<i style="font-size: 10px; color: #999;"> {{$forum->created_at->diffForHumans()}}, {{$forum->comments->count()}} Comments, 2 Views</i>
                 </td>

                 @if(auth()->user()->id == $forum->user_id)
                <td width="10"><a href="{{route('forum.edit', $forum->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a></td>
                <td width="10"> 
                <form action="{{route('forum.destroy', $forum->id)}}" method="post" style="margin: 0;">
                 {{csrf_field()}}
                  {{method_field('DELETE')}}
                  <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                 </form> 
                </td>
                @endif  
                <td width="10"><a href="{{route('forumslug', $forum->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a></td>
              </tr>
              @empty
              <div class="text-center">
                  <br>
                    Belum Ada Forum yg dibuat
              </div>

              @endforelse
              </tbody>
                  </table>
                   </div> 
                   </div> 
                    <div class="card" style="border: none;">
                    <div class="card-header"></div> 
                    <div class="card-body" style="background: rgb(90, 90, 90)"></div>
                     <div class="card-header"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection