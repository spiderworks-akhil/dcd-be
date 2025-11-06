@extends('admin._layouts.default')
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
                                            <h4 class="page-title">Edit Language</h4>
                                        @else
                                            <h4 class="page-title">Create new Language</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Languages</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif User</li>
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
                            <div class="card">
                                <div class="card-body">
                                    @if($obj->id)
                                        <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @else
                                        <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="tab-content chat-list" id="pills-tabContent" >
                                                        <div class="tab-pane fade show active" id="tab1">
                                                            <div class="row m-0">
                                                                <div class="form-group col-md-6">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{$obj->name}}">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="name">Slug</label>
                                                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$obj->slug}}">
                                                                </div>
                                                                
                                                            </div>
                                                            <hr/>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-6 text-right  ">
                                                <a href="{{ route($route.'.index') }}" class="btn btn-soft-primary">Back to List</a>
                                            </div>
                                            <div class="col-sm-6 text-right  ">
                                                 <button type="submit" class="btn btn-primary px-4">Submit</button>
                                            </div>
                                        </div>
                                    </form>                                                                   
                                </div><!--end card-body-->
                            </div><!--end card-->
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
                        table: 'languages',
                    }
                  }
                },
              },
              messages: {
                "name": "Language name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });
    </script>
@parent
@endsection