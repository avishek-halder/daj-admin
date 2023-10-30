@extends('layouts.static')
@section('title', $page_title)
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)
@section('author', '')

@section('content')

<section class="breadcrumbcontainer">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadlt">
            <ol class="breadcrumb">
              <li><a href="{{url('/')}}">Home</a></li>
              <li class="active">{{$page_dtls->page_title}}</li>
            </ol>
          </div>
          
        </div>
      </div>
    </div>
  </section>


  <section class="abut-sec">
    <div class="container">
      <div class="row">
        <!-- <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="abutpic">
            <img src="images/aboutpic.jpg">
          </div>
        </div> -->
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="abutxt">
            <img src="{{asset($page_dtls->featured_image)}}">
            <h3>{{$page_dtls->page_title}}</h3>
          {!! $page_dtls->page_content !!}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
