@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">Thêm mới</h4>
    		</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.suppliers.store', ['type'=>$type]) }}" class="form-validation" novalidate="">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Họ và tên</label>
                        <div class="col-lg-10 col-12">
                            <input type="text" name="name" class="form-control validate[required]" placeholder="Họ và tên" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Mã nhà cung cấp</label>
                        <div class="col-lg-10 col-12">
                            <input type="text" name="code" class="form-control validate[required]" placeholder="Mã nhà cung cấp" value="{{ old('code') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Email</label>
                        <div class="col-lg-10 col-12">
                            <input type="email" name="email" class="form-control validate[required,custom[email]]" placeholder="Email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Số điện thoại</label>
                        <div class="col-lg-10 col-12">
                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Địa chỉ</label>
                        <div class="col-lg-10 col-12">
                            <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Mô tả</label>
                        <div class="col-lg-10 col-12">
                            <textarea name="description" rows="5" class="form-control" placeholder="Mô tả">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-12">Thứ tự</label>
                        <div class="col-lg-auto col-12"><input type="number" name="priority" class="form-control" value="{{ $priority+1 }}" min="1" max="9999" placeholder="Thứ tự" disabled></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-auto">Tình trạng</label>
                        <div class="col-lg-10 col">
                        @forelse($config['status'] as $k => $v)
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input type="checkbox" name="status[]" value="{{ $k }}" {{ old('status') ? in_array($k,old('status')) ? 'checked' : '' : $k == 'publish' ? 'checked' : '' }} class="custom-control-input" id="customCheck{{ $k }}">
                                <label class="custom-control-label" for="customCheck{{ $k }}">{{ $v }}</label>
                            </div>
                        @empty
                        @endforelse
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="{{ route('admin.suppliers.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-login-variant"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection