@include('home.header')
@include('home.bar')
@include('home.navbar')

<section class="user-dashboard page-wrapper" style="margin-top: -20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<ul class="list-inline dashboard-menu text-center">
					<li><a class="active" href="{{route('orders')}}">Orders</a></li>
					<li><a href="{{route('profile')}}">Profile Details</a></li>	
				</ul>

				<div class="dashboard-wrapper user-dashboard">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Date</th>
									<th>Total Price</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

                                @foreach ($orderspayed as $order) 
								<tr>
                                    <td>{{$order->id}}</td>
									<td>{{$order->created_at}}</td>
									<td>${{$order->total_price}}</td>
                                    @if ($order->payment_method == 'cashOnDelivery')
                                        
									<td><span style="color: blue" >cashOnDelivery</span></td>
                                    @else
                                    <td><span style="color: rgb(187, 2, 2)" >PayPal</span></td>
                                    @endif
									<td><a href="{{route('orders')}}" class="btn btn-default">View</a></td>
								</tr>
                                @endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('home.footer')
@include('home.script')
  