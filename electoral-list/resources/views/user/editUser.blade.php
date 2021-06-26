
<div class="form-group">
    <label for="Name">Name:</label>
    <input type="text" class="form-control" name="name" id="editName" value="{{$name}}">
</div>
<div class="form-group">
    <label for="Email">Email:</label>
    <input type="text" class="form-control" name="email" id="editEmail" value="{{$email}}">
</div>
<div class="form-group">
<label for="Password">Password:</label>
<input type="password" class="form-control" name="password" id="editPassword" value="{{$password}}">
</div>
<div class="form-check">
    <input type="hidden"  name="active" value="0">
    <input type="checkbox" class="form-check-input" name="active"  id="editActive" value="{{$active}}">
    <label class="form-check-label" for="active">Active</label>
</div>
