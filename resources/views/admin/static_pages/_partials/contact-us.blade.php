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


    <h3>Membership and Volunteer Section</h3>
<fieldset>

    <div class="form-group col-md-12">
        <label>Section Heading</label>
        <input type="text" name="content[section_heading]" class="form-control"
            @if($obj->content && isset($obj->content['section_heading']))
                value="{{ $obj->content['section_heading'] }}"
            @endif
        >
    </div>

    <div class="form-group col-md-12">
        <label>Left Side - Image</label>
        @php
            $media_id_left_image = ($obj->content && isset($obj->content['media_id_left_image'])) ? $obj->content['media_id_left_image'] : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_left_image,
            'title' => 'Left Side Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_left_image]',
            'id' => 'media_id_left_image',
            'display' => 'horizontal'
        ])
    </div>
    <div class="form-group col-md-12">
        <label>Left Side - Title</label>
        <input type="text" name="content[left_title]" class="form-control"
            @if($obj->content && isset($obj->content['left_title']))
                value="{{ $obj->content['left_title'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Left Side - Description</label>
        <textarea name="content[left_description]" class="form-control editor">
            @if($obj->content && isset($obj->content['left_description']))
                {{ $obj->content['left_description'] }}
            @endif
        </textarea>
    </div>
    <div class="form-group col-md-12">
        <label>Left Side - Button Text</label>
        <input type="text" name="content[left_button_text]" class="form-control"
            @if($obj->content && isset($obj->content['left_button_text']))
                value="{{ $obj->content['left_button_text'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Left Side - Button Link</label>
        <input type="text" name="content[left_button_link]" class="form-control"
            @if($obj->content && isset($obj->content['left_button_link']))
                value="{{ $obj->content['left_button_link'] }}"
            @endif
        >
    </div>

    <hr>

    <div class="form-group col-md-12">
        <label>Right Side - Image</label>
        @php
            $media_id_right_image = ($obj->content && isset($obj->content['media_id_right_image'])) ? $obj->content['media_id_right_image'] : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_right_image,
            'title' => 'Right Side Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_right_image]',
            'id' => 'media_id_right_image',
            'display' => 'horizontal'
        ])
    </div>
    <div class="form-group col-md-12">
        <label>Right Side - Title</label>
        <input type="text" name="content[right_title]" class="form-control"
            @if($obj->content && isset($obj->content['right_title']))
                value="{{ $obj->content['right_title'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Right Side - Description</label>
        <textarea name="content[right_description]" class="form-control editor">
            @if($obj->content && isset($obj->content['right_description']))
                {{ $obj->content['right_description'] }}
            @endif
        </textarea>
    </div>
    <div class="form-group col-md-12">
        <label>Right Side - Button Text</label>
        <input type="text" name="content[right_button_text]" class="form-control"
            @if($obj->content && isset($obj->content['right_button_text']))
                value="{{ $obj->content['right_button_text'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Right Side - Button Link</label>
        <input type="text" name="content[right_button_link]" class="form-control"
            @if($obj->content && isset($obj->content['right_button_link']))
                value="{{ $obj->content['right_button_link'] }}"
            @endif
        >
    </div>
</fieldset>

<h3>Email Us</h3>
<fieldset>

        <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[email_us_title_1]" class="form-control"
            @if($obj->content && isset($obj->content['email_us_title_1']))
                value="{{ $obj->content['email_us_title_1'] }}"
            @endif
        >

            <div class="form-group col-md-12">
            <label>Bottom Content</label>
            <input type="text" name="content[email_us_bottom_content]" class="form-control"
                @if($obj->content && isset($obj->content['email_us_bottom_content']))
                    value="{{ $obj->content['email_us_bottom_content'] }}"
                @endif
            >
    </div>
        <div class="form-group col-md-12">
        <label>Send Message</label>
        <input type="text" name="content[send_message]" class="form-control"
            @if($obj->content && isset($obj->content['send_message']))
                value="{{ $obj->content['send_message'] }}"
            @endif
        >

</fieldset>


</div>
