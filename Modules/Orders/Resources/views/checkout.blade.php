@include('home.header')



	@include('home.bar')
	@include('home.navbar')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">checkout</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="block billing-details">
                  <h4 class="widget-title">Billing Details</h4>
                  @foreach ($orders as $order)
                  <input type="hidden" value="{{$total+=$order->price * $order->pivot->quantity}}" name="price">
                  @endforeach
                  <form method="POST">
                     @csrf
                  
                     <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name='fullname' placeholder="">
                        @if ($errors->has('fullname'))
                        <p style="color:rgb(211, 69, 69)">* {{ $errors->first('fullname') }}</p>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="user_address">Address</label>
                        <input type="text" class="form-control" id="user_address" name='address' placeholder="">
                        @if ($errors->has('fullname'))
                        <p style="color:rgb(211, 69, 69)">* {{ $errors->first('fullname') }}</p>
                        @endif
                     </div>
                     <div class="checkout-country-code clearfix">
                       
                        <div class="form-group" >
                           <label for="user_city">City</label>
                           <input type="text" class="form-control" id="user_city" name="city" value="">
                           @if ($errors->has('city'))
                           <p style="color:rgb(211, 69, 69)">* {{ $errors->first('city') }}</p>
                           @endif
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="user_country">Country</label>
                        <input type="text" class="form-control" id="user_country" name='country' placeholder="">
                        @if ($errors->has('country'))
                        <p style="color:rgb(211, 69, 69)">* {{ $errors->first('country') }}</p>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="phone_no">phone number</label>
                        <input type="number" class="form-control" id="phone_no" name='phone_no' placeholder="">
                        @if ($errors->has('phone_no'))
                        <p style="color:rgb(211, 69, 69)">* {{ $errors->first('phone_no') }}</p>
                        @endif
                     </div>

                 
               </div>
               <div class="block">

                  <input type="hidden" name="price" value="{{$total}}">

                  <h4 class="widget-title">Payment Method</h4>
                     <button type="submit" formaction="{{route('cashOnDelivery')}}" class="btn btn-main pull-left" style="margin-right: 10px"> Cash on delivery</button>
             
               
                  <button type="submit" formaction="{{route('payment')}}" class="btn btn-main pull-left">Paypal Payment</button>
                  </form>
              
               </div>
            </div>
            

          
            <div class="col-md-4">
               <div class="product-checkout-details">
                  <div class="block">
                     <h4 class="widget-title">Order Summary</h4>
                     <div class="media product-card">
                        <a class="pull-left" href="product-single.html">
                           <img class="media-object" src="images/shop/cart/cart-1.jpg" alt="Image" />
                        </a>
                        <div class="media-body">
                           <h4 class="media-heading"><a href="product-single.html">Ambassador Heritage 1921</a></h4>
                           <p class="price">1 x $249</p>
                           <span class="remove" >Remove</span>
                        </div>
                     </div>
                     <div class="discount-code">
                        <p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>
                     </div>
                     <ul class="summary-prices">
                        <li>
                           <span>Subtotal:</span>
                           <span class="price">${{$total}}</span>
                        </li>
                        <li>
                           <span>Shipping:</span>
                           <span>Free</span>
                        </li>
                     </ul>
                     <div class="summary-total">
                        <span>Total</span>
                       
                        <span>${{$total}}</span>
                
             
                      

                     </div>
                     <div class="verified-icon">
                        <img src="images/shop/verified.png">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   <!-- Modal -->
   {{-- <form action="{{route('AddCoupon')}}" method="POST">
      @csrf --}}
   <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <input class="form-control" type="text" name="coupon" placeholder="Enter Coupon Code">
                  </div>
                  <button type="submit" class="btn btn-main">Apply Coupon</button>
               </form>
            </div>
         </div>
      </div>
   </div>
{{-- </form> --}}
   

@include('home.footer')
@include('home.script')
  </html>