<div class="form-group">
                    <label for="name">name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="{{$data->name}}">
                </div>
              
                <div class="mb-3 form-check">
   
                <input type="checkbox" class="form-check-input"  value="'.$data->active.'" name="active" id="editActive">
    <label class="form-check-label" for="active">Active</label>
  </div>