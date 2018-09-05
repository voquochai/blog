@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">Chỉnh sửa</h4>
    		</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.users.update', ['id'=>$item->id, 'type'=>$type]) }}" class="form-validation" novalidate="">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label>Họ và tên</label>
                        <input type="text" name="name" class="form-control validate[required]" placeholder="Họ và tên" value="{{ $item->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control validate[required,custom[email]]" placeholder="Email" value="{{ $item->email }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="">
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-form-label col-auto w-120">Thứ tự</label>
                        <div class="col-auto"><input type="number" name="priority" class="form-control" value="{{ $item->priority }}" min="1" max="9999" placeholder="Thứ tự" disabled></div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-auto w-120">Tình trạng</label>
                        <div class="col">
                        @forelse($config['status'] as $k => $v)
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input type="checkbox" name="status[]" value="{{ $k }}" {{ strpos($item->status,$k) !== false ? 'checked' : '' }} class="custom-control-input" id="customCheck{{ $k }}">
                                <label class="custom-control-label" for="customCheck{{ $k }}">{{ $v }}</label>
                            </div>
                        @empty
                        @endforelse
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="{{ route('admin.users.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-login-variant"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection