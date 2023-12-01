
@include('admindashboard::header')
<body>
  <div class="container-scroller">
    @include('admindashboard::sidebar')

    <div class="row " style="margin-top: 90px">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">All Users</h4>

           
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
      
                    <th> UserName </th>
                    <th> Email </th>
                    <th> UserOrders </th>
    
                  </tr>
                </thead>
                <tbody style="text-align:center">
                  @foreach ($users as $user2)
          
                  <tr>
                    <td>
                      <img src="{{asset('storage/profileImage')}}/{{$user2->image}}"  alt="image" />
                      <span class="ps-2">{{$user2->username}}</span>
                    </td>
                    <td> {{$user2->email}} </td>
 
                  <td> 
                    <form class="text-left clearfix" action="{{'userOrders/'.$user2->id}}" method="get" >
                      @csrf
                    <div class="text-center">
                    <button type="submit" class="btn btn-success" >UserOrders</button>
                    </div>
                    </form>
                  </td>
                  </tr>
                              
                  @endforeach
                </tbody>
              </table>
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
  