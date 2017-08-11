@if($errors->any())
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="alert alert-danger" role="alert">
          @foreach($errors->all() as $error)
          <p>{{$error}}</p>
          @endforeach
        </div>
    </div>
</div>
@endif