@if (count($errors) > 0)
<div class="alert alert-danger mt-3">
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div><br />
@endif  

@if (session('success'))
    <div id="msg" class="alert alert-success mt-3" role="alert">
        <strong>{{session('success')}}</strong>
    </div>
@endif

@if (session('error'))
    <div id="msg" class="alert alert-danger mt-3" role="alert">
        <strong>{{session('error')}}</strong>
    </div>
@endif
