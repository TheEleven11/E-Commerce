@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($product as $product)
                        <form role="form" action="{{ URL::to('update-product/'.$product->product_id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $product->product_name }}">
                            </div>
                            <div class="form-group">
                                <label for="product_image">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="product_image">
                                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" style = "width:100px">
                            </div>
 
                            <div class="form-group">
                                <label for="">Thương hiệu sản phẩm </label>
                                <select name="brand_product" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $item)
                                        <option value="{{ $item->brand_id }}" 
                                            @if ($item->brand_id == $product->brand_id )
                                                selected
                                            @endif
                                            >{{ $item->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục sản phẩm</label>
                                <select name="category_product" class="form-control input-sm m-bot15">
                                    @foreach ($category_product as $item)
                                        <option value="{{ $item->category_id }}" 
                                            @if ($item->category_id == $product->category_id )
                                                selected
                                            @endif
                                            >{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="product_price" value="{{ $product->product_price }}">
                            </div>
                            <div class="form-group">
                                <label for="product_desc">Mô tả sản phẩm</label>
                                <textarea style="resize:none" rows="8" name="product_desc" class="form-control" id="product_desc">{{ $product->product_desc }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_content">Nội dung sản phẩm</label>
                                <textarea style="resize:none" rows="8" name="product_content" class="form-control" id="product_content">{{ $product->product_content }}
                                </textarea>
                            </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<p style = "color: green" >'. $message . '</p>';
                                    Session::put('message',null);
                                }
                            ?>
                            <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
