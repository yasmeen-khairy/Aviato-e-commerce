@extends('home.header')

<body id="body">
@extends('home.bar')
@extends('home.navbar')




<div class="hero-slider">
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-1.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-center">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-3.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-left">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-2.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-right">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="product-category section">
	<div class="container">
		<div class="row">
	@foreach ($categories as $category)
		
	
			<div class="col-md-6">
				<div class="category-box">
					<a href="#!">
						<img src="{{'storage/categories/'.$category->image}}" alt="" />
						<div class="content">
							<h3>{{$category->name}}</h3>
							<p>{{$category->description}}</p>
						</div>
					</a>	
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<section class="products section bg-gray" >
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Trendy Products</h2>
			</div>
		</div>
		<div class="row">
			
				
			
			@foreach ($products as $product)
			@if ($product->category->name == 'trendy products')
			<form action="{{route('addToCart' , ['id' => $product->id])}}" method="POST">
				@csrf
			<div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive"  src="{{asset('storage/products/'.$product->image)}}" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal{{$product->id}}">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
			                        <a href="#!" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<input type="number" style="width: 60px;" name="quantity" required>
								</li>
								<li>
										<button type="submit">go</button><i class="tf-ion-android-cart"></i>
									
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">{{$product->name}}</a></h4>
						<p class="price">${{$product->price}}</p>
					</div>
				</div>
			</div>
		
		</form>
		<!-- Modal -->
		<div class="modal product-modal fade" id="product-modal{{$product->id}}">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i class="tf-ion-close"></i>
			</button>
		  	<div class="modal-dialog " role="document">
		    	<div class="modal-content">
			      	<div class="modal-body">
			        	<div class="row">
			        		<div class="col-md-8 col-sm-6 col-xs-12">
			        			<div class="modal-image">
				        			<img class="img-responsive" style="width: 400px;" src="{{asset('storage/products/'.$product->image)}}" alt="product-img" />
			        			</div>
			        		</div>
			        		<div class="col-md-4 col-sm-6 col-xs-12">
			        			<div class="product-short-details">
			        				<h2 class="product-title">{{$product->name}}</h2>
			        				<p class="product-price">${{$product->price}}</p>
			        				<p class="product-short-description">
			        					{{$product->description}}
			        				</p>
			        				<a href="cart.html" class="btn btn-main">Add To Cart</a>
			        				<a href="product-single.html" class="btn btn-transparent">View Product Details</a>
			        			</div>
			        		</div>
			        	</div>
			        </div>
		    	</div>
		  	</div>
		</div><!-- /.modal -->
		@endif
		@endforeach
		</div>
	</div>
</section>


<!--
Start Call To Action
==================================== -->
<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO NEWSLETTER</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, <br> facilis numquam impedit ut sequi. Minus facilis vitae excepturi sit laboriosam.</p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
				    <div class="input-group subscription-form">
				      <input type="text" class="form-control" placeholder="Enter Your Email Address">
				      <span class="input-group-btn">
				        <button class="btn btn-main" type="button">Subscribe Now!</button>
				      </span>
				    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->

			</div>
		</div> 		<!-- End row -->
	</div>   	<!-- End container -->
</section>   <!-- End section -->

<section class="section instagram-feed">
	<div class="container">
		<div class="row">
			<div class="title">
				<h2>View us on instagram</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="instagram-slider" id="instafeed" data-accessToken="IGQVJYeUk4YWNIY1h4OWZANeS1wRHZARdjJ5QmdueXN2RFR6NF9iYUtfcGp1NmpxZA3RTbnU1MXpDNVBHTzZAMOFlxcGlkVHBKdjhqSnUybERhNWdQSE5hVmtXT013MEhOQVJJRGJBRURn"></div>
			</div>
		</div>
	</div>
</section>


@extends('home.footer')

   @extends('home.script')
    


  </body>
  </html>