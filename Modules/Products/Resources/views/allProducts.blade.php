
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style="margin-top: 90px">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All products</h4>

           
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif


            <div class="table-responsive" style="width:900px">
              <table class="table">
                <thead style="text-align:center" >
                  <tr>
      
                    <th> ProductName </th>
                    <th> Category </th>
                    <th> Price </th>
                    <th> Available Quantity </th>
                    <th> Description </th>
                    <th> Delete </th>
                    <th> Update</th>
                  </tr>
                </thead>
                <tbody style="text-align:center">
                  @foreach ($products as $product)
          
                  <tr>
                    <td>
                      <img src="{{asset('storage/products')}}/{{$product->image}}" style="border-radius: 0%; width:50px;height:50px" alt="image" />
                      <span class="ps-2">{{$product->name}}</span>
                    </td>
                    <td> {{$product->category->name}} </td>
                    <td> {{$product->price}} </td>
                    <td> {{$product->available}} </td>
                    <td style="max-width: 100px; overflow: hidden;"> {{$product->description}} </td>
                    <td> 
                      <form class="text-left clearfix" action="{{'deleteProduct/'.$product->id}}" method="POST" >
                        @csrf
                        @method('Delete')
                      <div class="text-center">
                      <button type="submit" class="btn btn-danger" >Delete</button>
                      </div>
                      </form>
                    </td>
 
                  <td> 
                    <form class="text-left clearfix" action="{{'editProduct/'.$product->id}}" method="get" >
                      @csrf
                    <div class="text-center">
                    <button type="submit" class="btn btn-success" >Update</button>
                    </div>
                    </form>
                  </td>
                  </tr>
                              
                  @endforeach
                </tbody>
              </table>
            </div>
            {{$products->links()}}
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
  