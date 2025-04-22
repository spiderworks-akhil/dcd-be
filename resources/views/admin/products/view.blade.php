@extends('admin._layouts.fileupload')
@section('content')

<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    /* tr:nth-child(even) {
    background-color: #dddddd;
    } */
</style>
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
                    
                    <div class="row">
                        <div class="col-lg-12">
                            @include('admin._partials.notifications')
                            @if($obj->id)
                                        <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @else
                                        <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    Product Details
                                                </div>
                                                <div class="card-body">
                                                    <div data-simplebar>
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
                                                                <textarea name="description" class="form-control editor" id="description">{{$obj->description}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>                                           
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                      
                                            
                                            <div class="card">
                                                <div class="card-header">
                                                    SEO
                                                </div>
                                                <div class="card-body row">
                                                    <div class="form-group col-md-12">
                                                        <label>Bottom content</label>
                                                        <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{$obj->bottom_description}}</textarea>
                                                    </div>
                                                   
                                                    <div class="form-group col-md-12">
                                                        <label>Browser title</label>
                                                        <input type="text" class="form-control" name="browser_title" id="browser_title" value="{{$obj->browser_title}}">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta Keywords</label>
                                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{$obj->meta_keywords}}</textarea>
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta description</label>
                                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{$obj->meta_description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="card">
                                                <div class="card-header">
                                                    Extra Data
                                                </div>
                                                <div class="card-body row">
                                                    <div class="form-group col-md-12">
                                                        <label>OG Title</label>
                                                        <input type="text" class="form-control" name="og_title" id="og_title" value="{{$obj->og_title}}">
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6">
                                                        <label class="">OG Description</label>
                                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{$obj->og_description}}</textarea>
                                                    </div>
                                                   
                                                    <div class="form-group col-md-6">
                                                        <label class="">Extra Js</label>
                                                        <textarea name="extra_js" class="form-control" rows="3" id="extra_js">{{$obj->extra_js}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
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
                                        </div>    
                                    </div>
                            </form> 

                            @php
                                $attribute_name = App\Models\Attribute::where('product_id',$obj->id)->pluck('name');
                                $attribute_slug = App\Models\Attribute::where('product_id',$obj->id)->pluck('slug');
                                $attribute_id   = App\Models\Attribute::where('product_id',$obj->id)->pluck('id');
                                $attributes = App\Models\Attribute::where('product_id',$obj->id)->select('id','name','slug','priority')->get();
                            @endphp

                            @if($obj->id)
                                <div class="row">
                                    <div class="col-md-8">
                                    <form method="POST" action="{{ route('admin.attribute.create')}}" class="p-t-15" data-validate=true id="AttrtInputFrm">
                                    @csrf    
                        
                                        <div class="card">
                                            <div class="card-header">
                                                Add Attributes
                                            </div>

                                            <div class="card-body row">                                           
                                              <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">

                                              <div class="form-group col-md-6">
                                                <label>Attribute 1</label>
                                                <input type="text" name="attributes[0][name]" class="form-control"  @if(!empty($attribute_name[0]))  value="{{ $attribute_name[0] }}" @endif>
                                                <input type="hidden" name="attributes[0][priority]" value="1" class="form-control" >
                                                <input type="hidden" name="attributes[0][id]"  @if(!empty($attribute_id[0])) value="{{$attribute_id[0]}}" @endif class="form-control" >


                                            </div>
                                                <div class="form-group col-md-6">
                                                    <label>Slug (for url)</label>
                                                    <input type="text" name="attributes[0][slug]" class="form-control" @if(!empty($attribute_slug[0]))  value="{{ $attribute_slug[0] }}"  @endif >
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Attribute 2</label>
                                                    <input type="text" name="attributes[1][name]" class="form-control"  @if(!empty($attribute_name[1])) value="{{ $attribute_name[1] }}" @endif >
                                                    <input type="hidden" name="attributes[1][priority]" value="2" class="form-control" >
                                                    <input type="hidden" name="attributes[1][id]"  @if(!empty($attribute_id[1])) value="{{$attribute_id[1]}}" @endif class="form-control" >

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Slug (for url)</label>
                                                    <input type="text" name="attributes[1][slug]" class="form-control" @if(!empty($attribute_slug[1])) value="{{ $attribute_slug[1] }}"  @endif>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Attribute 3</label>
                                                    <input type="text" name="attributes[2][name]" class="form-control" @if(!empty($attribute_name[2])) value="{{ $attribute_name[2] }}" @endif >
                                                    <input type="hidden" name="attributes[2][priority]" value="3" class="form-control"  >
                                                    <input type="hidden" name="attributes[2][id]"  @if(!empty($attribute_id[2])) value="{{$attribute_id[2]}}" @endif class="form-control" >

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Slug (for url)</label>
                                                    <input type="text" name="attributes[2][slug]" class="form-control" @if(!empty($attribute_slug[2])) value="{{ $attribute_slug[2] }}" @endif >
                                                </div>
                                            
                                                </div>

                                                <div class="card-footer text-muted">
                                                    <button class="btn btn-sm btn-primary float-right" type="submit">Add</button>
                                                </div>
                                        </div>

                                        </form>

                                    </div>
                                </div>
                             @endif

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                List Attributes
                                            </div>
                                            <div class="card-body row">
                                            <table>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Slug</th>
                                                    <th>Priority</th>
                                                    <th>Add Values</th>
                                                </tr>

                                                @foreach($attributes as $item)
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->slug}}</td>
                                                        <td>{{$item->priority}}</td> 
                                                        <td> <a href="{{ route('admin.attribute-values.create',$item->id)}}" class="btn btn-sm btn-primary"> Add </a> </td>
                                                        

                                                    </tr>
                                                @endforeach
                                               
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
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
                    "attributes[0][slug]": {
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
                "attributes[0][slug]": {
                    required: "Slug cannot be blank",
                    remote: "Slug is already in use",
                },
                },
                });
        </script> 
@parent
@endsection

