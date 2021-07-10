<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyBlog | My Awesome Blog</title>

    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <link rel="stylesheet" href="{{asset('blog-frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('blog-frontend/css/custom.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">MyBlog</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="the-navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container -->
        </nav>
    </header>
    <div class="container">
        <div class="row">
       @yield('content')
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
                                @foreach($cat as $category)
                                
                                <li>
                                    <a href="{{route('category',$category->id)}}"><i  class="fa fa-angle-right"></i> {{ $category->name }}</a>
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
                            @foreach($postPopular as $popular)
                                <li>
                                    <div class="post-image">
                                        <a href="#">
                                        <img src=" {{ $popular->image }} " alt="">
                                       
                                        </a>
                                    </div>
                                    <div class="post-body">
                                        <h6><a href="{{ url('show-post/'.$popular->slug) }}">{{$popular->title}}</a></h6>
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
       

    </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="copyright">&copy; 2016 Edo Masaru</p>
                </div>
                <div class="col-md-4">
                    <nav>
                        <ul class="social-icons">
                            <li><a href="#" class="i fa fa-facebook"></a></li>
                            <li><a href="#" class="i fa fa-twitter"></a></li>
                            <li><a href="#" class="i fa fa-google-plus"></a></li>
                            <li><a href="#" class="i fa fa-github"></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
    @yield('js')
    <script src="{{asset('blog-frontend/js/bootstrap.min.js') }}"></script>
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
                window.location.href=getPost;
            //    return $.get(getPost);
            //    console.log(getPost);
                // console.log(data.post);
               
            
                },
        
        });
      
</script>
</body>
</html>