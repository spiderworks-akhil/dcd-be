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
                                            <h4 class="page-title">Edit Job</h4>
                                        @else
                                            <h4 class="page-title">Create new Job</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Jobs</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Job</li>
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
                                                    Basic Details
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <div class="row m-0">
                                                            <div class="form-group col-md-6">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control @if(!$obj->id) copy-name @endif" value="{{$obj->name}}" required="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Job Code</label>
                                                                <input type="text" name="job_code" class="form-control" value="{{$obj->job_code}}" required="">
                                                            </div>
                                                            @fieldshow(jobs-title)
                                                            <div class="form-group col-md-6">
                                                                <label>Heading</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}" required="">
                                                            </div>
                                                            @endfieldshow
                                                            <div class="form-group col-md-6">
                                                                <label class="">Slug (for url)</label>
                                                                <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                                                <small class="text-muted">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                                            </div>
                                                            @fieldshow(jobs-departments_id)
                                                            <div class="form-group col-md-6">
                                                                <label class="">Department</label>
                                                                <select name="departments_id" class="w-100 js-location-tags form-control">
                                                                    <option value="">Select Department</option>
                                                                    @foreach($departments as $department)
                                                                        <option value="{{$department->id}}" @if($obj->departments_id == $department->id) selected="selected" @endif>{{$department->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(jobs-last_application_date)
                                                            <div class="form-group col-md-6">
                                                                <label>Last date of Application</label>
                                                                <input type="text" name="last_application_date" class="form-control datepicker" @if($obj->last_application_date) value="{{date('d-m-Y', strtotime($obj->last_application_date))}}" @endif id="last_application_date">
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(jobs-short_description)
                                                            <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>
                                                            @endfieldshow
                                                        </div>
                                                    </div>                                           
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                            @fieldshow(jobs-content)
                                            <div class="card">
                                                <div class="card-header">
                                                    Content
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(jobs-responsibilities)
                                                    <div class="form-group col-md-12">
                                                        <label>Responsibilities</label>
                                                        <textarea name="responsibilities" class="form-control editor" id="responsibilities">{{$obj->responsibilities}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-eligibility)
                                                    <div class="form-group col-md-12">
                                                        <label>Eligibility</label>
                                                        <textarea name="eligibility" class="form-control editor" id="eligibility">{{$obj->eligibility}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-skills)
                                                    <div class="form-group col-md-12">
                                                        <label>Skills Required</label>
                                                        <textarea name="skills" class="form-control editor" id="skills">{{$obj->skills}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-how_to_aply)
                                                    <div class="form-group col-md-12">
                                                        <label>How to Apply</label>
                                                        <textarea name="how_to_aply" class="form-control editor" id="how_to_aply">{{$obj->how_to_aply}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(jobs-seo)
                                            <div class="card">
                                                <div class="card-header">
                                                    SEO
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(jobs-bottom_description)
                                                    <div class="form-group col-md-12">
                                                        <label>Bottom content</label>
                                                        <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{$obj->bottom_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-browser_title)
                                                    <div class="form-group col-md-12">
                                                        <label>Browser title</label>
                                                        <input type="text" class="form-control" name="browser_title" id="browser_title" value="{{$obj->browser_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-meta_keywords)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta Keywords</label>
                                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{$obj->meta_keywords}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-meta_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta description</label>
                                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{$obj->meta_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(jobs-extra_data)
                                            <div class="card">
                                                <div class="card-header">
                                                    Extra Data
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(jobs-og_title)
                                                    <div class="form-group col-md-12">
                                                        <label>OG Title</label>
                                                        <input type="text" class="form-control" name="og_title" id="og_title" value="{{$obj->og_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-og_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">OG Description</label>
                                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{$obj->og_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(jobs-extra_js)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Extra Js</label>
                                                        <textarea name="extra_js" class="form-control" rows="3" id="extra_js">{{$obj->extra_js}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
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
                                                            @fieldshow(jobs-is_featured)
                                                            <div class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_featured" name="is_featured" @if($obj->is_featured == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_featured">Featured</label>
                                                            </div>
                                                            @endfieldshow
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
                                            @fieldshow(jobs-priority)
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
                                            @endfieldshow
                                            @fieldshow(jobs-featured_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Featured Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->featured_image, 'title'=>'Featured Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'featured_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(jobs-banner_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Banner Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(jobs-og_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    OG Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->og_image, 'title'=>'OG Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'og_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
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
                        table: 'careers',
                    }
                  }
                },
                job_code: {
                  required: true,
                  remote: {
                      url: "{{route('admin.jobs.unique-code')}}",
                      data: {
                        id: function() {
                          return $( "#inputId" ).val();
                        },
                    }
                  }
                }
              },
              messages: {
                "name": "Position name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
                job_code: {
                  required: "Job code cannot be blank",
                  remote: "Job code is already in use",
                },
              },
            });

        $(function(){
            $(".js-location-tags").select2({
              tags: true
            });
        })
    </script>
@parent
@endsection