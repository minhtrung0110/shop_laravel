<h1> Thêm Sản Phẩm</h1>

<form method="post" action="{{ route('admin.addproduct')}}">
    <input type="text" name='name_product' placeholder="tên sản phẩm" >
    @csrf
    <button type="submit" class="btn btn-">Thêm Sản Phẩm</button>
</form>