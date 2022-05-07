@extends('layouts.header_footer')

@section('title','Home | E-Shopper')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="home">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div>

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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



        <h4 style="margin: 40px 0">Chọn hình thức thanh toán</h4>
        <form action="{{ URL::to('order-place') }}" method="POST">
            {{ csrf_field() }}
            <div class="payment-options">
                    <span>
                        <label><input name="payment_option" value="1" type="radio"> Trả bằng thẻ ATM</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="2" type="radio" checked> Thanh toán khi nhận hàng</label>
                    </span>
                    <span>
                        <label><input name="payment_option" value="3" type="radio"> Thanh toán thẻ ghi nợ</label>
                    </span>
                    <input type="submit" value="Đặt hàng" name="" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection