@extends('admin._layouts.fileupload')
@section('header')
    @parent
    <link href="{{ asset('admin/plugins/jquery-datetimepicker/css/jquery.datetimepicker.css') }}" rel="stylesheet"
        type="text/css" />
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
                                @if ($obj->id)
                                    <h4 class="page-title">Edit News</h4>
                                @else
                                    <h4 class="page-title">Create new News</h4>
                                @endif
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">All News</a></li>
                                    <li class="breadcrumb-item active">
                                        @if ($obj->id)
                                            Edit
                                        @else
                                            Create new
                                        @endif News
                                    </li>
                                </ol>
                            </div><!--end col-->
                            @if (auth()->user()->can($permissions['create']))
                                <div class="col-auto align-self-center">
                                    <a class=" btn btn-sm btn-primary" href="{{ route($route . '.create') }}"
                                        role="button"><i class="fas fa-plus mr-2"></i>Create New</a>
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
                    @if ($obj->id)
                        <form method="POST" action="{{ route($route . '.update') }}" class="p-t-15" id="InputFrm"
                            data-validate=true data-copy-mode="name-to-slug-only">
                        @else
                            <form method="POST" action="{{ route($route . '.store') }}" class="p-t-15" id="InputFrm"
                                data-validate=true data-copy-mode="name-to-slug-only">
                    @endif
                    @csrf
                    <input type="hidden" name="id"
                        @if ($obj->id) value="{{ encrypt($obj->id) }}" @endif id="inputId">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    Basic Details
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="row m-0">
                                            
                                            <div class="form-group col-md-12">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $obj->title }}" required="">
                                            </div>

                                            {{-- <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Title</label>
                                                                <input type="text" name="news_title" class="form-control text-direction"  value="{{$obj->news_title}}">
                                                            </div> --}}
                                            <div class="form-group col-md-12">
                                                <label>Description</label>
                                                
                                                <textarea name="content" id="content"  class="form-control text-direction editor" rows="2" required>{{ $obj->content }}</textarea>
                                            </div>

                                            {{-- <div class="form-group col-md-12">
                                                                <label> Iframe Code</label>
                                                                <textarea name="iframe_code" class="form-control" rows="2">{{$obj->iframe_code}}</textarea>
                                                            </div> --}}

                                            {{-- <div class="form-group col-md-12">
                                                                <label>Bottom content</label>
                                                                <textarea name="bottom_content" class="form-control editor" rows="2">{{$obj->bottom_content}}</textarea>
                                                            </div> --}}

                                        </div>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->

                            <div class="card">
                                <div class="card-header">
                                    SEO
                                </div>
                                <div class="card-body row">

                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        {{-- <input type="text" name="name" class="form-control @if (!$obj->id) copy-name @endif"  value="{{ $obj->name }}" required  @if($obj->status == 1 && $roleName != 'Admin') readonly @endif> --}}
                                        <input type="text" name="name" class="form-control" value="{{ $obj->name }}" required  @if (($roleName != 'Admin') && $obj->id )readonly @endif >

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Slug (for url)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ $obj->slug }}" id="slug"
                                            @if (($roleName != 'Admin') && $obj->id )readonly @endif>
                                        <small class="text-muted">
                                            The “slug” is the URL-friendly version of the name. It is usually all
                                            lowercase and contains only letters, numbers, and hyphens.
                                        </small>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label>Bottom content</label>
                                        <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{ $obj->bottom_description }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Browser title</label>
                                        <input type="text" class="form-control" name="browser_title" id="browser_title"
                                            value="{{ $obj->browser_title }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{ $obj->meta_keywords }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="">Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{ $obj->meta_description }}</textarea>
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
                                        <input type="text" class="form-control" name="og_title" id="og_title"
                                            value="{{ $obj->og_title }}">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label class="">OG Description</label>
                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{ $obj->og_description }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="">Extra Js</label>
                                        <textarea name="extra_js" class="form-control" rows="3" id="extra_js">{{ $obj->extra_js }}</textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4  publish-cntr">

                           @if ($obj->id)
                                <div class="card">
                                    <div class="card-header ">

                                        @if ($obj->id)

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <a href="https://dcd.org.ae/{{ $obj->type }}/news/{{ $obj->slug }}"
                                                        class="btn btn-success btn-sm mr-2" title="View"
                                                        target="_blank">
                                                        Preview <i data-feather="eye"></i>
                                                    </a>
                                                </div>

                                                    @php
                                                        $type = $obj->type;

                                                        // Check if the draft has a published version with status 0 (unpublished)
                                                         $news_published = false;

                                                        // Determine base type for checking published content
                                                        $base_type = $type;
                                                        if ($type == 'en_draft' || $type == 'ar_draft') {
                                                            $base_type = str_replace('_draft', '', $type); // remove _draft
                                                        }

                                                        // Check if published news exists
                                                        $news_published = App\Models\News::where('slug', $obj->slug)
                                                            ->where('type', $base_type) 
                                                            ->where('status', 0)       
                                                            ->whereNull('deleted_at')
                                                            ->exists();
                                                        // Determine final publication label
                                                        $publication_label = '';
                                                        if(isset($approval_notification->status)){
                                                            if($approval_notification->status == 'approved' && $news_published){
                                                                $publication_label = 'Unpublished ⚠️';
                                                            } elseif($approval_notification->status == 'approved') {
                                                                $publication_label = 'Approved ✅';
                                                            } elseif($approval_notification->status == 'rejected') {
                                                                $publication_label = 'Rejected ❌';
                                                            } elseif($approval_notification->status == 'pending') {
                                                                $publication_label = 'Waiting for approval ⏳';
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                @if ($roleName != 'Admin' && $obj->type == "en_draft" || $obj->type == "ar_draft" )

                                                   <div class="col-md-6">
                                                        @if ($approval_notification)
                                                            @if ($approval_notification->status === 'approved' && $news_published)
                                                                <!-- Approved: show send again button -->
                                                                <button type="button" class="btn btn-primary btn-sm skip-dirty-check"
                                                                    onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','News')">
                                                                    Send for Approval
                                                                </button>

                                                            @elseif($approval_notification->status === 'rejected')
                                                                <!-- Rejected: allow send again -->
                                                                <button type="button" class="btn btn-primary btn-sm skip-dirty-check"
                                                                    onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','News')">
                                                                    Send for Approval
                                                                </button>

                                                            @elseif($approval_notification->status === "pending" && $approval_notification->email_sent == 1)
                                                                <!-- Pending: disable button -->
                                                                <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                                    Email Sent
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- No approval record yet: show send button -->
                                                            <button type="button" class="btn btn-primary btn-sm skip-dirty-check"
                                                                onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','News')">
                                                                Send for Approval
                                                            </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="text-left">
                                                        @if($approval_notification && $approval_notification->status != null)
                                                            <div class="p-2 border rounded">
                                                                <span class="badge 
                                                                    @if($publication_label == 'Approved ✅') badge-success
                                                                    @elseif($publication_label == 'Rejected ❌') badge-danger
                                                                    @elseif($publication_label == 'Waiting for approval ⏳') badge-warning
                                                                    @elseif($publication_label == 'Unpublished ⚠️') badge-secondary
                                                                    @endif
                                                                ">
                                                                    {{ $publication_label }}
                                                                </span>

                                                                <p class="mt-1 mb-0"><strong>Remarks:</strong>
                                                                    {{ $approval_notification->remarks ?? 'No remarks provided' }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                            </div>
                                        @endif


                                        <div>


                                        </div>


                                    </div>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <span>Publish</span>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="row m-0">

                                        <div class="form-group col-md-12">
                                            <label>Published On</label>
                                            <input type="text" name="published_on" class="form-control datetimepicker"
                                                value="@if ($obj->published_on) {{ date('d/m/Y H:i', strtotime($obj->published_on)) }} @endif">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Published By</label>
                                            <select name="published_by_author_id" class="w-100 webadmin-select2-input"
                                                data-select2-url="{{ route('admin.select2.authors') }}"
                                                data-placeholder="Select Author">
                                                @if ($obj->id && $obj->author)
                                                    <option value="{{ $obj->author->id }}" selected="selected">
                                                        {{ $obj->author->name }}</option>
                                                @endif
                                            </select>
                                        </div>

                                       @php
                                            $user = auth()->user();
                                            $isWriter = $user && $user->roles
                                                ->pluck('name')
                                                ->intersect(['English Content Writer','Arabic Content Writer'])
                                                ->isNotEmpty();
                                        @endphp

                                        <div class="form-group col-6 mb-4">


                                         @if($obj->id && $isWriter)
                                                    <span class="badge badge-secondary">
                                                        Draft
                                                    </span>

                                                <input type="hidden" name="status" value="1">

                                            @else

                                                <div class="custom-control custom-switch switch-primary float-left">
                                                    <input type="checkbox"
                                                        class="custom-control-input"
                                                        value="1"
                                                        id="status"
                                                        name="status"
                                                        @if (!$obj->id || $obj->status == 1) checked @endif>

                                                    <label class="custom-control-label" for="status">
                                                        {{ (!$obj->id || $obj->status == 1) ? 'Publish' : 'Draft' }}
                                                    </label>
                                                </div>

                                            @endif

                                        </div>

                                        <div class="form-group col-6  mb-4">
                                            <div class="custom-control custom-switch switch-primary float-left">
                                                <input type="checkbox" class="custom-control-input" value="1"
                                                    id="is_featured" name="is_featured"
                                                    @if ($obj->is_featured == 1) checked="checked" @endif>
                                                <label class="custom-control-label" for="is_featured">Featured</label>
                                            </div>

                                        </div>
                                        <div class="form-group col-12 col-md-6   mb-4">
                                            <label for="name">Created On: </label>
                                            @if (!$obj->id)
                                                {{ date('d M, Y h:i A') }}
                                            @else
                                                {{ date('d M, Y h:i A', strtotime($obj->created_at)) }}
                                            @endif
                                        </div>
                                        <div class="form-group col-12 col-md-6   mb-4">
                                            <label for="name">Last Updated On: </label>
                                            @if (!$obj->id)
                                                {{ date('d M, Y h:i A') }}
                                            @else
                                                {{ date('d M, Y h:i A', strtotime($obj->updated_at)) }}
                                            @endif
                                        </div>
                                        <div class="form-group col-12 col-md-6   mb-4">
                                            <label for="name">Created By: </label>
                                            @if (!$obj->id)
                                                {{ auth()->user()->name }}
                                            @else
                                                 {{ optional($obj->created_user)->name ?? '' }}
                                            @endif
                                        </div>
                                        <div class="form-group col-12 col-md-6   mb-4">
                                            <label for="name">Last Updated By: </label>
                                            @if (!$obj->id)
                                                {{ auth()->user()->name }}
                                            @else
                                                 {{ optional($obj->updated_user)->name ?? '' }}

                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                $news_published = false;
                                $type = $obj->type;
                                // Determine base type for checking published content
                                $base_type = $type;
                                if ($type == 'en_draft' || $type == 'ar_draft') {
                                    $base_type = str_replace('_draft', '', $type); 
                                }

                                // Check if published news exists
                                $news_published = App\Models\News::where('slug', $obj->slug)
                                    ->where('type', $base_type) 
                                    ->where('status', 1)        
                                    ->whereNull('deleted_at')
                                    ->exists();
                            @endphp

                              
                              <div class="card-footer text-muted">
                                @if($news_published && $isWriter && $approval_notification->status == 'approved')
                                    <div class="text-center mt-2">
                                        <button 
                                            class="btn btn-sm btn-warning rounded-pill" 
                                            disabled
                                            style="font-size: 0.75rem; cursor: not-allowed;"
                                        >
                                            ⚠️ Published content cannot be edited
                                        </button>
                                    </div>

                                @else
                                    <button class="btn btn-sm btn-primary float-right">
                                        Save
                                    </button>
                                @endif
                            </div>
                            </div>


                            <div class="card">
                            <div class="card-header">
                                 @if (!$obj->id || (isset($allowedTypes) && count($allowedTypes) <= 1))
                                    Select Language
                                @else
                                    Version Change
                                @endif
                                </div>

                                <div class="card-body">
                                    <div class="row m-0">
                                        <div class="form-group w-100 mb-2">
                                            <div class="card-footer text-muted">
                                                  @php
                                                    $labels = [
                                                        'en' => 'English',
                                                        'ar' => 'Arabic',
                                                        'en_draft' => 'English Draft',
                                                        'ar_draft' => 'Arabic Draft',
                                                    ];

                                                    $selectedType = $obj->type ?? ($allowedTypes[0] ?? 'en');

                                                    if ($obj->id && $roleName === 'Admin') {
                                                        // Restrict based on existing type
                                                        if (in_array($selectedType, ['en', 'en_draft'])) {
                                                            $optionsToShow = ['en', 'en_draft'];
                                                        } elseif (in_array($selectedType, ['ar', 'ar_draft'])) {
                                                            $optionsToShow = ['ar', 'ar_draft'];
                                                        } else {
                                                            $optionsToShow = array_keys($labels);
                                                        }
                                                    } else {
                                                        // For non-admin or create mode
                                                        $optionsToShow = $allowedTypes ?? array_keys($labels);
                                                    }
                                                @endphp

                                                <select name="type" class="form-control" id="languageSelect">
                                                    @foreach ($optionsToShow as $type)
                                                        @if (isset($labels[$type]))
                                                            <option value="{{ $type }}"
                                                                {{ $selectedType == $type ? 'selected' : '' }}>
                                                                {{ $labels[$type] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                             @if ($obj->id && isset($allowedTypes) && count($allowedTypes) > 1 && $roleName == 'Admin')
                                                <div class="card-footer text-muted">
                                                    <button class="btn btn-sm btn-primary float-right" type="button"
                                                        id="submitBtn">Go</button>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>




                                <div class="card">
                                    <div class="card-header">
                                        Category
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label class="">Category</label>
                                            <select name="category_id" class="w-100 webadmin-select2-input"
                                                data-placeholder="Select a Category">
                                                <option value="0">-- Select --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $obj->category_id) selected="selected" @endif>
                                                        {{ $category->name }}</option>
                                                    @include('admin._partials.category', [
                                                        'category' => $category,
                                                        'depth' => 1,
                                                        'selected' => $obj->category_id,
                                                    ])
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endfieldshow
                                            @fieldshow(blogs-tags)
                                            <div class="card">
                                                <div class="card-header">
                                                    Tags
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group col-md-12">
                                                        <label class="">Tags</label>
                                                        <select name="tags[]" class="w-100 webadmin-select2-input" data-select2-url="{{route('admin.select2.tags')}}" data-placeholder="Select Tags" multiple>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}
                                <div class="card">
                                    <div class="card-header">
                                        Priority
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label>Priority</label>
                                            <input type="number" name="priority" class="form-control numeric"
                                                value="{{ $obj->priority }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Featured Image (width: 1600px X height: 600px)
                                    </div>
                                    <div class="card-body">
                                        @include('admin.media.set_file', [
                                            'file' => $obj->featured_image,
                                            'title' => 'Featured Image',
                                            'popup_type' => 'single_image',
                                            'type' => 'Image',
                                            'holder_attr' => 'featured_image_id',
                                        ])
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Banner Image (width: 1600px X height: 600px)
                                    </div>
                                    <div class="card-body">
                                        @include('admin.media.set_file', [
                                            'file' => $obj->banner_image,
                                            'title' => 'Banner Image',
                                            'popup_type' => 'single_image',
                                            'type' => 'Image',
                                            'holder_attr' => 'banner_image_id',
                                        ])
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        OG Image
                                    </div>
                                    <div class="card-body">
                                        @include('admin.media.set_file', [
                                            'file' => $obj->og_image,
                                            'title' => 'OG Image',
                                            'popup_type' => 'single_image',
                                            'type' => 'Image',
                                            'holder_attr' => 'og_image_id',
                                        ])
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
    <script src="{{ asset('admin/plugins/jquery-datetimepicker/js/jquery.datetimepicker.full.min.js') }}"
        type="text/javascript"></script>
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
        ["ar", "ar_draft"],
    ];

    const isAllowedSwap = swapConditions.some(([type, value]) => currentType === type && selectedValue === value);

    if (isAllowedSwap) {
        ProcessConfirm(
            "If you click submit, the contents of both pages will swap. Do you want to continue?"
        );
    } else {
        $.confirm({
            title: 'Error',
            content: `You can't change from "${currentType}" to "${selectedValue}".`,
            buttons: {
                ok: { text: 'OK', btnClass: 'btn-danger' }
            }
        });
        return;
    }

    function ProcessConfirm(content) {
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

    function ProcessContent() {
        var url = "{{ route('admin.news.get-type') }}?type=" + selectedValue +
            "&slug=" + slug + "&name=" + name + "&currentType=" + currentType;

        fetch(url, {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.redirect_url) {
                window.location.href = data.redirect_url;
            } else if (data.error) {
                $.confirm({
                    title: 'Error',
                    content: data.error,
                    buttons: {
                        ok: { text: 'OK', btnClass: 'btn-danger' }
                    }
                });
            } else {
                $.confirm({
                    title: 'Warning',
                    content: 'No redirect URL found',
                    buttons: {
                        ok: { text: 'OK', btnClass: 'btn-warning' }
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            $.confirm({
                title: 'Error',
                content: `You can't change from "${currentType}" to "${selectedValue}".`,
                buttons: {
                    ok: { text: 'OK', btnClass: 'btn-danger' }
                }
            });
        });
    }

});

</script>
<script type="text/javascript">
    var validator = $('#InputFrm').validate({
        ignore: [], 
        rules: {
            "name": "required",
            "category_id": {
                        required: true,
                        min: 1 
             },
            slug: {
                required: true,
            },
           
            "content": "required",
             "featured_image_id": {
                            required: true
            },
            "banner_image_id": {
                required: true
            },
           
        },
        messages: {
            "name": "News name cannot be blank",
             "title": "Title cannot be blank",
            slug: {
                required: "Slug cannot be blank",
            },
            "category_id": {
                    required: "Category cannot be blank",
                    min: "Please select a valid category"
            },
            "content": "News content cannot be blank",
             "featured_image_id": "Please add Featured image",
             "banner_image_id": "Please add Banner image",
        },
        errorPlacement: function(error, element) {
            if (element.hasClass('webadmin-select2-input')) {
                error.insertAfter(element.next('.select2'));
            } else if (element.attr("id") === "content") {
                error.insertAfter($('#content').closest('.form-group'));
            } else {
                error.insertAfter(element);
            }
        }
    });

    $(function() {
        $('.datetimepicker').datetimepicker({
            format: 'd/m/Y H:i',
            formatDate: 'd/m/Y'
        });
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function sendForApproval(id, slug, type, model) {

            if (isFormDirty) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Unsaved Changes Detected',
                    text: 'Please save changes before sending for approval.',
                    confirmButtonText: 'OK'
                });

                return;
            }
            Swal.fire({
                title: 'Send Approval Email?',
                text: "Do you want to send the approval email?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, send it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('send.approval.mail') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                id: id,
                                slug: slug,
                                type: type,
                                model: model 
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                setTimeout(() => location.reload(), 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Something went wrong!',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: error.message || 'Failed to send request',
                            });
                        });
                }
            });
        }
    </script>

 <script>
    document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('form[data-copy-mode="name-to-slug-only"]')
        .forEach(function (form) {

            const nameInput  = form.querySelector('input[name="name"]');
            const slugInput  = form.querySelector('input[name="slug"]');

            if (!nameInput || !slugInput) return;

            nameInput.addEventListener('input', function (e) {

                e.stopImmediatePropagation();

                const value = this.value;

                slugInput.value = value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            });

        });

    });
</script>


    @parent
@endsection
