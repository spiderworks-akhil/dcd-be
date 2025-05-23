@extends('admin._layouts.fileupload')

@section('header')
    @parent
    <link href="{{asset('admin/plugins/jquery-datetimepicker/css/jquery.datetimepicker.css')}}" rel="stylesheet" type="text/css"  />

    <style type="text/css">
        #add-new-image-container {
          color: black;
          border: 1px solid #e3ebf6;
          height: 260px;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        #add-new-image-content {
            text-align: center;
            flex: 0 0 120px;
        }

        #add-new-image-content i{
            font-size: 40px;
        }

        .add-multiple-image .media-container {
              color: black;
              border: 1px solid #e3ebf6;
              height: 260px;
              display: flex;
              justify-content: center;
              align-items: center;
        }

        .add-multiple-image .media-content {
                text-align: center;
                flex: 0 0 120px;
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
                                            <h4 class="page-title">Edit Event</h4>
                                        @else
                                            <h4 class="page-title">Create new Event</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Events</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Event</li>
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
                                                                <label class="">Slug (for url)</label>
                                                                <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                                                <small class="text-muted">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                                            </div>
                                                            @fieldshow(events-title)
                                                            <div class="form-group col-md-12">
                                                                <label>Heading</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}" required="">
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(events-start_time)
                                                            <div class="form-group col-md-4">
                                                                <label>Starts On</label>
                                                                <input type="text" name="start_time" class="form-control datetimepicker" value="@if($obj->start_time) {{date('d/m/Y H:i', strtotime($obj->start_time))}} @endif" >
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(events-end_time)
                                                            <div class="form-group col-md-4">
                                                                <label>Ends On</label>
                                                                <input type="text" name="end_time" class="form-control datetimepicker" value="@if($obj->end_time) {{date('d/m/Y H:i', strtotime($obj->end_time))}} @endif">
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(events-fees)
                                                            <div class="form-group col-md-4">
                                                                <label>Fees</label>
                                                                <input type="text" name="fees" class="form-control" value="{{$obj->fees}}">
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(events-location)
                                                            <div class="form-group col-md-12">
                                                                <label>Location / Address</label>
                                                                <textarea name="location" class="form-control" rows="2" id="location">{{$obj->location}}</textarea>
                                                            </div>
                                                            @endfieldshow
                                                            <div class="form-group col-md-6">
                                                                <label>Result Text</label>
                                                                <input type="text" name="result" class="form-control" value="{{$obj->result}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Result Link</label>
                                                                <input type="text" name="result_link" class="form-control" value="{{$obj->result_link}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Website Link</label>
                                                                <input type="text" name="website_link" class="form-control" value="{{$obj->website_link}}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Website Link Text</label>
                                                                <input type="text" name="website_link_text" class="form-control" value="{{$obj->website_link_text}}">
                                                            </div>
                                                            @fieldshow(events-short_description)
                                                            <div class="form-group col-md-6">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(events-content)
                                                            <div class="form-group col-md-12">
                                                                <label>Content</label>
                                                                <textarea name="content" class="form-control editor" id="content">{{$obj->content}}</textarea>
                                                            </div>
                                                            @endfieldshow
                                                        </div>
                                                    </div>                                           
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                            <div class="card">
                                                <div class="card-header">
                                                    Schedule
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Is Scheduled?</label>
                                                        <select name="is_scheduled" class="form-control">
                                                            <option value="1" @if($obj->is_scheduled == 1) selected @endif>Yes</option>
                                                            <option value="0" @if($obj->is_scheduled == 0) selected @endif>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group scheduled-fields" @if($obj->is_scheduled != 1) style="display: none;" @endif>
                                                       <div id="schedule-container">
                                                            @if(isset($obj->schedules) && count($obj->schedules) > 0)
                                                                @foreach($obj->schedules as $key => $schedule)
                                                                    <div class="schedule-item row">
                                                                        <div class="col-md-12">
                                                                            <label>Schedule Title</label>
                                                                            <input type="text" name="event_schedules[{{$key}}][title]" class="form-control" value="{{$schedule['title'] ?? ''}}">
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label>Schedule Time</label>
                                                                            <input type="text" name="event_schedules[{{$key}}][time]" class="form-control datetimepicker" value="{{$schedule['time'] ?? ''}}">
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <label>Schedule Priority</label>
                                                                            <input type="number" name="event_schedules[{{$key}}][priority]" class="form-control" value="{{$schedule['priority'] ?? ''}}">
                                                                        </div>

                                                                        <div class="col-md-12 text-right mt-2">
                                                                            <button type="button" class="btn btn-danger remove-schedule">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <button type="button" id="add-schedule" class="btn btn-primary mt-3">Add Schedule</button>

                                                    </div>

                                                    @if($obj->is_scheduled == 0)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Volunteer Ad Image
                                                        </div>
                                                        <div class="card-body">
                                                            @include('admin.media.set_file', ['file'=>$obj->volunteer_ad_image, 'title'=>'Volunteer Ad Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'volunteer_ad_image_id'])
                                                        </div>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                            
                                            @fieldshow(events-media)
                                            <div class="card">
                                                <div class="card-header">
                                                    Media
                                                </div>
                                                <div class="card-body">
                                                    <div class="row add-multiple-image">
                                                        @if(count($obj->gallery)>0)
                                                            @php
                                                                $media_type = "Image-Video";
                                                            @endphp
                                                            @foreach($obj->gallery as $key=>$item)
                                                                @include('admin.events.media', ['item'=>$item, 'type'=>$media_type])
                                                            @endforeach
                                                        @endif
                                                        <div class="col-md-4 mb-2" id="add-new-image-wrap">
                                                            <div style="display:none" id="image-clone-holder">
                                                                @include('admin.media.set_file', ['file'=>null, 'title'=>'Event Media', 'popup_type'=>'single_image', 'type'=>'Image-Video', 'holder_attr'=>'event_medias[]', 'id'=>'id_holder'])
                                                            </div>
                                                            <div id="add-new-image-container">
                                                              <div id="add-new-image-content">
                                                                <a href="javascript:void(0)" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fas fa-plus-circle text-primary" ></i></a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" id="add-new-image" href="javascript:void(0)">Upload from local machine</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#youtubeModal">Add youtube link</a>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(events-seo)
                                            <div class="card">
                                                <div class="card-header">
                                                    SEO
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(events-bottom_description)
                                                    <div class="form-group col-md-12">
                                                        <label>Bottom content</label>
                                                        <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{$obj->bottom_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(events-browser_title)
                                                    <div class="form-group col-md-12">
                                                        <label>Browser title</label>
                                                        <input type="text" class="form-control" name="browser_title" id="browser_title" value="{{$obj->browser_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(events-meta_keywords)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta Keywords</label>
                                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{$obj->meta_keywords}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(events-meta_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta description</label>
                                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{$obj->meta_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(events-extra_data)
                                            <div class="card">
                                                <div class="card-header">
                                                    Extra Data
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(events-og_title)
                                                    <div class="form-group col-md-12">
                                                        <label>OG Title</label>
                                                        <input type="text" class="form-control" name="og_title" id="og_title" value="{{$obj->og_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(events-og_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">OG Description</label>
                                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{$obj->og_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(events-extra_js)
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
                                                            @fieldshow(events-is_featured)
                                                            <div class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_featured" name="is_featured" @if($obj->is_featured == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_featured">Featured</label>
                                                            </div>
                                                            @endfieldshow
                                                            <div style="margin-right: 5px;" class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_must_attend" name="is_must_attend" @if($obj->is_must_attend == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_must_attend">Must Attend</label>
                                                            </div>
                                                            <div style="margin-right: 5px;" class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_featured_in_banner" name="is_featured_in_banner" @if($obj->is_featured_in_banner == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_featured_in_banner">Featured In Banner</label>
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
                                            
                                            @if ($obj->id)

                                            <div class="card">
                                                <div class="card-header">
                                                    Available Languages
                                                </div>
                                                    <div class="card-body">
                                                        <div class="row m-0">
                                                                <div class="form-group w-100 mb-2">
                                                                    <div class="card-footer text-muted">
                                                                        <select name="type" class="form-control" id="languageSelect">
                                                                            <option value="en" @if ($obj->type == 'en') selected @endif>English</option>
                                                                            <option value="ar" @if ($obj->type == 'ar') selected @endif>Arabic</option>
                                                                            <option value="en_draft" @if ($obj->type == 'en_draft') selected @endif>English Draft</option>
                                                                            <option value="ar_draft" @if ($obj->type == 'ar_draft') selected @endif>Arabic Draft</option>
                                                                        </select>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-primary float-right" type="button" id="submitBtn">Go</button>
                                                                </div>
                                                        </div>
                                                    </div>
                                            @endif
                                            @fieldshow(events-category_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Category
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group col-md-12">
                                                        <label class="">Category</label>
                                                        <select name="category_id" class="w-100 webadmin-select2-input" data-placeholder="Select a Category">
                                                            <option value="0">-- Select --</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}" @if($category->id == $obj->category_id) selected="selected" @endif>{{$category->name}}</option>
                                                                @include('admin._partials.category', ['category'=>$category, 'depth'=>1, 'selected'=>$obj->category_id])
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(events-priority)
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
                                            @fieldshow(events-faq)
                                                @if($obj->id)
                                                <div class="card">
                                                    <div class="card-header">
                                                        FAQ
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <a href="{{route('admin.faq.index', [$obj->id, 'Event'])}}" class="webadmin-open-ajax-popup btn btn-sm btn-warning" title="SET FAQ" data-popup-size="large">@if(count($obj->faq)>0) Update FAQ @else Add FAQ @endif</a>
                                                    </div>
                                                </div>
                                                @endif
                                            @endfieldshow
                                            @fieldshow(events-featured_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Featured Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->featured_image, 'title'=>'Featured Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'featured_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
                                            <div class="card">
                                                <div class="card-header">
                                                    Logo Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->logo_image, 'title'=>'Logo Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'logo_image_id'])
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    Video
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->video, 'title'=>'Video', 'popup_type'=>'single_video', 'type'=>'Video', 'holder_attr'=>'video_id'])
                                                </div>
                                            </div>

                                            @fieldshow(events-banner_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Banner Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(events-og_image_id)
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
                <!-- Modal -->
<div class="modal fade" id="youtubeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Youtube Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <div class="form-group">
            <label for="youTubeUrl">Youtube Url</label>
            <input type="orl" class="form-control" id="youTubeUrl">
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="youTubeUrlAdd">Add</button>
      </div>
    </div>
  </div>
</div>
                @include('admin._partials.footer')
            </div>
            <!-- end page content -->
@endsection
@section('footer')
<script src="{{asset('admin/plugins/jquery-datetimepicker/js/jquery.datetimepicker.full.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        $(function(){
            $('.datetimepicker').datetimepicker({
                format: 'd/m/Y H:i',
                formatDate: 'd/m/Y'
            });
        })

        var idInc = "{{count($obj->gallery)}}";
        $(function(){
            $(document).on('click', '#add-new-image', function(){
                var html = $('#image-clone-holder').html();
                var content = '<div class="col-md-4 mb-2">'+html+'</div>';

                var img_id = 'project_image_'+idInc;
                content = content.replaceAll("id_holder", img_id);
                $(content).insertBefore('#add-new-image-wrap');
                idInc++;
            })

            $(document).on('click', '#youTubeUrlAdd', function(){
                var url = $('#youTubeUrl').val();
                if (url != undefined || url != '') {        
                    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                    var match = url.match(regExp);
                    if (match && match[2].length == 11) {
                        var thumb = Youtube.thumb(url, 'big');
                        var html = '<div class="col-md-4 mb-2 youtube-item"><div id="project_image_'+idInc+'"><input type="hidden" name="youtube_url[]" value="https://www.youtube.com/embed/' + match[2]+'"><input type="hidden" name="youtube_preview[]" value="'+thumb+'"><div class="thumbnail text-center"><div class="card"><img src="'+thumb+'" class="w-100"><div class="card-body"><p class="card-text">Embed Url: https://www.youtube.com/embed/' + match[2]+'</p><hr><div class="text-center"><a href="javascript:void(0);" class="youtube-remove ml-2"><i class="fas fa-trash"></i></a></div></div></div></div></div></div></div>';                    $('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
                        $(html).insertBefore('#add-new-image-wrap');
                        idInc++;
                        $('#youTubeUrl').val('');
                        $('#youtubeModal').modal('hide')
                    } else {
                        $.alert('Please enter a valid youtube url');
                        // Do anything for not being valid
                    }
                }
                else
                {
                    $.alert('Please enter a youtube url');
                }
            });

            $(document).on('click', '.gallery-item-remove', function(e){
                e.preventDefault();
                var that = $(this);
                var delete_url = that.attr('href');
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete this?',
                    buttons: {
                        confirm:{
                            btnClass: 'btn-blue',
                            action: function(){
                                that.parents('.gallery-item').remove();
                                $.get(delete_url);
                            }
                        },
                        cancel: function () {
                        },
                    }
                });
            })

            $(document).on('click', '#gallery-media-update-form', function(){
                if($('#galleryMediaUpdateForm #gallery-youtube-url').length){
                    if($('#galleryMediaUpdateForm #gallery-youtube-url').val() == ""){
                        miniweb_alert('Alert!', 'Youtube url cannot be null');
                        return;
                    }
                }
                var postData = new FormData( $('#galleryMediaUpdateForm')[0] );
                $.ajax({
                    url : "{{route('admin.events.media.update')}}",
                    type: "POST",
                    data : postData,
                    processData: false,
                    contentType: false,
                    success:function(response, textStatus, jqXHR){
                        if(typeof response.success != "undefined"){
                            $('#gallery-item-'+response.id).replaceWith(response.html);
                            miniweb_alert('Success!', 'Gallery successfully updated.');
                            $(".jconfirm-closeIcon").trigger("click");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        //if fails     
                    }
                });
            })


            
        })
        
        var validator = $('#InputFrm').validate({
            ignore: [],
            rules: {
                "name": "required",
                "title": "required",
                slug: {
                  required: true,
                  remote: {
                      url: "{{route('admin.unique-slug')}}",
                      data: {
                        id: function() {
                          return $( "#inputId" ).val();
                        },
                        type: function() {
                          return "{{$obj->type??'en'}}";
                        },
                        table: 'events',
                    }
                  }
                },
              },
              messages: {
                "name": "Blog name cannot be blank",
                "title": "Blog heading cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });

            $(document).on('change', 'select[name="is_scheduled"]', function() {
                if ($(this).val() == "1") {
                    $('.scheduled-fields').show();
                } else {
                    $('.scheduled-fields').hide();
                }
            });
    </script>
    <script>
    $(document).ready(function() {
        let scheduleIndex = {{ isset($obj->schedules) ? count($obj->schedules) : 0 }};

        $('#add-schedule').on('click', function() {
            const scheduleHtml = `
                <div class="schedule-item mb-3 row">
                    <div class="col-md-12">
                        <label>Schedule Title</label>
                        <input type="text" name="event_schedules[${scheduleIndex}][title]" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Schedule Time</label>
                        <input type="text" name="event_schedules[${scheduleIndex}][time]" class="form-control datetimepicker">
                    </div>

                    <div class="col-md-6">
                        <label>Schedule Priority</label>
                        <input type="number" name="event_schedules[${scheduleIndex}][priority]" class="form-control">
                    </div>

                    <div class="col-md-12 text-right mt-2">
                        <button type="button" class="btn btn-danger remove-schedule">Remove</button>
                    </div>
                </div>
            `;

            $('#schedule-container').append(scheduleHtml);
            scheduleIndex++;
        });

        $(document).on('click', '.remove-schedule', function() {
            $(this).closest('.schedule-item').remove();
        });
    });
</script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
    var selectedValue = document.getElementById('languageSelect').value;
    var slug = @json($obj->slug);
    var name = @json($obj->name);
    var currentType = @json($obj->type);

    const swapConditions = [
    ["en_draft", "en"],
    ["en", "en_draft"],
    ["ar_draft", "ar"],
    ["ar", "ar_draft"]
    ];

    if (swapConditions.some(([type, value]) => currentType === type && selectedValue === value)) {
        ProcessConfirm("If you click submit, the contents of both pages will swap. Do you want to continue?")
    } else {
            ProcessContent(slug, name, currentType, selectedValue);
            return;
    }


    function ProcessConfirm(content){
        $.confirm({
                    title: 'Warning',
                    content: content,
                    buttons: {
                        confirm: function() {
                            ProcessContent();
                        },
                        cancel: function() {
                            return;
                        }
                    }
                });
    }

    function ProcessContent(){

        var url = "{{ route('admin.events.get-type') }}?type=" + selectedValue + "&slug=" + slug + "&name=" + name + "&currentType=" + currentType;

        fetch(url, {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Request failed');
            }
        })
        .then(data => {
            if (data.redirect_url) {
                window.location.href = data.redirect_url;
            } else {
                alert('No redirect URL found');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error sending data.");
        });
    }

    });

</script>

@parent
@endsection