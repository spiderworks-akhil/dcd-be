<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Support Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Main Title</label>
            <input type="text" name="content[support_main_title]" class="form-control"
                @if($obj->content && isset($obj->content['support_main_title']))
                    value="{{ $obj->content['support_main_title'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Sub Title / Description</label>
            <textarea name="content[support_sub_title]" class="form-control editor">
                @if($obj->content && isset($obj->content['support_sub_title']))
                    {{ $obj->content['support_sub_title'] }}
                @endif
            </textarea>
        </div>
    </fieldset>

    <h3>Email Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Email Title</label>
            <input type="text" name="content[email_title]" class="form-control"
                @if($obj->content && isset($obj->content['email_title']))
                    value="{{ $obj->content['email_title'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Email Address</label>
            <input type="text" name="content[email_address]" class="form-control"
                @if($obj->content && isset($obj->content['email_address']))
                    value="{{ $obj->content['email_address'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Email Description</label>
            <textarea name="content[email_description]" class="form-control editor">
                @if($obj->content && isset($obj->content['email_description']))
                    {{ $obj->content['email_description'] }}
                @endif
            </textarea>
        </div>
    </fieldset>

    <h3>Call Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Call Title</label>
            <input type="text" name="content[call_title]" class="form-control"
                @if($obj->content && isset($obj->content['call_title']))
                    value="{{ $obj->content['call_title'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Phone Number</label>
            <input type="text" name="content[phone_number]" class="form-control"
                @if($obj->content && isset($obj->content['phone_number']))
                    value="{{ $obj->content['phone_number'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Call Description</label>
            <textarea name="content[call_description]" class="form-control editor">
                @if($obj->content && isset($obj->content['call_description']))
                    {{ $obj->content['call_description'] }}
                @endif
            </textarea>
        </div>
    </fieldset>

    <h3>Location Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Location Title</label>
            <input type="text" name="content[location_title]" class="form-control"
                @if($obj->content && isset($obj->content['location_title']))
                    value="{{ $obj->content['location_title'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Address</label>
            <textarea name="content[location_address]" class="form-control editor">
                @if($obj->content && isset($obj->content['location_address']))
                    {{ $obj->content['location_address'] }}
                @endif
            </textarea>
        </div>
        <div class="form-group col-md-12">
            <label>Google Maps Link</label>
            <input type="text" name="content[google_maps_link]" class="form-control"
                @if($obj->content && isset($obj->content['google_maps_link']))
                    value="{{ $obj->content['google_maps_link'] }}"
                @endif
            >
        </div>
    </fieldset>

</div>
