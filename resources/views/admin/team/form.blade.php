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
                                            <h4 class="page-title">Edit Team Member</h4>
                                        @else
                                            <h4 class="page-title">Create new Team Member</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Team Members</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Team Member</li>
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
                                                            @fieldshow(team-title)
                                                            <div class="form-group col-md-6">
                                                                <label>Heading</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}" required="">
                                                            </div>
                                                            @endfieldshow
                                                            <div class="form-group col-md-12">
                                                                <label class="">Slug (for url)</label>
                                                                <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                                                <small class="text-muted">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                                            </div>
                                                            @fieldshow(team-department_id)
                                                            <div class="form-group col-md-6">
                                                                <label class="">Department</label>
                                                                <select name="department_id" class="w-100 js-location-tags form-control">
                                                                    <option value="">Select Department</option>
                                                                    @foreach($departments as $department)
                                                                        <option value="{{$department->id}}" @if($obj->department_id == $department->id) selected="selected" @endif>{{$department->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(team-designation)
                                                            <div class="form-group col-md-6">
                                                                <label>Designation</label>
                                                                <input type="text" name="designation" class="form-control" value="{{$obj->designation}}" id="designation">
                                                            </div>
                                                            @endfieldshow
                                                            {{-- @fieldshow(team-short_description)
                                                            <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>
                                                            @endfieldshow
                                                            @fieldshow(team-content)
                                                            <div class="form-group col-md-12">
                                                                <label>Content</label>
                                                                <textarea name="content" class="form-control editor" id="content">{{$obj->content}}</textarea>
                                                            </div>
                                                            @endfieldshow --}}
                                                        </div>
                                                    </div>                                           
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                            @fieldshow(team-seo)
                                            <div class="card">
                                                <div class="card-header">
                                                    SEO
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(team-bottom_description)
                                                    <div class="form-group col-md-12">
                                                        <label>Bottom content</label>
                                                        <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{$obj->bottom_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-browser_title)
                                                    <div class="form-group col-md-12">
                                                        <label>Browser title</label>
                                                        <input type="text" class="form-control" name="browser_title" id="browser_title" value="{{$obj->browser_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-meta_keywords)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta Keywords</label>
                                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{$obj->meta_keywords}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-meta_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">Meta description</label>
                                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{$obj->meta_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(team-extra_data)
                                            <div class="card">
                                                <div class="card-header">
                                                    Extra Data
                                                </div>
                                                <div class="card-body row">
                                                    @fieldshow(team-og_title)
                                                    <div class="form-group col-md-12">
                                                        <label>OG Title</label>
                                                        <input type="text" class="form-control" name="og_title" id="og_title" value="{{$obj->og_title}}">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-og_description)
                                                    <div class="form-group col-md-6">
                                                        <label class="">OG Description</label>
                                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{$obj->og_description}}</textarea>
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-extra_js)
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
                                                            @fieldshow(team-is_featured)
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
                                            </div>
                                            @endif
                                            @fieldshow(team-priority)
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
                                            @fieldshow(team-social_media_links)
                                            <div class="card">
                                                <div class="card-header">
                                                    Social Media Links
                                                </div>
                                                <div class="card-body">
                                                    @fieldshow(team-facebook_link)
                                                    <div class="form-group col-md-12">
                                                        <label>Facebook</label>
                                                        <input type="text" name="facebook_link" class="form-control" value="{{$obj->facebook_link}}" id="facebook_link">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-twitter_link)
                                                    <div class="form-group col-md-12">
                                                        <label>X (Twitter)</label>
                                                        <input type="text" name="twitter_link" class="form-control" value="{{$obj->twitter_link}}" id="twitter_link">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-instagram_link)
                                                    <div class="form-group col-md-12">
                                                        <label>Instagram</label>
                                                        <input type="text" name="instagram_link" class="form-control" value="{{$obj->instagram_link}}" id="instagram_link">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-linkedin_link)
                                                    <div class="form-group col-md-12">
                                                        <label>LinkedIn</label>
                                                        <input type="text" name="linkedin_link" class="form-control" value="{{$obj->linkedin_link}}" id="linkedin_link">
                                                    </div>
                                                    @endfieldshow
                                                    @fieldshow(team-youtube_link)
                                                    <div class="form-group col-md-12">
                                                        <label>Youtube</label>
                                                        <input type="text" name="youtube_link" class="form-control" value="{{$obj->youtube_link}}" id="youtube_link">
                                                    </div>
                                                    @endfieldshow
                                                </div>
                                            </div>
                                            @endfieldshow
                                            @fieldshow(team-featured_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Featured Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->featured_image, 'title'=>'Featured Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'featured_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow
                                            {{-- @fieldshow(team-banner_image_id)
                                            <div class="card">
                                                <div class="card-header">
                                                    Banner Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                </div>
                                            </div>
                                            @endfieldshow --}}
                                            @fieldshow(team-og_image_id)
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
                        type: function() {
                          return "{{ $obj->type ?? 'en' }}";
                        },
                        table: 'team',
                    }
                  }
                }
              },
              messages: {
                "name": "Member name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });

        $(function(){
            $(".js-location-tags").select2({
              tags: true
            });
        })
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

        var url = "{{ route('admin.team.get-type') }}?type=" + selectedValue + "&slug=" + slug + "&name=" + name + "&currentType=" + currentType;

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