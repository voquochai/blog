@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <div class="card-widgets">
                    <a href="{{ route('admin.users.create', ['type'=>$type]) }}" class="btn btn-primary mr-2"> <i class="mdi mdi-plus"></i> Tạo mới</a>
                    <div class="dropdown">
	                    <a href="javascript:void(0);" class="btn btn-outline-primary rounded-circle dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
	                        <i class="mdi mdi-dots-horizontal"></i>
	                    </a>
	                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            @forelse($config['status'] as $k => $v)
                            <a href="javascript:;" class="dropdown-item" onclick="changeMultiStatus('{{ $k }}', event)"><i class="mdi mdi-circle-edit-outline mr-1"></i>{{ $v }}</a>
                            @empty
                            @endforelse
	                        <a href="javascript:;" class="dropdown-item" onclick="deleteMultiRows(event)"><i class="mdi mdi-delete mr-1"></i>Xóa chọn</a>
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
                            @forelse($users as $user)
                            <tr>
                            	<td>
                            		<div class="custom-control custom-checkbox custom-checkbox-single">
                                        <input type="checkbox" name="checkAction[]" value="{{ $user->id }}" class="custom-control-input" id="customCheck{{ $user->id }}" data-group="all">
                                        <label class="custom-control-label" for="customCheck{{ $user->id }}"></label>
                                    </div>
                            	</td>
                                <td>
                                    <input type="text" name="priority" value="{{ $user->priority }}" class="form-control form-control-sm form-control-light" onchange="updatePriority({{ $user->id }}, this.value, event)" />
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @forelse($config['status'] as $k => $v)
                                    <button type="button" class="btn btn-sm btn-{{ strpos($user->status,$k) !== false ? 'info' : 'secondary' }} btn-status-{{ $k }}" onclick="changeStatus({{ $user->id }}, '{{ $k }}', event)"> {{ $v }} </button>
                                    @empty
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.edit', ['id'=>$user->id, 'type'=>$type]) }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-circle-edit-outline"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger" onclick="deleteRow({{ $user->id }}, event)" >
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
                <nav>{!! $users->appends(['type' => $type])->links('backend.blocks.pagination') !!}</nav>
            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('public/packages/axios.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    })
    function updatePriority(id,priority,event){
        event.preventDefault();
        var btn = event.target;
        axios.post('{{ route('admin.users.update_priority') }}',{
            id: id,
            priority: priority
        }).then(res => {
            if(res.data.class === 'success'){
                $(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        });
    }
    function changeStatus(id,status,event){
        event.preventDefault();
        var btn = event.target;
        axios.post('{{ route('admin.users.change_status') }}',{
            id: id,
            status: status
        }).then(res => {
            if(res.data.class === 'success'){
                $(btn).toggleClass('btn-info').toggleClass('btn-secondary');
            }
            $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
        });
    }
    function changeMultiStatus(status,event){
        event.preventDefault();
        if( $('input[name="checkAction[]"]').is(':checked') ){
            var ids = $('input[name="checkAction[]"]:checked').map( function () { return this.value; } ).get().join(",");
            axios.post('{{ route('admin.users.change_status') }}',{
                id: ids,
                status: status
            }).then(res => {
                if(res.data.class === 'success'){
                    $('input[name="checkAction[]"]:checked').map(function () {
                        $(this).closest('tr').find('.btn-status-'+status).toggleClass('btn-info').toggleClass('btn-secondary');
                    });
                }
                $.NotificationApp.send(res.data.head, res.data.message, "top-right", "rgba(0,0,0,0.2)", res.data.class);
            });
        }else{
            $.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
        
    }
    function deleteRow(id,event){
        event.preventDefault();
        var btn = event.target;
        swalWithBootstrapButtons({
            title: 'Xóa dữ liệu?',
            text: "Bạn không thể hoàn nguyên thao tác này!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không, hủy bỏ!',
            reverseButtons: true
        }).then((res) => {
            if (res.value) {
                axios.delete('users/'+id)
                .then(res => {
                    if(res.data.class === 'success'){
                        $(btn).closest('tr').slideUp('slow', function() {
                            $(this).remove();
                        });
                    }
                    swalWithBootstrapButtons(res.data.head,res.data.message,res.data.class);
                });
            } else if ( res.dismiss === swal.DismissReason.cancel ) {
                swalWithBootstrapButtons('Hủy bỏ','Bạn đã hủy bỏ thao tác này.','error')
            }
        });
    }
    function deleteMultiRows(event){
        event.preventDefault();
        if( $('input[name="checkAction[]"]').is(':checked') ){
            swalWithBootstrapButtons({
                title: 'Xóa dữ liệu?',
                text: "Bạn không thể hoàn nguyên thao tác này!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa tất cả!',
                cancelButtonText: 'Không, hủy bỏ!',
                reverseButtons: true
            }).then((res) => {
                if (res.value) {
                    $('input[name="checkAction[]"]:checked').map(function () {
                        var id = this.value;
                        axios.delete('users/'+id)
                        .then(res => {
                            if(res.data.class === 'success'){
                                $(this).closest('tr').slideUp('slow', function() {
                                    $(this).remove();
                                });
                            }
                        });
                    });
                    swalWithBootstrapButtons("Thành công!", "Xóa tất cả dữ liệu thành công.", "success");
                } else if ( res.dismiss === swal.DismissReason.cancel ) {
                    swalWithBootstrapButtons('Hủy bỏ','Bạn đã hủy bỏ thao tác này.','error')
                }
            });
        }else{
            $.NotificationApp.send("Cảnh báo!", "Chưa có mục nào được chọn", "top-center", "rgba(0,0,0,0.2)", "warning");
        }
    };
</script>
@endsection