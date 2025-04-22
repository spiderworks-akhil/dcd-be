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
                                <h4 class="page-title">Edit Static Page</h4>

                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">All Static Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Page</li>
                                </ol>
                            </div><!--end col-->

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
                            data-validate=true>
                        @else
                            <form method="POST" action="{{ route($route . '.store') }}" class="p-t-15" id="InputFrm"
                                data-validate=true>
                    @endif
                    @csrf
                    <input type="hidden" name="id"
                        @if ($obj->id) value="{{ encrypt($obj->id) }}" @endif id="inputId">
                    <div class="row">
                        <div class="col-md-9">
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
                                                    value="{{ $obj->name }}" required="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="">Slug (for url)</label>
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ $obj->slug }}" id="slug">
                                                <small class="text-muted">The “slug” is the URL-friendly version of the
                                                    name. It is usually all lowercase and contains only letters, numbers,
                                                    and hyphens.</small>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Heading</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $obj->title }}" required="">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Breadcrumbs</label>
                                                <input type="text" name="breadcrumbs" class="form-control"
                                                    value="{{ $obj->breadcrumbs }}">
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                            @if (View::exists('admin.static_pages._partials.' . $obj->slug))
                                <div class="card">
                                    <div class="card-header">
                                        CONTENT
                                    </div>
                                    <div class="card-body text-center">
                                        @include('admin.static_pages._partials.' . $obj->slug)
                                    </div>
                                </div>
                            @endif

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
                                        <input type="text" class="form-control" name="browser_title" id="browser_title"
                                            value="{{ $obj->browser_title }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" id="meta_keywords">{{ $obj->meta_keywords }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="">Meta description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" id="meta_description">{{ $obj->meta_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Open Graph Fields
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-12">
                                        <p class="input-info">
                                            OG (Open Graph) title and description are metadata tags used in the HTML of a
                                            webpage to control how the content is displayed when shared on social media
                                            platforms, messaging apps, or other Open Graph-enabled services. These tags are
                                            part of the Open Graph protocol, which allows web pages to become “rich objects”
                                            when shared.
                                        </p>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>OG Title</label>
                                        <input type="text" class="form-control" name="og_title" id="og_title"
                                            value="{{ $obj->og_title }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="">OG Description</label>
                                        <textarea name="og_description" class="form-control" rows="3" id="og_description">{{ $obj->og_description }}</textarea>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label class="">OG Image</label>
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
                        <div class="col-md-3 ">
                            <div class="card-publish">


                                <div class="card ">
                                    <div class="card-header">
                                        Publish
                                    </div>
                                    @if ($obj->id)
                                        <div class="card-body">
                                            <div class="row m-0">
                                                <div class="form-group w-100  mb-2">
                                                    <div class="custom-control custom-switch switch-primary float-left">
                                                        <input type="checkbox" class="custom-control-input"
                                                            value="1" id="status" name="status"
                                                            @if (!$obj->id || $obj->status == 1) checked="" @endif>
                                                        <label class="custom-control-label" for="status">Status</label>
                                                    </div>
                                                </div>
                                                <div class="form-group w-100 mb-1 time-info">
                                                    <label for="name">Created On </label>
                                                    @if (!$obj->id)
                                                        {{ date('d M, Y h:i A') }}
                                                    @else
                                                        {{ date('d M Y H:i', strtotime($obj->created_at)) }}
                                                    @endif
                                                </div>
                                                <div class="form-group w-100  mb-1  time-info">
                                                    <label for="name">Last Updated On </label>
                                                    @if (!$obj->id)
                                                        {{ date('d M, Y h:i A') }}
                                                    @else
                                                        {{ date('d M Y H:i', strtotime($obj->updated_at)) }}
                                                    @endif
                                                </div>
                                                <div class="form-group w-100  mb-1  time-info">
                                                    <label for="name">Created By </label>
                                                    @if (!$obj->id)
                                                        {{ auth()->user()->name }}
                                                    @else
                                                        {{ $obj->created_user->name }}
                                                    @endif
                                                </div>
                                                <div class="form-group w-100  mb-1  time-info">
                                                    <label for="name">Last Updated By </label>
                                                    @if (!$obj->id)
                                                        {{ auth()->user()->name }}
                                                    @else
                                                        {{ $obj->updated_user->name }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-footer text-muted">
                                        <select name="status" class="form-control">
                                            <option value="1" @if ($obj->status == 1) selected @endif>
                                                Publish</option>
                                            <option value="0" @if ($obj->status == 0) selected @endif>Draft
                                            </option>
                                        </select>

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
                                </div>

                            </div>
                            @if ($obj->id)

                                <div class="card">
                                    <div class="card-header">
                                        FAQ
                                    </div>
                                    <div class="card-body text-center">
                                        <a href="{{ route('admin.faq.index', [$obj->id, 'FrontendPage']) }}"
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
                            @endif
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
    @if (View::exists('admin.static_pages._partials.' . $obj->slug))
        <script src="{{ asset('admin/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
        <script type="text/javascript">
            $(function() {
                $("#form-vertical").steps({
                    headerTag: "h3",
                    bodyTag: "fieldset",
                    transitionEffect: "slideLeft",
                    stepsOrientation: "vertical",
                    enableAllSteps: true,
                    enablePagination: false,
                });
            })
        </script>
    @endif

    <script>
        var validator = $('#InputFrm').validate({
            ignore: [],
            rules: {
                "name": "required",
                // "slug": {
                //     required: true,
                //     remote: {
                //         url: "{{ route('admin.unique-slug') }}",
                //         data: {
                //             id: function() {
                //                 return $("#inputId").val();
                //             },
                //             table: 'frontend_pages',
                //         }
                //     }
                // },
            },
            messages: {
                "name": "Product name cannot be blank",
                // "slug": {
                //     required: "Slug cannot be blank",
                //     remote: "Slug is already in use",
                // },
            },
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

        var url = "{{ route('admin.get-slug') }}?type=" + selectedValue + "&slug=" + slug + "&name=" + name + "&currentType=" + currentType;

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
