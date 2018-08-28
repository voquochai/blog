@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">Chỉnh sửa</h4>
    		</div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.users.update', ['id'=>$user->id, 'type'=>'mod']) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label>Họ và tên</label>
                        <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="{{ $user->name }}" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="">
                    </div>
                    <div class="form-group mb-3">
                        <label>Thứ tự</label>
                        <input type="number" name="priority" class="form-control" value="{{ $user->priority }}" min="1" max="9999" placeholder="Thứ tự" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Tình trạng</label>
                        @forelse($config['status'] as $k => $v)
                        <div class="custom-control custom-control-inline custom-checkbox ml-2">
                            <input type="checkbox" name="status[]" value="{{ $k }}" {{ strpos($user->status,$k) !== false ? 'checked' : '' }} class="custom-control-input" id="customCheck{{ $k }}">
                            <label class="custom-control-label" for="customCheck{{ $k }}">{{ $v }}</label>
                        </div>
                        @empty
                        @endforelse

                    </div>
                    <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                    <a href="{{ route('admin.users.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-close"></i> Thoát</a>
                </form>

            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection

@section('style')
<link href="{{ asset('public/packages/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="{{ asset('public/packages/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
@endsection