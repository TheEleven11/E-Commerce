@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('save-product') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="product_image">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="product_image">
                            </div>
 
                            <div class="form-group">
                                <label for="">Thương hiệu sản phẩm </label>
                                <select name="brand_product" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $item)
                                        <option value="{{ $item->brand_id }}">{{ $item->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục sản phẩm</label>
                                <select name="category_product" class="form-control input-sm m-bot15">
                                    @foreach ($category_product as $item)
                                        <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Nhập giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="product_desc">Mô tả sản phẩm</label>
                                <textarea style="resize:none" rows="8" name="product_desc" class="form-control" id="ckeditor1" placeholder="Mô tả sản phẩm">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_content">Nội dung sản phẩm</label>
                                <textarea style="resize:none" rows="8" name="product_content" class="form-control" id="ckeditor2" placeholder="Nội dung sản phẩm">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<p style = "color: green" >'. $message . '</p>';
                                    Session::put('message',null);
                                }
                            ?>
                            <button type="submit" class="btn btn-info">Thêm danh mục</button>
                        </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
