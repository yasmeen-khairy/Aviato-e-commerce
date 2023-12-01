
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style="margin: 90px auto;">
      <div class="col-12 grid-margin" >
        <div class="card" >
          <div class="card-body">

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
            {{-- if category table is empty --}}

            @if(count($categories) == 0)

            <div style=" display:flex; flex-direction:column; align-items:center; margin:100px 300px ; width:400px">
              <p style="color: #6c7293;font-size: 1rem">No Categories For Now</p>
              <form>
                @csrf
             <button style="margin-top: 10px" formaction="{{route('createCategory')}}" class="btn btn-success">Add New Category</button></td>
              </form>

              @else

            {{-- if category table have data --}}

            <h4 class="card-title">All Categories</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> CategoryName </th>
                    <th> Description </th>
                    <th> Delete </th>
                    <th> Update </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($categories as $category)
                  <input type="hidden" value="{{$category->id}}" name="id">
                  <tr id="sid{{$category->id}}">
                  
                    <td> {{$category->name}}</td>
                    <td style="max-width: 400px; overflow: hidden;"> {{$category->description}}</td>
                      <td> 
                        <a href="javascript:void(0)" onclick="deleteFromCart({{$category->id}})" class='btn btn-danger'>delete</a>
                      </td>
                      <td>
                          <button data-toggle="modal" data-target="#exampleModalLong{{$category->id}}" type="button" class="btn btn-success" >Update</button>
                      </td>
                    
                  </tr>

  {{-- start Modal --}}             
 <div class="modal fade" id="exampleModalLong{{$category->id}}" >
  <div id="message"></div>
  <div class="modal-dialog" role="modal">
    <div class="modal-content">
      <h3 style="margin-top: 10px;">update category data</h3>
      <form id="productForm" action='{{route('updateCategory' , ['id'=>$category->id])}}' method='post' enctype="multipart/form-data" >
        @csrf
  
        <input type="hidden" class="form-control" name="id" id="id" >

        <div class="form-group">
          <input type="file" class="form-control"  name="image" id="image" value="{{$category->image}}">
       
        </div>
        <div class="form-group">
          <input type="text" class="form-control"  name="name" id="name" value="{{$category->name}}">
       
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="description" id="description" value="{{$category->description}}">
   
        </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="nav-link btn btn-success " >Update</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End Modal --}}
               

                   @endforeach
                   @endif
                </tbody>
              </table>
              {{$categories->links()}}
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


<script>

  //delete from cart
  function deleteFromCart(id)
  {
    

    $.ajax({
        url: "/deleteCategory/"+id,
        type: 'DELETE',
      
        data:{
          _token: $('input[name=_token]').val()
        },

        success:function(response)
        {
          $("#sid"+id).remove();
        }
      });
   
  }
</script>



{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
  