<h1> Sửa Sản Phẩm {{ $id}}</h1>

<form method="post" action="{{route('admin.updateproduct')}}">
    <input type="text" name='name_product' placeholder="tên sản phẩm" >
    @csrf
    <button type="submit" class="btn btn-">Sửa Sản Phẩm</button>
</form>