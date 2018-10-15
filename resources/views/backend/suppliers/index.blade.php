@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="{{ route('admin.suppliers.create', ['type'=>$type]) }}" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="mdi mdi-dots-horizontal"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated" x-placement="bottom-end">
                            @forelse($config['status'] as $k => $v)
                            <a href="javascript:;" class="dropdown-item" onclick="$.Tools.changeMultiStatus('{{ $k }}', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i>{{ $v }}</a>
                            @empty
                            @endforelse
	                        <a href="javascript:;" class="dropdown-item" onclick="$.Tools.deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
	                    </div>
	                </div>
                </div>
				<h4 class="header-title">Danh sách</h4>
    		</div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-centered">
                        <thead class="thead-light">
                            <tr>
                            	<th style="width: 1%;">
                            		<div class="custom-control custom-checkbox custom-checkbox-all custom-checkbox-single">
                                        <input type="checkbox" name="" class="custom-control-input" id="customCheckAll" data-group="all">
                                        <label class="custom-control-label" for="customCheckAll"></label>
                                    </div>
                            	</th>
                                <th style="width: 5%;">#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Ngày đăng ký</th>
                                <th>Tình trạng</th>
                                <th>Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                            	<td>
                            		<div class="custom-control custom-checkbox custom-checkbox-single">
                                        <input type="checkbox" name="checkAction[]" value="{{ $item->id }}" class="custom-control-input" id="customCheck{{ $item->id }}" data-group="all">
                                        <label class="custom-control-label" for="customCheck{{ $item->id }}"></label>
                                    </div>
                            	</td>
                                <td>
                                    <input type="text" name="priority" value="{{ $item->priority }}" class="form-control form-control-sm form-control-light" onchange="$.Tools.updatePriority({{ $item->id }}, this.value, event)" />
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @forelse($config['status'] as $k => $v)
                                    <button type="button" class="btn btn-sm btn-{{ strpos($item->status,$k) !== false ? 'info' : 'secondary' }} btn-status-{{ $k }}" onclick="$.Tools.changeStatus({{ $item->id }}, '{{ $k }}', event)"> {{ $v }} </button>
                                    @empty
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('admin.suppliers.edit', ['id'=>$item->id, 'type'=>$type]) }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-circle-edit-outline"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger" onclick="$.Tools.deleteRow({{ $item->id }}, event)" >
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="30"></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
                <nav>{!! $items->appends(['type' => $type])->links('backend.blocks.pagination') !!}</nav>
            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection