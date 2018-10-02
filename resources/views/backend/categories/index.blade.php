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
                                <th width="1%" style="text-align: center;">
                                    <div class="custom-control custom-checkbox custom-checkbox-all custom-checkbox-single">
                                        <input type="checkbox" name="" class="custom-control-input" id="customCheckAll" data-group="all">
                                        <label class="custom-control-label" for="customCheckAll"></label>
                                    </div>
                                </th>
                                <th width="1%" style="text-align: center;">#</th>
                                <th>Tiêu đề</th>
                                @if($config['image'])
                                <th width="15%" style="text-align: center;"> Hình ảnh </th>
                                @endif
                                <th width="15%" style="text-align: center;">Ngày tạo</th>
                                <th width="20%" style="text-align: center;">Tình trạng</th>
                                <th width="20%" style="text-align: center;">Thực thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $traverse = function ($items, $prefix = '') use (&$traverse, $config, $type, $path) {

                                    foreach ($items as $item) {
                            @endphp
                                <tr {!! $prefix == '' ? 'class="table-light"' : '' !!} >
                                    <td>
                                        <div class="custom-control custom-checkbox custom-checkbox-single">
                                            <input type="checkbox" name="checkAction[]" value="{{ $item->id }}" class="custom-control-input" id="customCheck{{ $item->id }}" data-group="all">
                                            <label class="custom-control-label" for="customCheck{{ $item->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="priority" value="{{ $item->priority }}" class="form-control form-control-sm form-control-light" onchange="$.Tools.updatePriority({{ $item->id }}, this.value, event)" />
                                    </td>
                                    <td><a href="{{ route('admin.categories.edit', ['id'=>$item->id, 'type'=>$type]) }}">{{ $prefix.' '.$item->languages[0]->name }}</a></td>
                                    @if($config['image'])
                                    <td align="center"> {!! ($item->image && file_exists(public_path(get_thumbnail($path.'/'.$item->image))) )?'<img src="'.asset(get_thumbnail('public/'.$path.'/'.$item->image)).'" height="50" />':'' !!} </td>
                                    @endif
                                    <td align="center">{{ $item->created_at }}</td>
                                    <td align="center">
                                        @php foreach($config['status'] as $k => $v){ @endphp
                                        <button type="button" class="btn btn-sm btn-{{ strpos($item->status,$k) !== false ? 'info' : 'secondary' }} btn-status-{{ $k }}" onclick="$.Tools.changeStatus({{ $item->id }}, '{{ $k }}', event)"> {{ $v }} </button>
                                        @php } @endphp
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('admin.categories.edit', ['id'=>$item->id, 'type'=>$type]) }}" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-circle-edit-outline"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="$.Tools.deleteRow({{ $item->id }}, event)" >
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @php
                                        $traverse($item->children, $prefix.'-');
                                    }
                                };
                                $traverse($items);
                            @endphp
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection