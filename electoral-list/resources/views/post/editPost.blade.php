{{-- <form  method="POST" enctype="multipart/form-data" >
    @csrf 
    @method("put")  --}}
    {{-- <input type="hidden" name="_method" value="PUT"> --}}
<div class="form-group">
    <label for="name">title:</label>
    <input type="text" class="form-control" name="title" id="editTitle" value="{{$title}}">
</div>


<div class="form-group">
<label for="name">details:</label>
<input type="text" class="form-control" name="details" id="editDetails" value="{{$details}}">
</div>

<div class="form-group">
<label for="name">summary:</label>
<input type="text" class="form-control" name="summary" id="editSummary" value="{{$summary}}">
</div>

<div class="form-group">
        <label for="category">Category</label>
         
        @if(isset($categories))
            <select  class="ddlStatus  form-control" name="category_id" id="editCategoryId">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option {{old('category_id',$category_id)== $category->id ?'selected':''}} value="{{ $category->id }}">{{$category->name}}</option>
                @endforeach
                
            </select>    
        @endif
    
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <p id="disp_tmp_path"></p>
        <img src="{{asset("storage/images/$image")}}" width="300px" height="300px" >
        <input type="file" class="form-control" name="image" id="editImage">
    </div>
    <div class="form-check">
        <input type="hidden" name="published" value="0"/>
        <input type="checkbox" class="form-check-input" name="published" id="editPublished"
        value="{{$published}}" {{old('published',$published) == 1 ? 'checked':''}} />
        <label class="form-check-label" for="published">Published</label>
    </div> 
    
{{-- </form> --}}