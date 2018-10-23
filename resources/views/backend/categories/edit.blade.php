@extends('backend.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Chỉnh sửa</h4>
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
                <form method="post" class="form-validation" action="{{ route('admin.categories.update', ['id'=>$item->id, 'type'=>$type]) }}" novalidate="" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane show active" id="general">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Chọn danh mục</label>
                                <div class="col-lg-10 col-12">
                                    <select name="data[parent_id]" class="selectpicker form-control">
                                        <option value="0"> -- Danh mục cha -- </option>
                                        @php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse, $item, $config, $type, $path) {
                                            foreach ($categories as $category) {
                                                echo '<option value="'.$category->id.'" '.($category->id == $item->parent_id ? 'selected' : '').' >'.$prefix.' '.$category->languages->first()->name.'</option>';
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
                                    @if( $item->image && file_exists( public_path($path.'/'.$item->image) ) )
                                    @php
                                        $imageInfo = getimagesize('public/'.$path.'/'.$item->image);
                                        $imageInfo['size'] = filesize('public/'.$path.'/'.$item->image);
                                    @endphp
                                    <input type="file" name="image" data-fileuploader="single" data-fileuploader-files='[{
                                        "name":"{{ $item->image }}",
                                        "type":"{{ $imageInfo['mime'] }}",
                                        "size":"{{ $imageInfo['size'] }}",
                                        "file":"{{ asset( 'public/'.$path.'/'.$item->image ) }}",
                                        "data": {
                                            "id": "{{ $item->id }}"
                                        }
                                    }]'>
                                    @else
                                    <input type="file" name="image" data-fileuploader="single"/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Alt</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[alt]" class="form-control" value="{{ $item->alt }}">
                                </div>
                            </div>
                            @endif
                            
                            @if($config['icon'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Font Icon</label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[icon]" class="form-control" value="{{ $item->icon }}">
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Thứ tự</label>
                                <div class="col-lg-auto col-12"><input type="number" name="priority" class="form-control" value="{{ $item->priority }}" placeholder="Thứ tự" disabled></div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-auto">Tình trạng</label>
                                <div class="col-lg-10 col">
                                @forelse($config['status'] as $k => $v)
                                    <div class="custom-control custom-control-inline custom-checkbox">
                                        <input type="checkbox" name="status[]" value="{{ $k }}" {{ strpos($item->status,$k) !== false ? 'checked' : '' }} class="custom-control-input" id="customCheck{{ $k }}">
                                        <label class="custom-control-label" for="customCheck{{ $k }}">{{ $v }}</label>
                                    </div>
                                @empty
                                @endforelse
                                </div>
                            </div>
                        </div>
                        @php $i = 0 @endphp
                        @forelse( config('siteconfigs.languages') as $key => $val )
                        @php $dataL = $item->languages->where('language',$key)->first(); @endphp
                        <div class="tab-pane" id="language-{{ $key }}">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" name="dataL[{{ $key }}][name]" class="form-control {{ $key==config('siteconfigs.general.language') ? 'validate[required] link-to-slug' : '' }}" placeholder="Tiêu đề" value="{{ $dataL->name }}">
                            </div>
                            @if( $key==config('siteconfigs.general.language') )
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="dataL[{{ $key }}][slug]" class="form-control slug" placeholder="Slug" value="{{ $dataL->slug }}">
                            </div>
                            @endif

                            @if($config['description'])
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="dataL[{{ $key }}][description]" class="form-control" rows="5" placeholder="Mô tả" >{{ $dataL->description }}</textarea>
                            </div>
                            @endif

                            @if($config['contents'])
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="dataL[{{ $key }}][contents]" class="form-control ck-editor" rows="6" placeholder="Nội dung" >{{ $dataL->contents }}</textarea>
                            </div>
                            @endif

                            @if($config['meta'])
                            <div class="form-group">
                                <label>Meta title</label>
                                <input type="text" name="dataL[{{ $key }}][meta][title]" class="form-control" placeholder="Meta title" value="{{ $dataL->meta['title'] }}">
                            </div>
                            <div class="form-group">
                                <label>Meta keywords</label>
                                <input type="text" name="dataL[{{ $key }}][meta][keywords]" class="form-control" placeholder="Meta keywords" value="{{ $dataL->meta['keywords'] }}">
                            </div>
                            <div class="form-group">
                                <label>Meta description</label>
                                <textarea type="text" name="dataL[{{ $key }}][meta][description]" class="form-control" placeholder="Meta description" rows="5">{{ $dataL->meta['description'] }}</textarea>
                            </div>
                            @endif

                        </div>
                        @php $i++ @endphp
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
<script src="{{ asset('public/packages/file-uploader/fileuploader.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/packages/file-uploader/fileuploader.config.js') }}" type="text/javascript"></script>
@if($config['contents'])
<script src="{{ asset('public/packages/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/packages/tinymce/tinymce.config.js') }}" type="text/javascript"></script>
@endif
@endsection