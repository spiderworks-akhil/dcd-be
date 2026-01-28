@extends('admin._layouts.fileupload')
@section('content')
    <style>
        a.w-active {
            background-color: #888 !important;
            color: black;
        }
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
    <div class="page-content all-widget-page">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">All Language Settings</h4>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                                    <li class="breadcrumb-item active">All Language Settings</li>
                                </ol>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <!-- end page title end breadcrumb -->
           <div class="container-fluid">

    @include('admin._partials.notifications')

    @php
        $type = request()->input('type') ?? 'en';
    @endphp


    <div class="card shadow-sm mb-3">
        <div class="card-body text-center">

            <h5 class="card-title mb-3">Select Language</h5>

            <div class="flex items-center justify-center">
                 <a style="margin: 3px;" href="{{ url('sw-admin/languages?type=en') }}"   class="btn btn-info @if($type == 'en') w-active @endif" >EN</a>
            <a style="margin: 3px;" href="{{ url('sw-admin/languages?type=ar') }}"  class="btn btn-info  @if($type == 'ar') w-active @endif" >AR</a>


        </div>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">
                Language Settings — {{ strtoupper($type) }}
            </h5>
        </div>
@php
    $labels = [
        'play_video' => 'Play video title in rewind section',
        'follow_us' => 'Follow us title in footer section',
        'event_categories_upcoming_title' => 'Upcoming title in event page',
        'explore_all_events' => 'Explore all events title in event page',
         'volunteer' => 'Volunteer listing title in event detail page',
         'schedule' => 'Schedule listing  title in event detail page',
         'dont_miss' => 'Dont Miss Section title in event detail page',
         'top_must_attend_events' => 'Top Must attend events title in event detail page',
        'view_all_events' => 'View all events title in event detail page',
        'whatshappening' => 'Whats happening title in event detail page',
        'discover_past_events' => 'Discover Past events title',
        'all_events' => 'All events title in mega menu',
         'footer_text' => 'Footer text content',
         'featured' => 'Featured section title',
         'capture_event' => 'Capture event title in event detail page',
    ];
@endphp


        <div class="card-body">

            <form method="POST" action="{{ route('admin.settings.store') }}">
                @csrf

                <input type="hidden" name="settings_type" value="Others">
                <input type="hidden" name="type" value="{{ $type }}">


               @foreach($data as $key => $value)

                    @php
                        $label = $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
                    @endphp

                    <div class="settings-item row align-items-center mb-3">

                        <div class="form-group col-md-5">
                            <label class="font-weight-bold">{{ $label }}</label>
                            <input type="text"
                                name="code[]"
                                class="form-control"
                                value="{{ $key }}"
                                readonly>
                        </div>

                        <div class="form-group col-md-7">
                            <label class="font-weight-bold">Value</label>
                            <input type="text"
                                name="value[]"
                                class="form-control"
                                value="{{ $value }}">
                        </div>
                    </div>

                    <hr>
            @endforeach




                <div class="text-right mt-3">
                    <button class="btn btn-primary px-4">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>


        </div><!-- container -->

        @include('admin._partials.footer')
    </div>
    <!-- end page content -->
@endsection
@section('footer')
    @parent
@endsection
