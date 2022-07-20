<div class="content-sendmail">
    <div class="text say-hi">
        <h4> Xin Chào {{$customer['name']}}. Bạn có đặt 1 đơn hàng với thông tin cá nhân sau:</h4>
    </div>
    <div>
        Số Điện Thoại: {{$customer['phone']}} -  Email: {{$customer['email']}} .
    </div>
    <div>
        Địa chỉ: {{$customer['address']}} .
    </div>
    <div>
        Ghi chú: {{$customer['content']}}.
    </div>
    @component('mail::table')
| Mã Sản Phẩm    |Tên Sản Phẩm        | Giá Tiền  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent
    <table>
      
        @foreach($order as $item)
        @php
            $price = $item['price_sale'] != 0 ? $item['price_sale'] : $item['price'];
        @endphp
       <tr>
           <td>{{ $item['id']}}</td>
           <td>{{ $item['name']}}</td>
          <td>{{$price}} VNĐ</td> 
       </tr>
       @endforeach
      </table>
</div>