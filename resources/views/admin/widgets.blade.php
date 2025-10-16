@extends('admin._layouts.fileupload')
@section('content')
<style>
    a.w-active{
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
                            <h4 class="page-title">All Widgets</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Admin</a></li>
                                <li class="breadcrumb-item active">All Widgets</li>
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
        @include('admin._partials.notifications')

        @php
            $type = (!empty(request()->input('type')))?request()->input('type'):'en';
        @endphp

        <div class="  card  " style="background: none !important; border:0;"  >
            <div class="flex items-center justify-center">
                 <a style="margin: 3px;" href="{{ url('sw-admin/widgets?type=en') }}"   class="btn btn-info @if($type == 'en') w-active @endif" >EN</a>
            <a style="margin: 3px;" href="{{ url('sw-admin/widgets?type=ar') }}"  class="btn btn-info  @if($type == 'ar') w-active @endif" >AR</a>

            </div> 
        </div>

        @if($type == 'en')
            @include('admin.widget_en',['data'=>$data])
        @endif    
        @if($type == 'ar')
            @include('admin.widget_ar',['data'=>$data])
        @endif    

    </div><!-- container -->

    @include('admin._partials.footer')
</div>
<!-- end page content -->
@endsection
@section('footer')
@parent
@endsection
