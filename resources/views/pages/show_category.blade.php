@extends('layouts.master')

@section('title','Home | E-Shopper')

@section('content')
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">{{ $this_category_product[0]->category->category_name }}</h2>
		@foreach ($this_category_product as $item)
		<a href="{{ URL::to('/product-details/'.$item->product_id) }}">
			<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{ URL::to('public/uploads/product/'.$item->product_image) }}" alt="" />
								<h2>${{ number_format($item->product_price) }}</h2>
								<p>{{ $item->product_name }}</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
							</div>
					</div>
					<div class="choose">
						<ul class="nav nav-pills nav-justified">
							<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
							<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
						</ul>
					</div>
				</div>
			</div>
		</a>
		@endforeach
	</div><!--features_items-->
@endsection 