@extends('admin.layout.master_layout')
@section('content')

    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit product</h4>
                            <div class="form-validation">

                                <form class="form-valide" action="{{route('products.update', $product->id)}}" method="post"
                                      enctype="multipart/form-data" style="display: flex">
                                    @method('PUT')
                                    @csrf
                                    <div class="col-sm-5">

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"><b>Product Name</b></label>
                                            <input type="text" name="edit_name" value="{{$product->product_name}}" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"><b>Base Price</b></label>
                                            <input type="text" name="edit_base_price" value="{{$product->base_price}}" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1"><b>Category</b></label>
                                            <select name="edit_category" class="form-control">
                                                <option value="{{$product->category->id}}" selected>{{$product->category->category_name}}</option>
                                                @foreach($categories as $category)
                                                   @if($category->id == $product->category->id)
                                                        <option value="{{$category->id}}" selected>
                                                            {{$category->category_name}}
                                                        </option>
                                                    @else
                                                        <option value="{{$category->id}}">
                                                            {{$category->category_name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1"><b>Material</b></label>
                                            <select name="edit_material" class="form-control">
                                                <option value="{{$product->material->id}}">{{$product->material->material_name}}</option>
                                                @foreach($materials as $material)
                                                    @if($material->id == $product->material->id)
                                                        <option value="{{$material->id}}" selected>
                                                            {{$material->material_name}}
                                                        </option>
                                                    @else
                                                        <option value="{{$material->id}}">
                                                            {{$material->material_name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1"><b>Brand</b></label>
                                            <select name="edit_brand" class="form-control">
                                                <option value="{{$product->brand->id}}">{{$product->brand->brand_name}}</option>
                                                @foreach($brands as $brand)
                                                    @if($brand->id == $product->brand->id)
                                                        <option value="{{$brand->id}}" selected>
                                                            {{$brand->brand_name}}
                                                        </option>
                                                    @else
                                                        <option value="{{$brand->id}}">
                                                            {{$brand->brand_name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="mb-3">
                                            <label for="exampleFormControlFile1"><b>Origin</b></label>
                                            <select name="edit_origin" class="form-control">
                                                <option value="{{$product->origin->id}}">{{$product->origin->origin_name}}</option>
                                                @foreach($origins as $origin)
                                                    <option value="{{$origin->id}}">
                                                        {{$origin->origin_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"><b>Description </b></label>
                                            <textarea name="edit_description" value="{{$product->description}}" class="form-control" ></textarea>
                                        </div>


                                        @foreach($variants as $index => $variant)
                                            <div class="form-group" data-variant-id="{{ $variant->id }}">
                                                <label for="color"><b>Color</b></label>
                                                <select name="edit_variant[{{ $index }}][color]" class="form-control">
                                                    <option value="">Please select option</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{ $color->id }}" {{ $color->id == $variant->color_id ? 'selected' : '' }}>
                                                            {{ $color->color_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="size"><b>Size</b></label>
                                                <select name="edit_variant[{{ $index }}][size]" class="form-control">
                                                    <option value="{{ $variant->size->id }}">Please select option</option>
                                                    @foreach($sizes as $size)
                                                        <option value="{{ $size->id }}" {{ $size->id == $variant->size_id ? 'selected' : '' }}>
                                                            {{ $size->size_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="price"><b>Price</b></label>
                                                <input type="text" name="edit_variant[{{ $loop->index }}][price]" value="{{ $variant->price }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity"><b>Stock quantity</b></label>
                                                <input type="text" name="edit_variant[{{ $loop->index }}][quantity]" value="{{ $variant->stock_quantity }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="quantity"><b>Current Images</b></label>
                                                @foreach ($variant->images as $image)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $image->url) }}" alt="Image" width="100"/>
                                                        <input type="checkbox" name="edit_variant[{{ $variant->id }}][delete_images][]" value="{{ $image->id }}"> Delete
                                                        <input type="radio" name="edit_variant[{{ $variant->id }}][images][primary]" value="{{ $image->id }}" {{ $image->is_primary ? 'checked' : '' }}> Set as Primary
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div>
                                                <label for="quantity"><b>Add new Images</b></label>
                                                <input type="file" name="edit_variant[{{ $variant->id }}][images][new][]" multiple>
                                            </div>
                                        @endforeach

                                        <div class="form-group row" style="margin-left: 465px">
                                            <div class="col-lg-8 ml-auto mb-3">
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                            <div class="col-lg-8 ml-auto">
                                                <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->


        <script>
            function previewImage() {
                prd_image.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
        <!--**********************************
@endsection
