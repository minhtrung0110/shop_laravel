@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
<form method="post" action="">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Danh Mục</label>
        <input type="text" class="form-control" value="{{ $menu->name }}" name='name' id="menu" placeholder="Tên Danh Mục">
      </div>
      <div class="form-group">
        <label for="parent_id">Danh Mục Cha </label>
        <select class="form-control" name="parent_id">
            <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}> Danh Mục Cha </option>
            @foreach($menu_parent as $menuParent)
                <option value="{{ $menuParent->id }}"
                    {{ $menu->parent_id == $menuParent->id ? 'selected' : '' }}>
                    {{ $menuParent->name }}
                </option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="description">Mô Tả</label>
        <textarea class="form-control"  class="form-control" value="{{ $menu->description}}" name='description' placeholder="Mô Tả"></textarea>
      </div>
      <div class="form-group">
        <label for="content">Mô Tả Chi Tiết </label>
        <textarea class="form-control"  class="form-control" value="{{ $menu->content}}" id='content' name='content' placeholder="Mô Tả Chi Tiết"></textarea>
      </div>
     
      <div class="form-group">
      
        <label for="active">Trạng Thái </label>
        <div class="custom-control custom-radio">
          <input class="custom-control-input custom-control-input-danger"  value="1" type="radio" id="active" name="active" {{ $menu->active == 1 ? 'checked=""' : '' }} >
          <label for="active" class="custom-control-label">Kích Hoạt</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="custom-control-input custom-control-input-danger custom-control-input-outline" value="0" type="radio" id="no_active" name="active" {{ $menu->active == 0 ? 'checked=""' : '' }}>
          <label for="no_active" class="custom-control-label">Vô Hiệu</label>
        </div>
      </div>
      @csrf
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Sửa Danh Mục</button>
    </div>
  </form>
@endsection

@section('footer')
<script >
    CKEDITOR.replace('content')
</script>
@endsection