@extends('header')

 {{-- VIEW MODAL COMFIRM ORDER --}}
 <div style="margin-top: 200px;" class="Modal-confirm">
    <div class="modal-confirm-order">
      @foreach ($getBuyers as $getBuyer)
      <form class="confirmSell" action="{{route('confirm-order', ['id' => $getBuyer['idOrder']])}}" method="post">
        @csrf
        <h1>Xác nhân đơn hàng</h1>
        <table class="infoOrder">
          <tr>
            <th>Tên</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
          </tr>
          <tr>
            <td>{{$getBuyer['username']}}</td>
            <td>{{$getBuyer['address']}}</td>
            <td>{{$getBuyer['phonenumber']}}</td>
            <td>{{$getBuyer['product_name']}}</td>
            <td>{{$getBuyer['order_quantity']}}</td>
            <td>{{$getBuyer['order_price']}}</td>
            <td>{{$getBuyer['order_price']* $getBuyer['order_quantity']}} VNĐ</td>
          </tr>
        </table>
        <button class="btn-sell-submit" type="submit">Xác nhận</button>
        @endforeach
      </form>

      
    </div>
</div>