
@include('home.header')
@include('home.bar')
@include('home.navbar')

	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Cart</h1>
					<ol class="breadcrumb">
						<li><a href={{asset("index.html")}}>Home</a></li>
						<li class="active">cart</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post">
                <table class="table">
                  <thead>
                   
                    <tr>
                      <th class="">Item Name</th>
                      <th class="">Item Price</th>
                      <th style="text-align: center">Quantity</th>
                      <th class="">total price</th>
                      <th class="">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                
					@foreach($products as $product)
          
                    <tr id="sid{{$product->id}}" class="cartpage">

                      <input type="hidden" id="id">
                      <td class="">
                        <div class="product-info">
                          <img width="80" src="{{asset('storage/products/'.$product->image)}}" alt="" />
                          {{$product->name}}
                        </div>
                      </td>

                      <input type="hidden" value="{{$product->price}}" class='price{{$product->id}}'>
                      <td >${{$product->price}}</td>

                 
                      <td class="itemsQuty">  
                           <div class="d-flex justify-content-between">
                              <div class="input-group w-auto justify-content-end align-items-center">
                                 <input type="button" value="-" class="button-minus border rounded-circle  icon-shape icon-sm mx-1 " data-field="quantity">
                                 <input class="quantitytxt" type="text" value="{{$product->pivot->quantity}}"  name="quantity" min="1" max="10" style="font-weight: 600;width: 38px;outline: none; border: hidden;text-align: center;" >
                                 <input type="button" value="+" class="button-plus border rounded-circle icon-shape icon-sm " data-field="quantity">
                                 <button type="button" value="{{$product->id}}" class='updateQuant btn btn-success' style="margin-left: 10px;">update</button>
                              </div>
                           </div>
                       </td>

                      <td class='total_price'>${{$product->pivot->quantity * $product->price}}</td>
                      <input  type="hidden" value="{{$total += $product->pivot->quantity * $product->price}}">
                      <td> 
                        <a href="javascript:void(0)" onclick="deleteFromCart({{$product->id}})" class='btn btn-danger'>delete</a>
                      </td>   
                    </tr>
               
					@endforeach
                  </tbody>
                </table>
      
                <div id="orderPriceId" class="orderPrice">
                <a class="pull-left" style="color: red;font-style: italic;font-size: large;font-weight: 600;">
                 Total Price =<span style="color: black"> ${{$total}} </span>
                </a>
                </div>
                <a href="{{'/checkout'}}" class="btn btn-main pull-right">Checkout</a>
                
                <a style="margin-right: 10px;" href="{{'/shop'}}" class="btn btn-main pull-right">Back To Shop</a>
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('home.footer')

 <!-- Main Js File -->
 <script src="js/script.js"></script>  
 <script src='{{asset("admin/assets/js/q.js")}}'></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src='{{asset("admin/assets/js/ajax.js")}}'></script>

