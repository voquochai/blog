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

                    @if($config['images'])
                    <li class="nav-item">
                        <a href="#images" data-toggle="tab" aria-expanded="false" class="nav-link"> Thư viện ảnh </a>
                    </li>
                    @endif
                </ul>
                <form method="post" class="form-validation" action="{{ route('admin.products.update', ['id'=>$item->id, 'type'=>$type]) }}" novalidate="" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane show active" id="general">
                            @if($config['category'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Danh mục</label>
                                <div class="col-lg-10 col-12">
                                    <select name="data[category_id]" class="selectpicker form-control">
                                        <option value=""> -- Chọn danh mục -- </option>
                                        @php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse, $item, $config, $type) {
                                            foreach ($categories as $category) {
                                                echo '<option value="'.$category->id.'" '.($category->id == $item->category_id ? 'selected' : '').' >'.$prefix.' '.$category->languages->first()->name.'</option>';
                                                $traverse($category->children, $prefix.'|--');
                                            }
                                        };
                                        $traverse($categories);
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if($config['supplier'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12">Nhà cung cấp</label>
                                <div class="col-lg-10 col-12">
                                    <select name="data[supplier_id]" class="selectpicker form-control">
                                        <option value=""> -- Chọn danh mục -- </option>
                                        @forelse($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ ($supplier->id == $item->supplier_id) ? 'selected' : '' }} >{{ $supplier->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Mã sản phẩm </label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[code]" class="form-control text-uppercase validate[required]" value="{{ $item->code }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Giá gốc </label>
                                <div class="col-lg-10 col-12">
                                    <div class="input-group">
                                        <input type="text" name="original_price" class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" value="{{ $item->original_price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white">Đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Giá bán </label>
                                <div class="col-lg-10 col-12">
                                    <div class="input-group">
                                        <input type="text" name="regular_price" class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" value="{{ $item->regular_price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white">Đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Giá khuyến mãi </label>
                                <div class="col-lg-10 col-12">
                                    <div class="input-group">
                                        <input type="text" name="sale_price" class="form-control" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true" value="{{ $item->sale_price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white">Đ</span>
                                        </div>
                                    </div>
                                    
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
                                        "file":"{{ asset( 'public/'.$path.'/'.$item->image.'?v='.time() ) }}",
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

                            @if($config['link'])
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Link </label>
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="data[link]" class="form-control" value="{{ $item->link }}">
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-12"> Trọng lượng </label>
                                <div class="col-lg-10 col-12">
                                    <div class="input-group">
                                        <input type="text" name="weight" class="form-control" value="{{ $item->weight }}" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white">G</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                <label class="control-label">Nội dung</label>
                                <textarea name="dataL[{{ $key }}][contents]" class="form-control tinymce-editor" rows="6" placeholder="Nội dung" >{{ $dataL->contents }}</textarea>
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

                            @if($config['attributes'])
                            <div id="qh-app-{{$key}}">
                                <label class="control-label">Thuộc tính</label>
                                <qh-attributes-{{$key}}></qh-attributes-{{$key}}>
                            </div>
                            @endif
                        </div>
                        @php $i++ @endphp
                        @empty
                        @endforelse

                        @if($config['images'])
                        <div class="tab-pane" id="images">
                            <div class="mb-3"><input type="file" name="images" data-fileuploader="multiple" data-fileuploader-files='[
                                @forelse( $images as $key => $image)
                                    {{ (($key > 0) ? ',' : '') }}
                                    {
                                        "name":"{{ $image->name }}",
                                        "size": {{ $image->size }},
                                        "type":"{{ $image->mime_type }}",
                                        "file":"{{ asset( 'public/'.$path.'/'.$image->name.'?v='.time() ) }}",
                                        "data":{
                                            "id":"{{ $image->id }}",
                                            "alt":"{{ $image->alt }}",
                                            "priority":"{{ $image->priority }}"
                                        }
                                    }
                                @empty
                                @endforelse
                            ]'></div>
                            <div class="fileuploader-table"></div>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary"> <i class="mdi mdi-check"></i> Lưu</button>
                        <a href="{{ route('admin.products.index', ['type'=>$type]) }}" class="btn btn-danger" > <i class="mdi mdi-close"></i> Thoát</a>
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