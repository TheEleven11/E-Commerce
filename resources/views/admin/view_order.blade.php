@extends('layouts.admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin khách hàng
      </div>

      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>
            </tr>
          </thead>
          <tbody>
                    
            <tr>
              <td>{{ $order_by_id->customer->customer_name }}</td>
              <td>{{ $order_by_id->customer->customer_phone }}</td>
            </tr>

          </tbody>
        </table>
      </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
                  
          <tr>
            <td>{{ $order_by_id->shipping->shipping_name }}</td>
            <td>{{ $order_by_id->shipping->shipping_address }}</td>
            <td>{{ $order_by_id->shipping->shipping_phone }}</td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê chi tiết đơn hàng
      </div>

      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá</th>
              <th>Thành tiền</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order_details as $item)
     
            <tr>
              <td>{{ $item->product_name }}</td>
              <td>{{ $item->product_sales_quantity }}</td>
              <td>{{ $item->product_price }}</td>
              <td>{{ $item->product_price * $item->product_sales_quantity }}</td>
            </tr>
                            
            @endforeach   

          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
</div>
@endsection

