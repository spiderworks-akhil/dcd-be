@extends('admin._layouts.fileupload')
@section('content')

<!-- Top Bar Start -->
            <div class="topbar">
                <!-- Navbar -->
                <nav class="navbar-custom">
                    @include('admin._partials.profile_menu')

                    <ul class="list-unstyled topbar-nav mb-0">
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li>

                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        @if($obj->id)
                                            <h4 class="page-title">Edit Product</h4>
                                        @else
                                            <h4 class="page-title">Create new Product</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Products</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Product</li>
                                        </ol>
                                    </div><!--end col-->
                                    @if(auth()->user()->can($permissions['create']))
                                    <div class="col-auto align-self-center">
                                        <a class=" btn btn-sm btn-primary" href="{{route($route.'.create')}}" role="button"><i class="fas fa-plus mr-2"></i>Create New</a>
                                    </div>
                                    @endif
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->

                    <div class="row ">
                        <div class="col-lg-12">
                            @include('admin._partials.notifications')
                                @if($obj->id)
                                        <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @else
                                        <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">
                                    <div class="row ">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    Product Details
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="row m-0">
                                                            <div class="form-group col-md-6">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control @if(!$obj->id) copy-name @endif" value="{{$obj->name}}" required="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="">Slug (for url)</label>
                                                                <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                                                <small class="text-muted">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Heading</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}" required="">
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Content</label>
                                                                <textarea name="description" class="form-control editor"  id="description">{{$obj->description}}</textarea>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div><!--end card-body-->
                                            </div><!--end card-->

                                        </div>


                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    Publish
                                                </div>
                                                <div class="card-body">
                                                    <div class="row m-0">
                                                        <div class="form-group w-100  mb-2">
                                                            <div class="custom-control custom-switch switch-primary float-left">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="status" name="status" @if(!$obj->id || $obj->status == 1) checked="" @endif>
                                                                <label class="custom-control-label" for="status">Status</label>
                                                            </div>
                                                            <div class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_featured" name="is_featured" @if($obj->is_featured == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_featured">Featured</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group w-100 mb-1">
                                                            <label for="name">Created On: </label>
                                                            @if(!$obj->id)
                                                                {{date('d M, Y h:i A')}}
                                                            @else
                                                                {{date('d M, Y h:i A', strtotime($obj->created_at))}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Last Updated On: </label>
                                                            @if(!$obj->id)
                                                                {{date('d M, Y h:i A')}}
                                                            @else
                                                                {{date('d M, Y h:i A', strtotime($obj->updated_at))}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Created By: </label>
                                                            @if(!$obj->id)
                                                                {{auth()->user()->name}}
                                                            @else
                                                                {{$obj->created_user->name}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Last Updated By: </label>
                                                            @if(!$obj->id)
                                                                {{auth()->user()->name}}
                                                            @else
                                                                {{$obj->updated_user->name}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <button class="btn btn-sm btn-primary float-right">Save</button>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    Priority
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group col-md-12">
                                                        <label>Priority</label>
                                                        <input type="number" name="priority" class="form-control numeric" value="{{$obj->priority}}" >
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="card">
                                            <div class="card-header">
                                                Select Category
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group col-md-12">
                                                    <label class="">Category </label>
                                                    <select name="category_id" class="w-100 webadmin-select2-input" data-placeholder="Select a Category">
                                                        <option value="">-- No Category  --</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}" @if($obj->category_id == $category->id) selected="selected" @endif>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    Product Features
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="row m-0">
                                                            @if ($obj->category_id != null)
                                                                <div class="form-group col-md-12">
                                                                    <label>Brand</label>
                                                                    <select name="brand_id" class="w-100 webadmin-select2-input" data-placeholder="Select a Brand">
                                                                        <option value="">-- No Brand  --</option>
                                                                        @foreach($brands as $brand)
                                                                            <option value="{{$brand->id}}" @if($obj->brand_id == $brand->id) selected="selected" @endif>{{$brand->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif

                                                            <div class="form-group col-md-12">
                                                                <label>Barcode</label>
                                                                <input type="text" name="barcode" class="form-control" value="{{$obj->barcode}}" >
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label>Price</label>
                                                                <input type="number" name="price" class="form-control" value="{{$obj->price}}" >
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label class="">Discount</label>
                                                                <input type="number" name="discount" class="form-control" value="{{$obj->discount }}" id="discount">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label>Stock Quantity</label>
                                                                <input type="number" name="stock_quantity" class="form-control" value="{{$obj->stock_quantity}}" >
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label class="">Stock Status</label>
                                                                    <select name="stock_status" class="w-100 webadmin-select2-input" data-placeholder="Select a Brand">
                                                                        <option value="in_stock" @if($obj->stock_status == "in_stock") selected="selected" @endif>In stock</option>
                                                                        <option value="out_of_stock" @if($obj->stock_status == "out_of_stock") selected="selected" @endif>Out of stock</option>
                                                                    </select>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>weight</label>
                                                                <input type="text" name="weight" class="form-control" value="{{$obj->weight}}" >
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Attributes</label>
                                                                <textarea name="attributes" class="form-control editor"  id="attributes">{{$obj->attributes}}</textarea>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Dimensions</label>
                                                                <textarea name="dimensions" class="form-control editor"  id="dimensions">{{$obj->dimensions}}</textarea>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div><!--end card-body-->
                                            </div><!--end card-->

                                        </div>


                                        <div class="col-md-4">

                                            <div class="card">
                                                <div class="card-header">
                                                    Featured Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->featured_image, 'title'=>'Featured Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'featured_image_id'])
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    Banner Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    OG Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->og_image, 'title'=>'OG Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'og_image_id'])
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    Product video
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->product_video, 'title'=>'video', 'popup_type'=>'single_image', 'type'=>'video', 'holder_attr'=>'product_video_id'])
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                  </form>


                        </div><!--end col-->
                    </div><!--end row-->

                </div><!-- container -->

                @include('admin._partials.footer')
            </div>
            <!-- end page content -->
@endsection
@section('footer')
    <script type="text/javascript">
        var validator = $('#InputFrm').validate({
            ignore: [],
            rules: {
                "name": "required",
                slug: {
                  required: true,
                  remote: {
                      url: "{{route('admin.unique-slug')}}",
                      data: {
                        id: function() {
                          return $( "#inputId" ).val();
                        },
                        table: 'products',
                    }
                  }
                },
              },
              messages: {
                "name": "Product name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });
    </script>

    <script type="text/javascript">
            var validator = $('#AttrtInputFrm').validate({
                ignore: [],
                rules: {
                    "attributes[0][name]": "required",
                    "attributes[0][priority]": {
                    required: true,
                    remote: {
                        url: "{{route('admin.unique-slug')}}",
                        data: {
                            id: function() {
                            return $( "#inputId" ).val();
                            },
                            table: 'attributes',
                        }
                    }
                    },
                },
                messages: {
                "attributes[0][name]": "Attribute name cannot be blank",
                "attributes[0][priority]": {
                    required: "Priority cannot be blank",
                    // remote: "Slug is already in use",
                },
                },
                });
    </script>

@parent
@endsection

