@include('home.header')



	@include('home.bar')
	@include('home.navbar')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Success</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li class="active">Success</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<h1 style="color: rgb(0, 0, 0) ;text-align: center;">Thank you {{$users->username}}</h1>
<h2 style="color: green ;text-align: center;">Your order is confirmed successfully</h2>
<form action="{{'orders'}}" method="GET">
<button style="display: flex; margin:20px auto" class="btn btn-primary" type="submit">Show Your Orders</button>
</form>   


