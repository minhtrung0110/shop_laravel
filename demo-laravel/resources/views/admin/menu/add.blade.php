@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection;
@section('content')
<form>
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Danh Mục</label>
        <input type="text" class="form-control"  name='menu' id="menu" placeholder="Tên Danh Mục">
      </div>
      <div class="form-group">
        <label for="parent_id">Danh Mục Cha </label>
        <select  class="form-control"  name='parent_id'  >
            <option value="0">Danh Mục Cha</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Mô Tả</label>
        <textarea class="form-control"  class="form-control"  name='description' placeholder="Mô Tả"></textarea>
      </div>
      <div class="form-group">
        <label for="content">Mô Tả Chi Tiết </label>
        <textarea class="form-control"  class="form-control" id='content' name='content' placeholder="Mô Tả Chi Tiết"></textarea>
      </div>
     
      <div class="form-group">
      
        <label for="active">Trạng Thái </label>
        <div class="custom-control custom-radio">
          <input class="custom-control-input custom-control-input-danger"  value="1" type="radio" id="active" name="active" checked >
          <label for="active" class="custom-control-label">Kích Hoạt</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="custom-control-input custom-control-input-danger custom-control-input-outline" value="0" type="radio" id="no_active" name="active">
          <label for="no_active" class="custom-control-label">Vô Hiệu</label>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
    </div>
  </form>
@endsection;

@section('footer')
<script >
    CKEDITOR.replace('content');
</script>
@endsection;