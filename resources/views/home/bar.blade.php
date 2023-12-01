<!-- Start Top Header Bar -->
<style>
	.badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
	margin-top: 13px;
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    vertical-align: top;
    margin-left: -10px; 
}
</style>
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>0129- 12323-123123</span>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="{{route('index')}}">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
								font-family="AustinBold, Austin" font-weight="bold">
								<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
									<text id="AVIATO">
										<tspan x="108.94" y="325">AVIATO</tspan>
									</text>
								</g>
							</g>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4 count">

				<!-- Cart -->
				<ul class="top-menu text-right list-inline">
					@if(!isset($_SESSION['cart']) && isset($_SESSION['id']))
					<li>
						<div id="cartCounterId" class="cartCounter"> 
						<a href="{{route('cart' , ['id' => $users->id])}}" >
							    <i class="tf-ion-android-cart"></i>Cart
								<span class='countOrders badge badge-warning' id='lblCartCount'> {{count($orders)}} </span>
						</a>
						</div>

			    	@endif


					<!-- Search -->
					<li class="dropdown search dropdown-slide">
						<a href="#!" class="dropdown-toggle" ><i
								class="tf-ion-ios-search-strong"></i> Search</a>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<form method= 'get' >
									<div style="display: flex">
									<input type="search" class="form-control" placeholder="Search..." name="search">
									<button formaction="{{route('search')}}" style="margin-left: 10px" class="btn btn-primary" type="submit">search</button>
									</div>
								</form>
							</li>
						</ul>
					</li>
					<!-- / Search -->

					

					{{-- profile --}}
					@if(!isset($_SESSION['id']))
					<li class="dropdown cart-nav dropdown-slide">
						<a href="#!" class="dropdown-toggle" >
							<i class="fa fa-smile-o" style="margin-right: 4px"></i>Join us</a>
							
						<div class="dropdown-menu cart-dropdown">

							<ul class="text-center cart-buttons">
							<form style="margin-bottom: 10px" class="text-left clearfix" action="{{route('login')}}" method="get" >
								@csrf
								<div class="text-center">
								  <button type="submit" class="btn btn-main text-center" >Login</button>
								</div>
							  </form>

							  <form class="text-left clearfix" action="{{route('signup')}}" method="get" >
								@csrf
								<div class="text-center">
								  <button type="submit" class="btn btn-main text-center" >Signup</button>
								</div>
							  </form>
						
							</ul>
							  
						</div>

					</li>
					
					@else

					<li class="dropdown cart-nav dropdown-slide">
						<a style="color:rgb(6, 184, 50); text-transform: capitalize;" href="{{route('profile')}}" class="dropdown-toggle" >
					     {{$users->username}}</a>
						<div class="dropdown-menu cart-dropdown">
							<form class="text-left clearfix" action="{{route('logout')}}" method="POST" >
								@csrf
								<div class="text-center">
								  <button type="submit" class="btn btn-main text-center" >Logout</button>
								</div>
							  </form>  
						</div>

					</li>
					@endif
			

				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->
