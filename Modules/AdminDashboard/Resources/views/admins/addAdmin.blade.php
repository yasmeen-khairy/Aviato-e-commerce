
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style=" margin: 90px auto; width:800px ; ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
       
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
<form action='{{route('addAdmin')}}' method="post">
  <h3 style="color:#0090e7;">Add Admin</h3>
  <hr>
    @csrf
    <div class="form-group">     
      <label for="exampleInputEmail1">Enter email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email' >  
      @if ($errors->has('admin'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('admin') }}</p>
      @endif  
    </div>  
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid page-body-wrapper">
@include('admindashboard::navbar')
      <div class="main-panel">
@include('admindashboard::footer')
      </div>
    </div>
  </div>
</body>
</html>
  