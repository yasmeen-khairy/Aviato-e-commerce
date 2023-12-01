
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style="margin-top: 90px; width:800px">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{$users->username}} Orders details</h4>

           
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif


            <div class="table-responsive">
              @if (count($orders) > 0)
              <table class="table">
                <thead >
                  <tr>
      
                    <th> ProductName </th>
                    <th> ProductQuantity </th>
                    <th> ProductPrice </th>
                    <th> Created_at </th>
    
                  </tr>
                </thead>
                <tbody >
                
                  @foreach ($orders as $order)     
                  <tr>
                    <td class="">
                      <div class="product-info">
                        <img  style="border-radius: 0%" src="{{asset('storage/products/'.$order->image)}}" alt="" />
                        {{$order->name}}
                      </div>
                    </td>
                    <td class="">{{$order->pivot->quantity}}</td>
                    <td class="">${{$order->pivot->quantity * $order->price }}</td>
                    <td class="">{{$order->created_at}}</td>
                 
                  </tr>
                  
                  @endforeach
                 
                </tbody>
              </table>
              @else
              <h4 style="text-align: end ; color:rgb(90, 89, 88); margin:50px auto">No Orders For Now</h4>
              @endif
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
  