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
                                        <h4 class="page-title">Header</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item active">Header</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    @include('admin._partials.notifications')
                    <div class="row">
                        <div class="col-8">
                            <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                @csrf
                                <input type="hidden" name="settings_type" value="Common">
                            <div class="card">
                                <div class="card-header">
                                    Common Settings
                                </div>
                                <div class="card-body row">
                                    <div class="form-group col-md-12">
                                        <label>Site Name</label>
                                        <input type="text" name="settings[site_name]" class="form-control" value="{{$data['site_name']}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Google tag manager head</label>
                                        <textarea name="settings[google_tag_manager_head]" class="form-control">{{$data['google_tag_manager_head']}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Google tag manager body</label>
                                        <textarea name="settings[google_tag_manager_body]" class="form-control">{{$data['google_tag_manager_body']}}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Other common scripts</label>
                                        <textarea name="settings[other_common_scripts]" class="form-control">{{$data['other_common_scripts']}}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </div>
                        </form>



                        </div>
                        <div class="col-4">
                            <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="settings_type" value="Logo">
                            <div class="card">
                                <div class="card-header">
                                    Logo
                                </div>
                                <div class="card-body text-center">
                                    @if(file_exists(public_path($data['logo'])))
                                        <div class="text-center">
                                            <img src="{{asset($data['logo'])}}">
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12 mt-4">
                                        <input type="file" class="form-control" name="file" />
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="settings_type" value="Small Logo">
                            <div class="card">
                                <div class="card-header">
                                    Small Logo
                                </div>
                                <div class="card-body">
                                    @if(file_exists(public_path($data['logo_small'])))
                                        <div class="text-center">
                                            <img src="{{asset($data['logo_small'])}}">
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12 mt-4">
                                        <input type="file" class="form-control" name="file" />
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="SettingsFrm" data-validate=true enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="settings_type" value="Fav Icon">
                            <div class="card">
                                <div class="card-header">
                                    Fav Icon
                                </div>
                                <div class="card-body">
                                    @if(file_exists(public_path($data['fav_icon'])))
                                        <div class="text-center">
                                            <img src="{{asset($data['fav_icon'])}}">
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12 mt-4">
                                        <input type="file" class="form-control" name="file" />
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </div>
                        </form>

                        </div>
                    </div>

                </div><!-- container -->

                @include('admin._partials.footer')
            </div>
            <!-- end page content -->
@endsection
@section('footer')
<script type="text/javascript">
    var idInc = 2;
      $(document).ready(function(){

        $(document).on('change', '#google-status', function(){
            if($(this).is(':checked'))
                var status = 1;
            else
                var status = 0;
            console.log(status);
            $('input[name="settings[google_login]"]').val(status);
        })

        $(document).on('click', '.btn-addnew', function(){
          var html ='<div class="settings-item row"><div class="form-group col-md-5"><label>Key</label><input type="text" name="code[]" class="form-control" id="code_'+idInc+'"></div><div class="form-group col-md-6"><label>Value</label><input type="text" name="value[]" class="form-control" id="value_'+idInc+'"></div><div class="col-md-1 center-block mt-4"><a href="javascript:void(0);" class="remove-row">X</a></div></div>';
          $(html).insertBefore('.bottom-btn');
          idInc++;
        });

        $(document).on('click', '.remove-row', function(){
          $(this).parents('.settings-item').remove();
        })

        $.extend( $.validator.prototype, {
          checkForm: function () {
            this.prepareForm();
            for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
              if (this.findByName(elements[i].name).length != undefined && this.findByName(elements[i].name).length > 1) {
                for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
                this.check(this.findByName(elements[i].name)[cnt]);
                }
              } else {
                this.check(elements[i]);
              }
            }
            return this.valid();
          },
          showErrors: function( errors ) {
          if ( errors ) {
            var validator = this;

            // Add items to error list and map
            $.extend( this.errorMap, errors );
            this.errorList = $.map( this.errorMap, function( message, name ) {
              return {
                message: message,
                element: validator.findById(name)[0]
              };
            });

            // Remove items from success list
            this.successList = $.grep( this.successList, function( element ) {
              return !( element.name in errors );
            } );
          }
          if ( this.settings.showErrors ) {
            this.settings.showErrors.call( this, this.errorMap, this.errorList );
          } else {
            this.defaultShowErrors();
          }
        },
        findById: function( id ) {
          // select by name and filter by form for performance over form.find(“[id=…]”)
          var form = this.currentForm;
          return $(document.getElementById(id)).map(function(index, element) {
          return element.form == form && element.id == id && element || null;
          });
        },
      });

       var validator = $('#SettingsFrm').validate({
          rules: {
            "code[]": "required",
            "value[]": "required",
          },
          messages: {
            "code[]": "Key cannot be blank",
            "value[]": "Value cannot be blank",
          },
        });
      });
</script>
@endsection
