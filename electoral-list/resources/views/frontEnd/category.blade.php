@extends('layouts.frontLayout')


@section('content')

<div class="col-md-8">
<h1> <span>{{ $category->name }}</span></h1>
    @forelse ($posts as $post)
      <article class="post-item">
          <div class="post-item-image">
              <!-- <a href="post.html"> -->
              <a href="#">
                  <img src="{{$post->image}}" alt="">
              </a>
              <!-- </a> -->
          </div>
          <div class="post-item-body">
              <div class="padding-10">
                  <h2><a href="">{{$post->title}}</a></h2>
                  <p>{{$post->details}}</p>
              </div>

              <div class="post-meta padding-10 clearfix">
                  <div class="pull-left">
                      <ul class="post-meta-group">
                          <li><i class="fa fa-user"></i><a href="#"> Admin</a></li>
                          <li><i class="fa fa-clock-o"></i><time> {{(new \DateTime($post->created_at))->format('Y.m.d')}}</time></li>
                          <li><i class="fa fa-tags"></i><a href="#"> {{$post->category->name}}</a></li>
                          <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                      </ul>
                  </div>
                  <div class="pull-right">
                     <a href="{{route('show-post',$post->slug)}}">Continue Reading &raquo;</a>
                  </div>
              </div>
          </div>
      </article>
   

   
     @empty
      <div class='alert alert-info mt-4'>There is no items to show</div>
      @endforelse
      {{$posts->links('vendor.pagination.custom')}}
   </div>
@endsection