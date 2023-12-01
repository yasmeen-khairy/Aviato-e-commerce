
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style=" margin: 90px auto; width:800px ; ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
        <h5>Add New Category</h5>
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
        <form class="text-left clearfix" action="{{route('storeCategory')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="file" class="form-control"  name="image">
            @if ($errors->has('image'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('image') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="text" class="form-control"  placeholder="Category Name" name="name">
            @if ($errors->has('name'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('name') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="text" class="form-control"  placeholder="Description" name="description">
            @if ($errors->has('description'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('description') }}</p>
            @endif
          </div>

          <div class="text-center">
            <button type="submit" class="nav-link btn btn-success create-new-button" >Confirm</button>
          </div>
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
  