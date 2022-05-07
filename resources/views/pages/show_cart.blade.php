@extends('layouts.header_footer')

@section('title','Home | E-Shopper')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="home">Trang chủ</a></li>
              <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content=Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Tên</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng cộng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $item)
                    
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ URL::to('public/uploads/product/'.$item->options->image) }}" alt="" width="80px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $item->name }}</a></h4>
                            <p>ID: {{ $item->id }}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{ number_format($item->price) }}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ URL::to('update-quantity') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="number" name="quantity" value="{{ $item->qty }}" size="4" min="1">
                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                    <input type="submit" value="Cập nhật" name="update-qty" class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$
                                <?php
                                $subtotal = $item->price * $item->qty;
                                echo number_format($subtotal);
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ URL::to('delete-to-cart/'.$item->rowId) }}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
		
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Tổng <span>${{ Cart::priceTotal(0) }}</span></li>
						<li>Thuế <span>${{ Cart::tax(0) }}</span></li>
						<li>Phí vận chuyển <span>Free</span></li>
						<li>Thành tiền <span>${{ Cart::total(0) }}</span></li>
					</ul>
					<?php
						$customer_id = Session::get('customer_id');
						if($customer_id==NULL){
					?>
						<a class="btn btn-default check_out" href="{{ URL::to('login-checkout') }}">Thanh toán</a>
						
					<?php
						}else{
					?>
						<a class="btn btn-default check_out" href="{{ URL::to('checkout') }}">Thanh toán</a>

					<?php
						}
					?>
				</div>
			</div>
		</div> 
	</section><!--/#do_action-->

@endsection