@extends('backend.app')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="header-title">Thêm mới</h4>
    		</div>
            <div class="card-body">
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active"> Thông tin chung </a>
                    </li>
                    @forelse( config('siteconfigs.languages') as $key => $val )
                    <li class="nav-item">
                        <a href="#language-{{ $key }}" data-toggle="tab" aria-expanded="false" class="nav-link"> {{ $val }} </a>
                    </li>
                    @empty
                    @endforelse
                </ul>
                <form method="post" class="form-validation" action="{{ route('admin.categories.store', ['type'=>$type]) }}" novalidate="" enctype="multipart/form-data">
                    @csrf
                    @php
                        if( old('data.parent_id') )
                            $parent_id = old('data.parent_id');
                        else
                            $parent_id = 0;
                    @endphp
                    <div class="tab-content">
                        <div class="tab-pane show active" id="general">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Chọn danh mục</label>
                                <div class="col-lg-10 col-12">
                                    <select name="data[parent_id]" class="selectpicker form-control">
                                        <option value="0"> -- Danh mục cha -- </option>
                                        @php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse, $parent_id, $config, $type) {
                                            foreach ($categories as $category) {
                                                echo '<option value="'.$category->id.'" '.($category->id == $parent_id ? 'selected' : '').' >'.$prefix.' '.$category->languages->first()->name.'</option>';
                                                $traverse($category->children, $prefix.'|--');
                                            }
                                        };
                                        $traverse($categories);
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            @if($config['image'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Hình ảnh</label>
                                <div class="col-lg-10 col-12">
                                    <input type="file" name="image" data-fileuploader="single">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Alt</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[alt]" class="form-control" value="{{ old('data.alt') }}">
                                </div>
                            </div>
                            @endif
                            
                            @if($config['icon'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Font Icon</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[icon]" class="form-control" value="{{ old('data.icon') }}">
                                    <small> Find here: <a href="https://cdn.materialdesignicons.com/2.8.94/" target="_blank">Material Design Icons</a> </small>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Thứ tự</label>
                                <div class="col-lg-auto col-12"><input type="number" name="priority" class="form-control" value="{{ $priority+1 }}" placeholder="Thứ tự" disabled></div>
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
                        </div>
                        @forelse( config('siteconfigs.languages') as $key => $val )
                        <div class="tab-pane" id="language-{{ $key }}">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="dataL[{{ $key }}][name]" class="form-control {{ $key==config('siteconfigs.general.language') ? 'validate[required] link-to-slug' : '' }}" placeholder="Tiêu đề" value="{{ old('dataL.'.$key.'.name') }}">
                            </div>
                            @if( $key==config('siteconfigs.general.language') )
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="dataL[{{ $key }}][slug]" class="form-control slug" placeholder="Slug" value="{{ old('dataL.'.$key.'.slug') }}">
                            </div>
                            @endif

                            @if($config['description'])
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="dataL[{{ $key }}][description]" class="form-control" rows="5" placeholder="Mô tả" >{{ old('dataL.'.$key.'.description') }}</textarea>
                            </div>
                            @endif

                            @if($config['contents'])
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="dataL[{{ $key }}][contents]" class="form-control tinymce-editor" rows="6" placeholder="Nội dung" >{{ old('dataL.'.$key.'.contents') }}</textarea>
                            </div>
                            @endif

                            @if($config['meta'])
                            <div class="form-group">
                                <label>Meta title</label>
                                <input type="text" name="dataL[{{ $key }}][meta][title]" class="form-control" placeholder="Meta title" value="{{ old('dataL.'.$key.'.meta.title') }}">
                            </div>
                            <div class="form-group">
                                <label>Meta keywords</label>
                                <input type="text" name="dataL[{{ $key }}][meta][keywords]" class="form-control" placeholder="Meta keywords" value="{{ old('dataL.'.$key.'.meta.keywords') }}">
                            </div>
                            <div class="form-group">
                                <label>Meta description</label>
                                <textarea type="text" name="dataL[{{ $key }}][meta][description]" class="form-control" placeholder="Meta description" rows="5">{{ old('dataL.'.$key.'.meta.description') }}</textarea>
                            </div>
                            @endif

                        </div>
                        @empty
                        @endforelse
                        <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                        <a href="{{ route('admin.categories.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-close"></i> Thoát</a>
                    </div>
                </form>
            </div> <!-- end card body-->
        </div>
	</div>
</div>
@endsection

@section('style')
<link href="{{ asset('public/packages/file-uploader/fileuploader.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
@if($config['image'])
<script src="{{ asset('public/packages/file-uploader/fileuploader.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/packages/file-uploader/fileuploader.config.js') }}" type="text/javascript"></script>
@endif
@if($config['contents'])
<script src="{{ asset('public/packages/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/packages/tinymce/tinymce.config.js') }}" type="text/javascript"></script>
@endif
@endsection