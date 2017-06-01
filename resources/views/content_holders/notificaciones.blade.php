@if (session('status'))
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('status') }}
    </div>
  @endif
@if (count($errors)>0)
  <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (Session::get('mensaje'))
  <div class="alert alert-{{ Session::get('class') }} alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <ul>
        <li>{{ Session::get('mensaje') }}</li>
    </ul>
  </div>
@endif
