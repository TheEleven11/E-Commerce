@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($brand_product as $item)
                        <form role="form" action="{{ URL::to('update-brand-product/'.$item->brand_id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="brand_product_name">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control" id="brand_product_name" value="{{ $item->brand_name }}">
                            </div>
                            <div class="form-group">
                                <label for="brand_product_desc">Mô tả thương hiệu</label>
                                <textarea style="resize:none" rows="8" name="brand_product_desc" class="form-control" id="brand_product_desc">{{ $item->brand_desc }}</textarea>
                            </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<p style = "color: green" >'. $message . '</p>';
                                    Session::put('message',null);
                                }
                            ?>
                            <button type="submit" class="btn btn-info">Cập nhập thương hiệu</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
