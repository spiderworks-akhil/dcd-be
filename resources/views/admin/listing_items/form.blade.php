@extends('admin._layouts.fileupload')

@section('header')
    @parent
    <style type="text/css">
        #video-div p a{
            border: 1px solid #1761fd;
            padding: 10px 20px;
            background: #1761fd;
            color: #fff;
        }
    </style>
@endsection

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
                                            <h4 class="page-title">Edit Listing Item</h4>
                                        @else
                                            <h4 class="page-title">Create new Listing Item</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{route('admin.listings.index')}}">Listings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index', [$listing->id]) }}">All Listing Items of {{$listing->name}}</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Listig Item</li>
                                        </ol>
                                    </div><!--end col-->
                                    @if(auth()->user()->can($permissions['create']))
                                    <div class="col-auto align-self-center">
                                        <a class=" btn btn-sm btn-primary" href="{{route($route.'.create', [$listing->id])}}" role="button"><i class="fas fa-plus mr-2"></i>Create New</a>
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
                                    <input type="hidden" name="listing_id" value="{{$listing->id}}" />
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    Basic Details
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="row m-0">
                                                            @if($listing->title == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Title</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}">
                                                            </div>
                                                            @endif
                                                            @if($listing->short_title == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Short Title</label>
                                                                <input type="text" name="short_title" class="form-control" value="{{$obj->short_title}}">
                                                            </div>
                                                            @endif
                                                            @if($listing->icon == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Icon</label>
                                                                <textarea class="form-control" name="icon">{{$obj->icon}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($listing->image == "Yes")
                                                            <div class="form-group col-md-12" >
                                                                <label>Image</label>
                                                                @include('admin.media.set_file', ['file'=>$obj->media, 'title'=>'Media Files', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'media_id'])
                                                            </div>
                                                            @endif
                                                            @if($listing->alt_image == "Yes")
                                                            <div class="form-group col-md-12" >
                                                                <label>Alt Image</label>
                                                                @include('admin.media.set_file', ['file'=>$obj->altImage, 'title'=>'Media Files', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'alt_image_id'])
                                                            </div>
                                                            @endif
                                                            @if($listing->banner == "Yes")
                                                            <div class="form-group col-md-12" >
                                                                <label>Banner Image</label>
                                                                @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Media Files', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                            </div>
                                                            @endif
                                                            @if($listing->logo == "Yes")
                                                            <div class="form-group col-md-12" >
                                                                <label>Logo</label>
                                                                @include('admin.media.set_file', ['file'=>$obj->media, 'title'=>'Media Files', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'logo_id'])
                                                            </div>
                                                            @endif

                                                            @if($listing->short_description == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea class="form-control" name="short_description">{{$obj->short_description}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($listing->detailed_description == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Extra Description</label>
                                                                <textarea class="form-control editor" name="extra_description">{{$obj->extra_description}}</textarea>
                                                            </div>
                                                            @endif

                                                            @if($listing->extra_description == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Detailed Description</label>
                                                                <textarea class="form-control editor" name="detailed_description">{{$obj->detailed_description}}</textarea>
                                                            </div>
                                                            @endif

                                                            @if($listing->url_title == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Url Title</label>
                                                                <input type="text" name="url_title" class="form-control" value="{{$obj->url_title}}">

                                                            </div>
                                                            @endif

                                                            @if($listing->url == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Url</label>
                                                                <input type="text" name="url" class="form-control" value="{{$obj->url}}">
                                                            </div>
                                                            @endif

                                                            @if($listing->date == "Yes")
                                                            <div class="form-group col-md-12">
                                                                <label>Date</label>
                                                                <input type="date" name="date" class="form-control" value="{{$obj->date}}">

                                                            </div>
                                                            @endif

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

                                                        @if($listing->author_id == "Yes")
                                                        <div class="form-group w-100  mb-1">

                                                            <label>Author</label>
                                                            <select name="author_id" class="w-100 webadmin-select2-input" data-select2-url="{{route('admin.select2.authors')}}" data-placeholder="Select Author">
                                                                @if($obj->id && $obj->author)
                                                                    <option value="{{$obj->author->id}}" selected="selected">{{$obj->author->name}}</option>
                                                                @endif
                                                            </select>
                                                        </div>

                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <!-- <a href="" class="btn btn-sm btn-soft-primary">Preview</a> -->
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

@parent
@endsection
