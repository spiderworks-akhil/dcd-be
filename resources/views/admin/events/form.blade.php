@extends('admin._layouts.fileupload')

@section('header')
    @parent
    <link href="{{ asset('admin/plugins/jquery-datetimepicker/css/jquery.datetimepicker.css') }}" rel="stylesheet"
        type="text/css" />

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

        #add-new-image-content i {
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
                                @if ($obj->id)
                                    <h4 class="page-title">Edit Event</h4>
                                @else
                                    <h4 class="page-title">Create new Event</h4>
                                @endif
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">All Events</a></li>
                                    <li class="breadcrumb-item active">
                                        @if ($obj->id)
                                            Edit
                                        @else
                                            Create new
                                        @endif Event
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
            @php
                $user = auth()->user();
                $roleName = $user->roles->pluck('name')->first();
            @endphp

            <div class="row">
                <div class="col-lg-12">
                    @include('admin._partials.notifications')
                    @if ($obj->id)
                        <form method="POST" action="{{ route($route . '.update') }}" class="p-t-15" id="InputFrm"
                            data-validate=true>
                        @else
                            <form method="POST" action="{{ route($route . '.store') }}" class="p-t-15" id="InputFrm"
                                data-validate=true>
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
                                            <div class="form-group col-md-6">
                                                <label>Name</label>
                                                <input type="text" name="name"
                                                    class="form-control @if (!$obj->id) copy-name @endif"
                                                    value="{{ $obj->name }}" required
                                                    @if ($roleName != 'Admin' && $obj->id) readonly @endif>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Slug (for url)</label>
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ $obj->slug }}" id="slug"
                                                    @if ($roleName != 'Admin' && $obj->id) readonly @endif>
                                                <small class="text-muted">
                                                    The “slug” is the URL-friendly version of the name. It is usually all
                                                    lowercase and contains only letters, numbers, and hyphens.
                                                </small>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $obj->title }}">
                                            </div>
                                            @fieldshow(events - title)
                                                <div class="form-group col-md-12">
                                                    <label>Heading</label>
                                                    <input type="text" name="title" class="form-control"
                                                        value="{{ $obj->title }}" required="">
                                                </div>
                                            @endfieldshow

                                            <div class="form-group col-md-4">
                                                <label>Starts On</label>
                                                <input type="text" name="start_time" class="form-control datetimepicker"
                                                    value="@if ($obj->start_time) {{ date('d/m/Y H:i', strtotime($obj->start_time)) }} @endif">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Ends On</label>
                                                <input type="text" name="end_time" class="form-control datetimepicker"
                                                    value="@if ($obj->end_time) {{ date('d/m/Y H:i', strtotime($obj->end_time)) }} @endif">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Fees</label>
                                                <input type="text" name="fees" class="form-control"
                                                    value="{{ $obj->fees }}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Location / Address</label>
                                                <textarea name="location" class="form-control" rows="2" id="location">{{ $obj->location }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Result Text</label>
                                                <input type="text" name="result" class="form-control"
                                                    value="{{ $obj->result }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Result Link</label>
                                                <input type="text" name="result_link" class="form-control"
                                                    value="{{ $obj->result_link }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Website Link</label>
                                                <input type="text" name="website_link" class="form-control"
                                                    value="{{ $obj->website_link }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Website Link Text</label>
                                                <input type="text" name="website_link_text" class="form-control"
                                                    value="{{ $obj->website_link_text }}">
                                            </div>
                                                <div class="form-group col-md-6">
                                                    <label>Short Description</label>
                                                    <textarea name="short_description" class="form-control" rows="2" id="short_description">{{ $obj->short_description }}</textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Content</label>
                                                    <textarea name="content" class="form-control editor" id="content">{{ $obj->content }}</textarea>
                                                </div>
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
                                            <option value="1" @if ($obj->is_scheduled == 1) selected @endif>Yes
                                            </option>
                                            <option value="0" @if ($obj->is_scheduled == 0) selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group scheduled-fields"
                                        @if ($obj->is_scheduled != 1) style="display: none;" @endif>
                                        <div id="schedule-container">
                                            @if (isset($obj->schedules) && count($obj->schedules) > 0)
                                                @foreach ($obj->schedules as $key => $schedule)
                                                    <div class="schedule-item row">

                                                        <input type="hidden"
                                                            name="event_schedules[{{ $key }}][id]"
                                                            value="{{ $schedule->id ?? '' }}">

                                                        <div class="col-md-12">
                                                            <label>Schedule Title</label>
                                                            <input type="text"
                                                                name="event_schedules[{{ $key }}][title]"
                                                                class="form-control"
                                                                value="{{ $schedule['title'] ?? '' }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Schedule Time</label>
                                                            <input type="text"
                                                                name="event_schedules[{{ $key }}][time]"
                                                                class="form-control datetimepicker"
                                                                value="{{ $schedule['time'] ?? '' }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Schedule Priority</label>
                                                            <input type="number"
                                                                name="event_schedules[{{ $key }}][priority]"
                                                                class="form-control"
                                                                value="{{ $schedule['priority'] ?? '' }}">
                                                        </div>

                                                        <div class="col-md-12 text-right mt-2">
                                                            <button type="button"
                                                                class="btn btn-danger remove-schedule">Remove</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" id="add-schedule" class="btn btn-primary mt-3">Add
                                            Schedule</button>

                                    </div>

                                    @if ($obj->is_scheduled == 0)
                                        <div class="card">
                                            <div class="card-header">
                                                Volunteer Ad Image (Width: 640px X Height: 140px)
                                            </div>
                                            <div class="card-body">
                                                @include('admin.media.set_file', [
                                                    'file' => $obj->volunteer_ad_image,
                                                    'title' => 'Volunteer Ad Image',
                                                    'popup_type' => 'single_image',
                                                    'type' => 'Image',
                                                    'holder_attr' => 'volunteer_ad_image_id',
                                                ])
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                                <div class="card">
                                    <div class="card-header">
                                        Media
                                    </div>
                                    <div class="card-body">
                                        <div class="row add-multiple-image">
                                            @if (count($obj->gallery) > 0)
                                                @php
                                                    $media_type = 'Image-Video';
                                                @endphp
                                                @foreach ($obj->gallery as $key => $item)
                                                    @include('admin.events.media', [
                                                        'item' => $item,
                                                        'type' => $media_type,
                                                    ])
                                                @endforeach
                                            @endif
                                            <div class="col-md-4 mb-2" id="add-new-image-wrap">
                                                <div style="display:none" id="image-clone-holder">
                                                    @include('admin.media.set_file', [
                                                        'file' => null,
                                                        'title' => 'Event Media',
                                                        'popup_type' => 'single_image',
                                                        'type' => 'Image-Video',
                                                        'holder_attr' => 'event_medias[]',
                                                        'id' => 'id_holder',
                                                    ])
                                                </div>
                                                <div id="add-new-image-container">
                                                    <div id="add-new-image-content">
                                                        <a href="javascript:void(0)" class="dropdown-toggle"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"><i
                                                                class="fas fa-plus-circle text-primary"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" id="add-new-image"
                                                                href="javascript:void(0)">Upload from local machine</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                data-toggle="modal" data-target="#youtubeModal">Add youtube
                                                                link</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        SEO
                                    </div>
                                    <div class="card-body row">
                                            <div class="form-group col-md-12">
                                                <label>Bottom content</label>
                                                <textarea name="bottom_description" class="form-control editor" id="bottom_description">{{ $obj->bottom_description }}</textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Browser title</label>
                                                <input type="text" class="form-control" name="browser_title"
                                                    id="browser_title" value="{{ $obj->browser_title }}">
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
                                                    <a href="https://dcd.org.ae/{{ $obj->type }}/events/{{ $obj->slug }}"
                                                        class="btn btn-success btn-sm mr-2" title="View"
                                                        target="_blank">
                                                        Preview <i data-feather="eye"></i>
                                                    </a>
                                                </div>


                                                @if (($roleName != 'Admin' && $obj->type == 'en_draft') || $obj->type == 'ar_draft')

                                                    <div class="col-md-6">
                                                        @if ($approval_notification)
                                                            @if ($approval_notification->status === 'approved')
                                                                <!-- Approved: show send again button -->
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','Event')">
                                                                    Send for Approval
                                                                </button>
                                                            @elseif($approval_notification->status === 'rejected')
                                                                <!-- Rejected: allow send again -->
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','Event')">
                                                                    Send for Approval
                                                                </button>
                                                            @elseif($approval_notification->status === "pending" && $approval_notification->email_sent == 1)
                                                                <!-- Pending: disable button -->
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    disabled>
                                                                    Email Sent
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- No approval record yet: show send button -->
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                onclick="sendForApproval({{ $obj->id }}, '{{ $obj->slug }}', '{{ $obj->type }}','Event')">
                                                                Send for Approval
                                                            </button>
                                                        @endif
                                                    </div>


                                                     <div class="text-left">
                                                        @if ($approval_notification && $approval_notification->status != null)
                                                            <div class="p-2 border rounded">
                                                                @if ($approval_notification->status == 'approved')
                                                                    <span class="badge badge-success">Approved ✅</span>
                                                                @elseif($approval_notification->status == 'rejected')
                                                                    <span class="badge badge-danger">Rejected ❌</span>
                                                                @elseif ($approval_notification->status == 'pending')
                                                                    <span class="badge badge-warning">Waiting for approval</span>
                                                                @endif
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
                                <div class="card-header">
                                    Publish
                                </div>
                                <div class="card-body">
                                    <div class="row m-0">
                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <div class="custom-control custom-switch switch-primary float-left">
                                                <input type="checkbox" class="custom-control-input" value="1"
                                                    id="status" name="status"
                                                    @if (!$obj->id || $obj->status == 1) checked="" @endif>
                                                <label class="custom-control-label" for="status">
                                                    @if (!$obj->id || $obj->status == 1)
                                                        Publish
                                                    @else
                                                        Draft
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                            <div class="form-group col-md-6 p-0  mb-3">
                                                <div class="custom-control custom-switch switch-primary float-left">
                                                    <input type="checkbox" class="custom-control-input" value="1"
                                                        id="is_featured" name="is_featured"
                                                        @if ($obj->is_featured == 1) checked="checked" @endif>
                                                    <label class="custom-control-label" for="is_featured">Featured</label>
                                                </div>
                                            </div>
                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <div style="margin-right: 5px;"
                                                class="custom-control custom-switch switch-primary float-left">
                                                <input type="checkbox" class="custom-control-input" value="1"
                                                    id="is_must_attend" name="is_must_attend"
                                                    @if ($obj->is_must_attend == 1) checked="checked" @endif>
                                                <label class="custom-control-label" for="is_must_attend">Must
                                                    Attend</label>
                                            </div>


                                        </div>

                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <div style="margin-right: 5px;"
                                                class="custom-control custom-switch switch-primary float-left">
                                                <input type="checkbox" class="custom-control-input" value="1"
                                                    id="is_featured_in_banner" name="is_featured_in_banner"
                                                    @if ($obj->is_featured_in_banner == 1) checked="checked" @endif>
                                                <label class="custom-control-label" for="is_featured_in_banner">Featured
                                                    In Banner</label>
                                            </div>

                                        </div>


                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <label for="name">Created On: </label>
                                            @if (!$obj->id)
                                                {{ date('d M, Y h:i A') }}
                                            @else
                                                {{ date('d M, Y h:i A', strtotime($obj->created_at)) }}
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <label for="name">Last Updated On: </label>
                                            @if (!$obj->id)
                                                {{ date('d M, Y h:i A') }}
                                            @else
                                                {{ date('d M, Y h:i A', strtotime($obj->updated_at)) }}
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <label for="name">Created By: </label>
                                            @if (!$obj->id)
                                                {{ auth()->user()->name }}
                                            @else
                                                {{ $obj->created_user->name ?? '' }}
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 p-0  mb-3">
                                            <label for="name">Last Updated By: </label>
                                            @if (!$obj->id)
                                                {{ auth()->user()->name }}
                                            @else
                                                {{ $obj->updated_user->name ?? '' }}
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
                                            @if ($obj->id && isset($allowedTypes) && count($allowedTypes) > 1)
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
                                    {{-- @if ($obj->id)
                                        <div class="card">
                                            <div class="card-header">
                                                FAQ
                                            </div>
                                            <div class="card-body text-center">
                                                <a href="{{ route('admin.faq.index', [$obj->id, 'Event']) }}"
                                                    class="webadmin-open-ajax-popup btn btn-sm btn-warning" title="SET FAQ"
                                                    data-popup-size="large">
                                                    @if (count($obj->faq) > 0)
                                                        Update FAQ
                                                    @else
                                                        Add FAQ
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif --}}
                                    <div class="card">
                                        <div class="card-header">
                                            Featured Image (width: 750px X height: 1048px)
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
                                        Logo Image
                                    </div>
                                    <div class="card-body">
                                        @include('admin.media.set_file', [
                                            'file' => $obj->logo_image,
                                            'title' => 'Logo Image',
                                            'popup_type' => 'single_image',
                                            'type' => 'Image',
                                            'holder_attr' => 'logo_image_id',
                                        ])
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Video
                                    </div>
                                    <div class="card-body">
                                        @include('admin.media.set_file', [
                                            'file' => $obj->video,
                                            'title' => 'Video',
                                            'popup_type' => 'single_video',
                                            'type' => 'Video',
                                            'holder_attr' => 'video_id',
                                        ])
                                    </div>
                                </div>

                                    <div class="card">
                                        <div class="card-header">
                                            Banner Image (width: 1920px X height: 1080px)
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
            <!-- Modal -->
            <div class="modal fade" id="youtubeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
        <script src="{{ asset('admin/plugins/jquery-datetimepicker/js/jquery.datetimepicker.full.min.js') }}"
            type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('.datetimepicker').datetimepicker({
                    format: 'd/m/Y H:i',
                    formatDate: 'd/m/Y'
                });
            })

            var idInc = "{{ count($obj->gallery) }}";
            $(function() {
                $(document).on('click', '#add-new-image', function() {
                    var html = $('#image-clone-holder').html();
                    var content = '<div class="col-md-4 mb-2">' + html + '</div>';

                    var img_id = 'project_image_' + idInc;
                    content = content.replaceAll("id_holder", img_id);
                    $(content).insertBefore('#add-new-image-wrap');
                    idInc++;
                })

                $(document).on('click', '#youTubeUrlAdd', function() {
                    var url = $('#youTubeUrl').val();
                    if (url != undefined || url != '') {
                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                        var match = url.match(regExp);
                        if (match && match[2].length == 11) {
                            var thumb = Youtube.thumb(url, 'big');
                            var html = '<div class="col-md-4 mb-2 youtube-item"><div id="project_image_' +
                                idInc +
                                '"><input type="hidden" name="youtube_url[]" value="https://www.youtube.com/embed/' +
                                match[2] + '"><input type="hidden" name="youtube_preview[]" value="' + thumb +
                                '"><div class="thumbnail text-center"><div class="card"><img src="' + thumb +
                                '" class="w-100"><div class="card-body"><p class="card-text">Embed Url: https://www.youtube.com/embed/' +
                                match[2] +
                                '</p><hr><div class="text-center"><a href="javascript:void(0);" class="youtube-remove ml-2"><i class="fas fa-trash"></i></a></div></div></div></div></div></div></div>';
                            $('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] +
                                '?autoplay=1&enablejsapi=1');
                            $(html).insertBefore('#add-new-image-wrap');
                            idInc++;
                            $('#youTubeUrl').val('');
                            $('#youtubeModal').modal('hide')
                        } else {
                            $.alert('Please enter a valid youtube url');
                            // Do anything for not being valid
                        }
                    } else {
                        $.alert('Please enter a youtube url');
                    }
                });

                $(document).on('click', '.gallery-item-remove', function(e) {
                    e.preventDefault();
                    var that = $(this);
                    var delete_url = that.attr('href');
                    $.confirm({
                        title: 'Confirm!',
                        content: 'Are you sure to delete this?',
                        buttons: {
                            confirm: {
                                btnClass: 'btn-blue',
                                action: function() {
                                    that.parents('.gallery-item').remove();
                                    $.get(delete_url);
                                }
                            },
                            cancel: function() {},
                        }
                    });
                })

                $(document).on('click', '#gallery-media-update-form', function() {
                    if ($('#galleryMediaUpdateForm #gallery-youtube-url').length) {
                        if ($('#galleryMediaUpdateForm #gallery-youtube-url').val() == "") {
                            miniweb_alert('Alert!', 'Youtube url cannot be null');
                            return;
                        }
                    }
                    var postData = new FormData($('#galleryMediaUpdateForm')[0]);
                    $.ajax({
                        url: "{{ route('admin.events.media.update') }}",
                        type: "POST",
                        data: postData,
                        processData: false,
                        contentType: false,
                        success: function(response, textStatus, jqXHR) {
                            if (typeof response.success != "undefined") {
                                $('#gallery-item-' + response.id).replaceWith(response.html);
                                miniweb_alert('Success!', 'Gallery successfully updated.');
                                $(".jconfirm-closeIcon").trigger("click");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
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
                    "start_time": "required",
                    "end_time": "required",
                    "location": "required",
                    "category_id": {
                        required: true,
                        min: 1 
                    },
                     "featured_image_id": {
                            required: true
                     },
                      "banner_image_id": {
                            required: true
                     },
                    "logo_image_id": {
                            required: true
                     },
                    slug: {
                        required: true,
                        remote: {
                            url: "{{ route('admin.unique-slug') }}",
                            data: {
                                id: function() {
                                    return $("#inputId").val();
                                },
                                type: function() {
                                    return "{{ $obj->type ?? 'en' }}";
                                },
                                table: 'events',
                            }
                        }
                    },
                },
                messages: {
                    "name": "Blog name cannot be blank",
                    "title": "Blog heading cannot be blank",
                    "start_time": "Start Time  cannot be blank",
                    "end_time": "End Time  cannot be blank",
                    "location": "Location  cannot be blank",
                    "category_id": {
                                required: "Category cannot be blank",
                                min: "Please select a valid category"
                     },
                       "featured_image_id": "Please add Featured image",
                       "banner_image_id": "Please add Banner image",
                       "logo_image_id": "Please add Logo image",

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
            $(document).on('click', '.remove-schedule', function() {
                const scheduleItem = $(this).closest('.schedule-item');
                const idField = scheduleItem.find('input[name^="event_schedules"][name$="[id]"]');

                if (idField.length && idField.val()) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'removed_schedule_ids[]',
                        value: idField.val()
                    }).appendTo('form');
                }

                scheduleItem.remove();
            });
        </script>


        <script>
            function getSchedules() {
                const schedules = [];

                document.querySelectorAll('.schedule-item').forEach(item => {
                    const idField = item.querySelector('input[name^="event_schedules"][name$="[id]"]');

                    schedules.push({
                        id: idField?.value || null, // ✅ optional chaining
                        title: item.querySelector('input[name^="event_schedules"][name$="[title]"]').value,
                        time: item.querySelector('input[name^="event_schedules"][name$="[time]"]').value,
                        priority: item.querySelector('input[name^="event_schedules"][name$="[priority]"]').value
                    });
                });

                return schedules;
            }
        </script>
        <script>
            document.getElementById('submitBtn').addEventListener('click', function() {
                const selectedValue = document.getElementById('languageSelect').value;
                const currentType = @json($obj->type);
                const slug = @json($obj->slug);
                const name = @json($obj->name);

                const swapConditions = [
                    ["en_draft", "en"],
                    ["en", "en_draft"],
                    ["ar_draft", "ar"],
                    ["ar", "ar_draft"]
                ];

                const key = [currentType, selectedValue];

                const isValidSwap = swapConditions.some(pair =>
                    pair[0] === key[0] && pair[1] === key[1]
                );

                if (isValidSwap) {
                    $.confirm({
                        title: 'Warning',
                        content: "If you click submit, the contents of both pages will swap. Do you want to continue?",
                        buttons: {
                            confirm: () => processContent(),
                            cancel: () => {}
                        }
                    });
                } else {
                    $.confirm({
                        title: 'Error',
                        content: `You can't change from "${currentType}" to "${selectedValue}".`,
                        buttons: {
                            ok: {
                                text: 'OK',
                                btnClass: 'btn-danger'
                            }
                        }
                    });
                }

                function processContent() {
                    const schedules = getSchedules();
                    const schedulesParam = encodeURIComponent(JSON.stringify(schedules));

                    const url =
                        `{{ route('admin.events.get-type') }}?type=${selectedValue}&slug=${slug}&name=${name}&currentType=${currentType}&schedules=${schedulesParam}`;

                    fetch(url, {
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.redirect_url) {
                                window.location.href = data.redirect_url;
                            } else {
                                $.confirm({
                                    title: 'Error',
                                    content: data.error || 'No redirect URL found',
                                    buttons: {
                                        ok: {
                                            text: 'OK',
                                            btnClass: 'btn-danger'
                                        }
                                    }
                                });
                            }
                        })
                        .catch(() => {
                            $.confirm({
                                title: 'Error',
                                content: `Something went wrong.`,
                                buttons: {
                                    ok: {
                                        text: 'OK',
                                        btnClass: 'btn-danger'
                                    }
                                }
                            });
                        });
                }

            });
        </script>



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function sendForApproval(id, slug, type, model) {
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


        @parent
    @endsection
