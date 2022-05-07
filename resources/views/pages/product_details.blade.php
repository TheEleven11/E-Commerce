@extends('layouts.master')

@section('title','Home | E-Shopper')

@section('content')
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" />
            <h3>ZOOM</h3>
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                      <a href=""><img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="" width="84px"></a>
                    </div>
                    
                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information" ><!--/product-information-->
            <h1>{{ $product->product_name }}</h1>
            <p>ID: {{ $product->product_id }}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{ URL::to('add-to-cart') }}" method="POST">
                {{ csrf_field() }}
                <span style="margin-top:0px">
                    <span>US ${{ number_format($product->product_price) }}</span>
                    <div style="display: block">
                        <label>Số lượng:</label>
                        <input type="number" name="quantity" value="1" min="1" />
                        <input type="hidden" name="id_hidden" value="{{ $product->product_id }}"  />
                    </div>
                    <button type="submit" class="btn btn-fefault cart d-block" style="margin-left:0px; margin-top:10px">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> Mới 100%</p>
            <p><b>Danh mục:</b> {{ $product->category->category_name }}</p>
            <p><b>Thương hiệu:</b> {{ $product->brand->brand_name }}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!! $product->product_desc !!}</p>          
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p>{!! $product->product_content !!}</p>
        </div>
        
        
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                     Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>
                
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        @php
            $count = 0;
            $num_items = count($related_product);
        @endphp
        
        <div class="carousel-inner">
            @foreach ($related_product as $related)
                @if ($count == 0)
                    <div class="item active">	         
                @else
                    @if ($count % 3 == 0)
                        <div class="item">
                    @endif
                @endif
                <a href="{{ URL::to('/product-details/'.$related->product_id) }}">            
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ URL::to('public/uploads/product/'.$related->product_image) }}" alt="" />
                                    <h2>${{ number_format($related->product_price) }}</h2>
                                    <p>{{ $related->product_name }}</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                @if ($count % 3 == 2 || $count == $num_items-1)
                    </div>         
                @endif

                @php
                    $count ++;
                @endphp

            @endforeach
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->

@endsection 