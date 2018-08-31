@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">Thêm mới</h4>
    		</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.categories.store', ['type'=>$type]) }}" novalidate="">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Chọn danh mục</label>
                        <select name="parent_id" class="form-control">
                            <option value=''> Danh mục cha </option>
                            @php
                            $traverse = function ($categories, $prefix = '') use (&$traverse, $config, $type) {
                                foreach ($categories as $category) {
                                    echo '<option value="'.$category->id.'">'.$prefix.' '.$category->name.'</option>';
                                    $traverse($category->children, $prefix.'|--');
                                }
                            };
                            $traverse($categories);
                            @endphp
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Tiêu đề</label>
                        <input type="text" name="name" class="form-control link-to-slug" placeholder="Tiêu đề" value="{{ old('name') }}" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ old('slug') }}" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Meta title</label>
                        <input type="text" name="meta[title]" class="form-control" placeholder="Title" value="{{ old('meta.title') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Meta keywords</label>
                        <input type="text" name="meta[keywords]" class="form-control" placeholder="Keywords" value="{{ old('meta.keywords') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Meta description</label>
                        <textarea type="text" name="meta[description]" class="form-control" placeholder="Description" rows="5">{{ old('meta.description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Thứ tự</label>
                        <input type="number" name="priority" class="form-control" value="{{ $priority+1 }}" min="1" max="9999" placeholder="Thứ tự" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Tình trạng</label>
                        @forelse($config['status'] as $k => $v)
                        <div class="custom-control custom-control-inline custom-checkbox ml-2">
                            <input type="checkbox" name="status[]" value="{{ $k }}" {{ old('status') ? in_array($k,old('status')) ? 'checked' : '' : $k == 'publish' ? 'checked' : '' }} class="custom-control-input" id="customCheck{{ $k }}">
                            <label class="custom-control-label" for="customCheck{{ $k }}">{{ $v }}</label>
                        </div>
                        @empty
                        @endforelse
                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="{{ route('admin.categories.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-close"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection