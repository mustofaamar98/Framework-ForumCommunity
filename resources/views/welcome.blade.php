@extends('layouts.app')
@section('title','Homepage')
@section('content')
<div class="container">
  <div class="row welcome">
    <div class="col-lg-5 judulforum">
        <h1>Forum Community</h1>
        <p>Temukan kemudahan solusi permasalahanmu di Forum Community melalui berbagai tanggapan pengguna.</p>
        <br>
        <a class="forum" href="{{ route('forum.index') }}" style="color:white;">View Forums</a>
    </div>
    <div class="col-lg-7">
        <div class="image">
          <img src="{{asset('/images/vektor.png')}}" alt="">
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
 