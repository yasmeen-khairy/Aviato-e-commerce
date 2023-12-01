
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')
<div class="container" style="margin: 100px auto">
    <div class="row " >
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
        <h5>Add New Product</h5>
        <hr>

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
        <form class="text-left clearfix" action="{{route('storeProduct')}}" method="POST" enctype="multipart/form-data" >
          @csrf

          <div class="form-group">
            <input type="file" class="form-control"  name="image">
            @if ($errors->has('name'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('name') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="text" class="form-control"  placeholder="Product Name" name="name" value= {{old('name') }}>
            @if ($errors->has('name'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('name') }}</p>
            @endif
          </div>

          <div class="form-group">
            <select class="form-select"  style="background-color: #2a3038;color: #656b8d;"  aria-label="Default select example" name='category'>
              <option selected>Product Category ?</option>
              @foreach ($categories as $category)
              <option>{{$category->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('category'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('category') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="number" class="form-control"  placeholder="Product Price" name="price" value= {{old('price') }}>
            @if ($errors->has('price'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('price') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="text" class="form-control"  placeholder="Product Description" name="description" value= {{old('description') }}>
            @if ($errors->has('description'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('description') }}</p>
            @endif
          </div>

          <div class="form-group">
            <input type="number" class="form-control"  placeholder="Available Quantity" name="available" value= {{old('available') }}>
            @if ($errors->has('available'))
            <p style="color:rgb(211, 69, 69)">* {{ $errors->first('available') }}</p>
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
  