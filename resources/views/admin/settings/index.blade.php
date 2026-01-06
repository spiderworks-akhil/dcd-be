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
                            <h4 class="page-title">All Settings</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                <li class="breadcrumb-item active">All Settings</li>
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
                         <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Common Settings</span>

                            <!-- Edit Button -->
                            <a href="javascript:void(0)" class="edit-toggle">
                                <i class="fa fa-edit" style="font-size:18px;"></i>
                            </a>

                        </div>

                        <div class="card-body row">
                            <div class="form-group col-md-12">
                                <label>Site Name</label>
                                <input type="text" name="settings[site_name]" class="form-control" value="{{$data['site_name']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Google tag manager head</label>
                                <textarea name="settings[google_tag_manager_head]" class="form-control" readonly>{{$data['google_tag_manager_head']}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Google tag manager body</label>
                                <textarea name="settings[google_tag_manager_body]" class="form-control" readonly>{{$data['google_tag_manager_body']}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Other common scripts</label>
                                <textarea name="settings[other_common_scripts]" class="form-control" readonly>{{$data['other_common_scripts']}}</textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                {{-- <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Contact">
                    <div class="card">
                        <div class="card-header">
                            Contact Settings
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label>Contact Address1</label>
                                <textarea name="settings[contact_address1]" class="form-control">{{$data['contact_address1']}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contact Address2</label>
                                <textarea name="settings[contact_address2]" class="form-control">{{$data['contact_address2']}}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Email</label>
                                <input type="text" name="settings[contact_email]" class="form-control" value="{{$data['contact_email']}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact Number</label>
                                <input type="text" name="settings[contact_number]" class="form-control" value="{{$data['contact_number']}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Whatsapp Number</label>
                                <input type="text" name="settings[whatsapp_number]" class="form-control" value="{{$data['whatsapp_number']}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Google map embed code</label>
                                <textarea name="settings[google_map_embed_code]" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form> --}}
             

                <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Contact">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Contact Notification MailIds</span>

                            <!-- Edit Button -->
                            <a href="javascript:void(0)" class="edit-toggle">
                                <i class="fa fa-edit" style="font-size:18px;"></i>
                            </a>

                        </div>

                        <div class="card-body row">
                            <div class="form-group col-md-12">
                                <label>Contact notification emailids</label>
                                <input type="text" name="settings[contact_notification_email_ids]" class="form-control setting-input"
                                    value="{{$data['contact_notification_email_ids']}}" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label>English content notification Mailids</label>
                                <input type="text" name="settings[send_en_content_notification]" class="form-control setting-input"
                                    value="{{$data['send_en_content_notification']}}" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Arabic content notification Mailids</label>
                                <input type="text" name="settings[send_ar_content_notification]" class="form-control setting-input"
                                    value="{{$data['send_ar_content_notification']}}" readonly>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary" type="submit" id="updateBtn" disabled>Update</button>
                        </div>
                    </div>
                </form>

                 
                <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Social Media">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Social Media Links</span>

                            <!-- Edit Button -->
                            <a href="javascript:void(0)" class="edit-toggle">
                                <i class="fa fa-edit" style="font-size:18px;"></i>
                            </a>


                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label>Facebook Link</label>
                                <input type="text" name="settings[facebook_link]" class="form-control" value="{{$data['facebook_link']}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Twitter Link</label>
                                <input type="text" name="settings[twitter_link]" class="form-control" value="{{$data['twitter_link']}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Linkedin Link</label>
                                <input type="text" name="settings[linkedin_link]" class="form-control" value="{{$data['linkedin_link']}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Instagram Link</label>
                                <input type="text" name="settings[intagram_link]" class="form-control" value="{{$data['intagram_link']}}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Youtube Link</label>
                                <input type="text" name="settings[youtube_link]" class="form-control" value="{{$data['youtube_link']}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tiktok Link</label>
                                <input type="text" name="settings[tiktok_link]" class="form-control" value="{{$data['tiktok_link']}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Snapchat Link</label>
                                <input type="text" name="settings[snapchat_link]" class="form-control" value="{{$data['snapchat_link']}}" readonly>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                {{-- <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Others">
                    <div class="card">
                        <div class="card-header">
                            Other Settings
                        </div>
                        <div class="card-body">
                            @foreach($other_data as $odata)
                            <div class="settings-item row">
                                <div class="form-group col-md-6">
                                    <label>Key</label>
                                    <input type="text" name="code[]" class="form-control" value="{{$odata->code}}" readonly="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Value</label>
                                    <input type="text" name="value[]" class="form-control" value="{{$odata->value_text}}">
                                </div>
                                <div class="col-md-1 center-block">

                                </div>
                            </div>
                            @endforeach
                            <div class="settings-item row">
                                <div class="form-group col-md-6">
                                    <label>Key</label>
                                    <input type="text" name="code[]" class="form-control" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Value</label>
                                    <input type="text" name="value[]" class="form-control" value="">
                                </div>
                                <div class="col-md-1 center-block">

                                </div>
                            </div>
                           
                            <div class="row bottom-btn">
                                <div class="col-md-6">
                                    <a href="javascript:void(0);" class="btn btn-soft-primary btn-sm btn-addnew">Add New</a>
                                </div>

                                <div class="col-md-6">
                                     <button class="btn btn-sm btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Save</button>
                        </div> -->
                    </div>
                </form> --}}
            </div>
            <div class="col-4">
                <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Google">
                    <div class="card">
                      
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Google Login</span>

                            <!-- Edit Button -->
                            <a href="javascript:void(0)" class="edit-toggle">
                                <i class="fa fa-edit" style="font-size:18px;"></i>
                            </a>

                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-12">
                                <label>Client ID</label>
                                <input type="text" name="settings[google_auth_client_id]" class="form-control" value="{{$data['google_auth_client_id']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Client Secret</label>
                                <input type="text" name="settings[google_auth_client_secret]" class="form-control" value="{{$data['google_auth_client_secret']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Redirect Uri</label>
                                <p class="text-success" >{{route('google.login')}}</p>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <div class="custom-control custom-switch switch-primary float-left">
                                <input type="checkbox" class="custom-control-input" value="1" id="google-status" @if($data['google_login']==1) checked="" @endif readonly>
                                <label class="custom-control-label" for="google-status">Enable</label>
                            </div>
                            <input type="hidden" name="settings[google_login]" @if($data['google_login']=='-1' ) value="1" @else value="{{$data['google_login']}}" @endif  />
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="settings_type" value="Logo">
                    <div class="card">
                        <div class="card-header">
                           Left Logo
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
                            Right Logo
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
                <form method="POST" action="{{ route('admin.settings.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="settings_type" value="Smtp">
                    <div class="card">
                         <div class="card-header d-flex justify-content-between align-items-center">
                            <span>SMTP Settings</span>

                            <!-- Edit Button -->
                            <a href="javascript:void(0)" class="edit-toggle">
                                <i class="fa fa-edit" style="font-size:18px;"></i>
                            </a>

                        </div>
                        <div class="card-body row">
                            <div class="form-group col-md-12">
                                <label>SMTP Host</label>
                                <input type="text" name="settings[smtp_host]" class="form-control" value="{{$data['smtp_host']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP Port</label>
                                <input type="text" name="settings[smtp_port]" class="form-control" value="{{$data['smtp_port']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP User</label>
                                <input type="text" name="settings[smtp_user]" class="form-control" value="{{$data['smtp_user']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP Password</label>
                                <input type="text" name="settings[smtp_password]" class="form-control" value="{{$data['smtp_password']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP Encryption</label>
                                <input type="text" name="settings[smtp_encryption]" class="form-control" value="{{$data['smtp_encryption']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP From Mail Address</label>
                                <input type="text" name="settings[smtp_from_address]" class="form-control" value="{{$data['smtp_from_address']}}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label>SMTP From Name</label>
                                <input type="text" name="settings[smtp_from_name]" class="form-control" value="{{$data['smtp_from_name']}}" readonly>
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
    $(document).ready(function() {

        $(document).on('change', '#google-status', function() {
            if ($(this).is(':checked'))
                var status = 1;
            else
                var status = 0;
            console.log(status);
            $('input[name="settings[google_login]"]').val(status);
        })

        $(document).on('click', '.btn-addnew', function() {
            var html = '<div class="settings-item row"><div class="form-group col-md-5"><label>Key</label><input type="text" name="code[]" class="form-control" id="code_' + idInc + '"></div><div class="form-group col-md-6"><label>Value</label><input type="text" name="value[]" class="form-control" id="value_' + idInc + '"></div><div class="col-md-1 center-block mt-4"><a href="javascript:void(0);" class="remove-row">X</a></div></div>';
            $(html).insertBefore('.bottom-btn');
            idInc++;
        });

        $(document).on('click', '.remove-row', function() {
            $(this).parents('.settings-item').remove();
        })

        $.extend($.validator.prototype, {
            checkForm: function() {
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
            showErrors: function(errors) {
                if (errors) {
                    var validator = this;

                    // Add items to error list and map
                    $.extend(this.errorMap, errors);
                    this.errorList = $.map(this.errorMap, function(message, name) {
                        return {
                            message: message,
                            element: validator.findById(name)[0]
                        };
                    });

                    // Remove items from success list
                    this.successList = $.grep(this.successList, function(element) {
                        return !(element.name in errors);
                    });
                }
                if (this.settings.showErrors) {
                    this.settings.showErrors.call(this, this.errorMap, this.errorList);
                } else {
                    this.defaultShowErrors();
                }
            },
            findById: function(id) {
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

<script>
document.querySelectorAll(".edit-toggle").forEach(btn => {

    btn.addEventListener("click", function () {

        // find the form this icon belongs to
        let form = this.closest("form");

        // select all editable fields in that form
        let fields = form.querySelectorAll("input.form-control, textarea.form-control");

        // detect current state
        let isReadOnly = fields[0].hasAttribute("readonly");

        if (isReadOnly) {
            // enable editing
            fields.forEach(f => f.removeAttribute("readonly"));

            // enable submit button if present
            let updateBtn = form.querySelector("button[type='submit']");
            if (updateBtn) updateBtn.removeAttribute("disabled");

            // change icon to unlocked
            this.innerHTML = '<i class="fa fa-lock-open" style="font-size:18px;"></i>';
        } 
        else {
            // disable editing
            fields.forEach(f => f.setAttribute("readonly", true));

            // disable submit button if present
            let updateBtn = form.querySelector("button[type='submit']");
            if (updateBtn) updateBtn.setAttribute("disabled", true);

            // change icon back to edit
            this.innerHTML = '<i class="fa fa-edit" style="font-size:18px;"></i>';
        }
    });

});
</script>


@endsection
