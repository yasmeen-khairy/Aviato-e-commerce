
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style="margin-top: 90px; width:900px">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">{{$users->username}} Orders</h4>

           
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif


            <div class="table-responsive">

              <table class="table">
                <thead >
                  <tr>
      
                    <th> fullname </th>
                    <th> address </th>
                    <th> city </th>
                    <th> country </th>
                    <th> total_price </th>
                    <th> payment_method </th>
                    <th> created_at </th>
    
                  </tr>
                </thead>
                <tbody >
                
                  @foreach ($orders as $order)     
                  <tr>
                    <td class="">{{$order->fullname}}</td>
                    <td class="">{{$order->address}}</td>
                    <td class="">{{$order->city}}</td>
                    <td class="">{{$order->country}}</td>
                    <td class="">${{$order->total_price}}</td>
                    @if ($order->payment_method == 'cashOnDelivery')                      
                    <td><span style="color: blue" >cashOnDelivery</span></td>
                    @else
                    <td><span style="color: rgb(187, 2, 2)" >PayPal</span></td>
                    @endif
                    <td class="">{{$order->created_at}}</td>
                 
                  </tr>
          
                  @endforeach

                </tbody>
              </table>
              <form method="GET">
                @csrf
             <button type="submit" class="btn btn-success" formaction="{{route('ordersDetails' , ['id'=>$users->id])}}" >Orders details</button>
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
  