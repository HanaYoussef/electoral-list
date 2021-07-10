@extends('layouts.frontLayout')


@section('content')
            <div class="col-md-8">
    
              @forelse ($items as $item)
                <article class="post-item">
                    <div class="post-item-image">
                        <!-- <a href="post.html"> -->
                        <a href="#">
                            <img src="{{asset('storage/images/'.$item->image)}}" alt="">
                        </a>
                        <!-- </a> -->
                    </div>
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="">{{$item->title}}</a></h2>
                            <p>{{$item->details}}</p>
                            <p>{{$item->slug}}</p>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="#"> Admin</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{(new \DateTime($item->created_at))->format('Y.m.d')}}</time></li>
                                    <li><i class="fa fa-tags"></i><a href="#"> {{$item->category->name}}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                               <a href="{{route('show-post',$item->slug)}}">Continue Reading &raquo;</a>
                                <!-- <a href="{{route('show-post',[$item->slug,$item->id])}}">Continue Reading &raquo;</a> -->
                            </div>
                        </div>
                    </div>
                </article>
             

              {{$items->links('vendor.pagination.custom')}}
               @empty
                <div class='alert alert-info mt-4'>There is no items to show</div>
                @endforelse
             </div>
              <div class="col-md-4">
                <aside class="right-sidebar">
                    <div class="search-widget">
                        <div class="input-group">
                          <input type="text" class=" typeahead form-control input-lg" placeholder="Search for...">
                          <span class="input-group-btn">
                            <button class="btn btn-lg btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                          </span>
                        </div><!-- /input-group -->
                    </div>
        
                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Categories</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="categories">
                                @foreach($categories as $category)
                                <li>
                                    <a href="#"><i  class="fa fa-angle-right"></i> {{ $category->name }}</a>
                                    <span class="badge pull-right">{{ $category->publishedPost()->count()}}</span>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>
                    </div>

                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Popular Posts</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="popular-posts">
                            @foreach($posts as $popular)
                                <li>
                                    <div class="post-image">
                                        <a href="#">
                                        <img src="{{asset('storage/images/'.$popular->image)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-body">
                                        <h6><a href="#">{{$popular->title}}</a></h6>
                                        <div class="post-meta">
                                            <span>36 minutes ago</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="tags">
                                <li><a href="#">PHP</a></li>
                                <li><a href="#">Codeigniter</a></li>
                                <li><a href="#">Yii</a></li>
                                <li><a href="#">Laravel</a></li>
                                <li><a href="#">Ruby on Rails</a></li>
                                <li><a href="#">jQuery</a></li>
                                <li><a href="#">Vue Js</a></li>
                                <li><a href="#">React Js</a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
       

@endsection


@section('js')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
   
        $('input.typeahead').typeahead({
            source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    // console.log(data);
                    // var results = process(data.dataModified);
                   
                    return process(data.dataModified);
                    
          
                });
            },
            select: function () {
                // console.log(query);
                var val = this.$menu.find('.active').data('value');
                var getPost = "{{route('getPost',':val') }}";
                getPost = getPost.replace(':val',val);
<<<<<<< HEAD
                // console.log(getPost);
=======
>>>>>>> 3ab55fb7727243af140cfc589912e77ee5563fb5
                window.location.href=getPost;
            //    return $.get(getPost);
            //    console.log(getPost);
                // console.log(data.post);
               
            
                },
        
        });
      
</script>
@endsection