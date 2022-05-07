@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('save-brand-product') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="brand_product_name">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control" id="brand_product_name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="brand_product_desc">Mô tả thương hiệu</label>
                                <textarea style="resize:none" rows="8" name="brand_product_desc" class="form-control" id="brand_product_desc" placeholder="Mô tả danh mục">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
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
