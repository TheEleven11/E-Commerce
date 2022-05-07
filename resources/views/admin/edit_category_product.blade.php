@extends('layouts.admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($category_product as $item)
                        <form role="form" action="{{ URL::to('update-category-product/'.$item->category_id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="category_product_name">Tên danh mục</label>
                                <input type="text" name="category_product_name" class="form-control" id="category_product_name" value="{{ $item->category_name }}">
                            </div>
                            <div class="form-group">
                                <label for="category_product_desc">Mô tả danh mục</label>
                                <textarea style="resize:none" rows="8" name="category_product_desc" class="form-control" id="category_product_desc">{{ $item->category_desc }}</textarea>
                            </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<p style = "color: green" >'. $message . '</p>';
                                    Session::put('message',null);
                                }
                            ?>
                            <button type="submit" class="btn btn-info">Cập nhập danh mục</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
