
@include('home.header')
@include('home.bar')
@include('home.navbar')

	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>



<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						@if(isset($category))
						<li class="active">{{$category->name}}</li>
						@else
						<li class="active">All category</li>
						@endif
						<li>
							<form method= 'get' >
								<div style="display: flex">
								<input type="search" class="form-control" placeholder="Search..." name="searchCategory">
								<button formaction="{{route('searchCategory')}}" style="margin-left: 10px" class="btn btn-primary" type="submit">search</button>
								</div>
							</form>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container">
		<div class="row" style="display: grid; grid-template-columns: repeat(6,1fr);">
			@if(count($products)>0)
            @foreach($products as $product)
			<form id="my_form{{$product->id}}" method="post" action="{{route('addToCart' , ['id' => $product->id])}}">
				@csrf	
			<div class="col-md-4" style="width: 200px">
				
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="{{asset('storage/products/'.$product->image)}}" alt="product-img" />
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
									<a href="javascript:void(0)" onclick="btnAddCart({{$product->id}})" ><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
                      	</div>
					</div>
					<div class="product-content">
					<input type="hidden" id="name{{$product->id}}" value="{{$product->name}}">
						<h4 ><a href="#">{{$product->name}}</a></h4>
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
								<select style="additive-symbols: inherit" name="quantity" style="width: 48px;height: 39px;">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
								<a href="javascript:void(0)" onclick="btnAddCart({{$product->id}})" ><i class="tf-ion-android-cart"></i></a>
							{{-- </form> --}}
							<a href="product-single.html" class="btn btn-transparent">View Product Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
</div><!-- /.modal -->
@endforeach
@else
<h2>No results</h2>
@endif
		</div>
	</div>
	<div id="MyPopup" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;</button>
					<h4 class="modal-title">
						Greetings
					</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<input type="button" id="btnClosePopup" value="Close" class="btn btn-danger" />
				</div>
			</div>
		</div>
	</div>
</section>

@include('home.footer')
@include('home.script')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
{{-- add to cart js code --}}
<script src='{{asset("admin/assets/js/ajax.js")}}'></script>


