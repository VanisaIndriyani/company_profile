@extends('layouts.user')

@section('header')
  <style>
      #hero{
        background: url('{{asset('user/images/coffevape.jpeg')}}') top center;
        background-repeat: no-repeat;
        width:100%;
        background-size:cover;
      }
  </style>
@endsection

@section('hero')
    <h1>Kategori</h1>
    <h2>Semua kategori tersedia</h2>
@endsection

@section('content')
  <!--========================== Category Section ============================-->
  <section id="category">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h3 class="section-title">Kategori</h3>
        <p class="section-description">Daftar kategori yang tersedia</p>
      </div>
      <div class="row" id="category-wrapper">
        @foreach ($categories as $category)
            <div class="col-md-4 col-sm-12 category-item filter-app" >
                  <a href="#">
                    <img src="{{asset('category_image/'.$category->image)}}" class="image-center">
                    <div class="details">
                      <h4>{{$category->name}}</h4>
                      <span>{{$category->description}}</span>
                    </div>
                  </a>
            </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection 