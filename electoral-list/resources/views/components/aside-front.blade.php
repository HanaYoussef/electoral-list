
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
                                    <span class="badge pull-right">10</span>
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
        </div>
 </div>
 
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