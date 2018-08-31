@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="{{ route('admin.categories.create', ['type'=>$type]) }}" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="dripicons-dots-3"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            @forelse($config['status'] as $k => $v)
                            <a href="javascript:;" class="dropdown-item" onclick="$.MyTools.changeMultiStatus('{{ $k }}', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i>{{ $v }}</a>
                            @empty
                            @endforelse
	                        <a href="javascript:;" class="dropdown-item" onclick="$.MyTools.deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
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
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Tình trạng</th>
                                <th>Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $traverse = function ($categories, $prefix = '') use (&$traverse, $config, $type) {

                                    foreach ($categories as $category) {
                            @endphp
                                <tr {!! $prefix == '' ? 'class="table-light"' : '' !!} >
                                    <td>
                                        <div class="custom-control custom-checkbox custom-checkbox-single">
                                            <input type="checkbox" name="checkAction[]" value="{{ $category->id }}" class="custom-control-input" id="customCheck{{ $category->id }}" data-group="all">
                                            <label class="custom-control-label" for="customCheck{{ $category->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="priority" value="{{ $category->priority }}" class="form-control form-control-sm form-control-light" onchange="$.MyTools.updatePriority({{ $category->id }}, this.value, event)" />
                                    </td>
                                    <td><a href="{{ route('admin.categories.edit', ['id'=>$category->id, 'type'=>$type]) }}">{{ $prefix.' '.$category->name }}</a></td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        @php foreach($config['status'] as $k => $v){ @endphp
                                        <button type="button" class="btn btn-sm btn-{{ strpos($category->status,$k) !== false ? 'info' : 'secondary' }} btn-status-{{ $k }}" onclick="$.MyTools.changeStatus({{ $category->id }}, '{{ $k }}', event)"> {{ $v }} </button>
                                        @php } @endphp
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', ['id'=>$category->id, 'type'=>$type]) }}" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-circle-edit-outline"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="$.MyTools.deleteRow({{ $category->id }}, event)" >
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @php
                                        $traverse($category->children, $prefix.'-');
                                    }
                                };
                                $traverse($categories);
                            @endphp
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection