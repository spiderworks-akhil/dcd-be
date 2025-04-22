<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Top Content</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[banner_sub_title]" class="form-control"
                @if($obj->content && isset($obj->content['banner_sub_title']))
            value="{{ $obj->content['banner_sub_title'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[banner_title]" class="form-control"
                @if($obj->content && isset($obj->content['banner_title']))
            value="{{ $obj->content['banner_title'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[banner_description]" class="form-control ">
                @if($obj->content && isset($obj->content['banner_description']))
                    {{ $obj->content['banner_description'] }}
                @endif
            </textarea>
        </div>

    </fieldset>

    <h3>Contact Section</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-12">

                @php
                $media_id_email_image = $obj->content && isset($obj->content['media_id_email_image']) ? $obj->content['media_id_email_image'] : null;
                @endphp
                @include('admin.media.set_file', [
                'file' => $media_id_email_image,
                'title' => 'Email Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_email_image]',
                'id' => 'media_id_email_image',
                'display' => 'horizontal',
                ])
            </div>
            <div class="form-group col-md-3">
                <label>Sub Title</label>
                <input type="text" name="content[email_sub_title]" class="form-control"
                    @if($obj->content && isset($obj->content['email_sub_title']))
                value="{{ $obj->content['email_sub_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Title</label>
                <input type="text" name="content[email_title]" class="form-control"
                    @if($obj->content && isset($obj->content['email_title']))
                value="{{ $obj->content['email_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url text</label>
                <input type="text" name="content[email_url_text]" class="form-control"
                    @if($obj->content && isset($obj->content['email_url_text']))
                value="{{ $obj->content['email_url_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url</label>
                <input type="text" name="content[email_url]" class="form-control"
                    @if($obj->content && isset($obj->content['url']))
                value="{{ $obj->content['url'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-12">
                @php
                $media_id_visit_image = $obj->content && isset($obj->content['media_id_visit_image']) ? $obj->content['media_id_visit_image'] : null;
                @endphp
                @include('admin.media.set_file', [
                'file' => $media_id_visit_image,
                'title' => 'Featured Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_visit_image]',
                'id' => 'media_id_visit_image',
                'display' => 'horizontal',
                ])
            </div>
            <div class="form-group col-md-3">
                <label>Sub Title</label>
                <input type="text" name="content[visit_sub_title]" class="form-control"
                    @if($obj->content && isset($obj->content['visit_sub_title']))
                value="{{ $obj->content['visit_sub_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Title</label>
                <input type="text" name="content[visit_title]" class="form-control"
                    @if($obj->content && isset($obj->content['visit_title']))
                value="{{ $obj->content['visit_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url text</label>
                <input type="text" name="content[visit_url_text]" class="form-control"
                    @if($obj->content && isset($obj->content['visit_url_text']))
                value="{{ $obj->content['visit_url_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url</label>
                <input type="text" name="content[visit_url]" class="form-control"
                    @if($obj->content && isset($obj->content['visit_url']))
                value="{{ $obj->content['visit_url'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-12">

                @php
                $media_id_callus_image = $obj->content && isset($obj->content['media_id_callus_image']) ? $obj->content['media_id_callus_image'] : null;
                @endphp
                @include('admin.media.set_file', [
                'file' => $media_id_callus_image,
                'title' => 'Call us Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_callus_image]',
                'id' => 'media_id_callus_image',
                'display' => 'horizontal',
                ])
            </div>
            <div class="form-group col-md-3">
                <label>Sub Title</label>
                <input type="text" name="content[callus_sub_title]" class="form-control"
                    @if($obj->content && isset($obj->content['callus_sub_title']))
                value="{{ $obj->content['callus_sub_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Title</label>
                <input type="text" name="content[callus_title]" class="form-control"
                    @if($obj->content && isset($obj->content['callus_title']))
                value="{{ $obj->content['callus_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url text</label>
                <input type="text" name="content[callus_url_text]" class="form-control"
                    @if($obj->content && isset($obj->content['callus_url_text']))
                value="{{ $obj->content['callus_url_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Url</label>
                <input type="text" name="content[callus_url]" class="form-control"
                    @if($obj->content && isset($obj->content['callus_url']))
                value="{{ $obj->content['callus_url'] }}"
                @endif
                >
            </div>
        </div>
    </fieldset>

    <h3>Operational Section</h3>
    <fieldset>
        @php
        $media_id_operational_image =
        $obj->content && isset($obj->content['media_id_operational_image'])
        ? $obj->content['media_id_operational_image']
        : null;
        @endphp
        @include('admin.media.set_file', [
        'file' => $media_id_operational_image,
        'title' => 'featured Image ',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_operational_image]',
        'id' => 'media_id_operational_image',
        'display' => 'horizontal',
        ])
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_operational]" class="form-control"
                @if($obj->content && isset($obj->content['title_operational']))
            value="{{ $obj->content['title_operational'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[description_operational]" class="form-control ">
                    @if($obj->content && isset($obj->content['description_operational']))
                        {{ $obj->content['description_operational'] }}
                    @endif
                </textarea>
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[button_text_operational]" class="form-control"
                    @if($obj->content && isset($obj->content['button_text_operational']))
                value="{{ $obj->content['button_text_operational'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[button_link_operational]" class="form-control"
                    @if($obj->content && isset($obj->content['button_link_operational']))
                value="{{ $obj->content['button_link_operational'] }}"
                @endif
                >
            </div>
        </div>
    </fieldset>

    <h3>Map Section</h3>

    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[visit_us_sub_title]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_sub_title']))
                    value="{{ $obj->content['visit_us_sub_title'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[visit_us_title]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_title']))
                    value="{{ $obj->content['visit_us_title'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[visit_us_description]" class="form-control ">
                @if($obj->content && isset($obj->content['visit_us_description']))
                    {{ $obj->content['visit_us_description'] }}
                @endif
            </textarea>
        </div>
        <div class="form-group col-md-12">
            <label>Address Title</label>
            <input type="text" name="content[visit_us_address_title]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_address_title']))
                    value="{{ $obj->content['visit_us_address_title'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Address</label>
            <input type="text" name="content[visit_us_address]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_address']))
                    value="{{ $obj->content['visit_us_address'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>URL</label>
            <input type="text" name="content[visit_us_url]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_url']))
                    value="{{ $obj->content['visit_us_url'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>URL Text</label>
            <input type="text" name="content[visit_us_url_text]" class="form-control"
                @if($obj->content && isset($obj->content['visit_us_url_text']))
                    value="{{ $obj->content['visit_us_url_text'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Map</label>
            <textarea name="content[visit_us_map]" class="form-control">
                @if($obj->content && isset($obj->content['visit_us_map']))
                    {{ $obj->content['visit_us_map'] }}
                @endif
            </textarea>
        </div>


    </fieldset>

    <h3>Message Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[top_title1]" class="form-control"
                @if($obj->content && isset($obj->content['top_title1']))
            value="{{ $obj->content['top_title1'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Sub description </label>
            <textarea name="content[top_subtitle1]" class="form-control editor">
                @if($obj->content && isset($obj->content['top_subtitle1']))
                    {{ $obj->content['top_subtitle1'] }}
                @endif
            </textarea>
        </div>
        @php
        $media_id_works_first_featured_image =
        $obj->content && isset($obj->content['media_id_works_first_featured_image'])
        ? $obj->content['media_id_works_first_featured_image']
        : null;
        @endphp
        @include('admin.media.set_file', [
        'file' => $media_id_works_first_featured_image,
        'title' => 'featured Image ',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_works_first_featured_image]',
        'id' => 'media_id_works_first_featured_image',
        'display' => 'horizontal',
        ])
        <div class="row">
            <div class="form-group col-md-3">
                <label>Placeholder 1</label>
                <input type="text" name="content[form_placeholder_1]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_1']))
                value="{{ $obj->content['form_placeholder_1'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 2</label>
                <input type="text" name="content[form_placeholder_2]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_2']))
                value="{{ $obj->content['form_placeholder_2'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 3</label>
                <input type="text" name="content[form_placeholder_3]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_3']))
                value="{{ $obj->content['form_placeholder_3'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 4</label>
                <input type="text" name="content[form_placeholder_4]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_4']))
                value="{{ $obj->content['form_placeholder_4'] }}"
                @endif
                >
            </div>
            <!-- <div class="form-group col-md-4">
                <label>Placeholder 5</label>
                <input type="text" name="content[form_placeholder_5]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_5']))
                value="{{ $obj->content['form_placeholder_5'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-4">
                <label>Placeholder 6</label>
                <input type="text" name="content[form_placeholder_6]" class="form-control"
                    @if($obj->content && isset($obj->content['form_placeholder_6']))
                value="{{ $obj->content['form_placeholder_6'] }}"
                @endif
                >
            </div> -->

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label>Label 1</label>
                <input type="text" name="content[form_label_1]" class="form-control"
                    @if($obj->content && isset($obj->content['form_label_1']))
                        value="{{ $obj->content['form_label_1'] }}"
                    @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Label 2</label>
                <input type="text" name="content[form_label_2]" class="form-control"
                    @if($obj->content && isset($obj->content['form_label_2']))
                        value="{{ $obj->content['form_label_2'] }}"
                    @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Label 3</label>
                <input type="text" name="content[form_label_3]" class="form-control"
                    @if($obj->content && isset($obj->content['form_label_3']))
                        value="{{ $obj->content['form_label_3'] }}"
                    @endif
                >
            </div>
            <div class="form-group col-md-3">
                <label>Label 4</label>
                <input type="text" name="content[form_label_4]" class="form-control"
                    @if($obj->content && isset($obj->content['form_label_4']))
                        value="{{ $obj->content['form_label_4'] }}"
                    @endif
                >
            </div>

        </div>

        <div class="form-group col-md-12">
            <label>Button Text</label>
            <input type="text" name="content[contact_button_text]" class="form-control"
                @if($obj->content && isset($obj->content['contact_button_text']))
            value="{{ $obj->content['contact_button_text'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Success Message</label>
            <input type="text" name="content[success_message]" class="form-control"
                @if($obj->content && isset($obj->content['success_message']))
            value="{{ $obj->content['success_message'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Failed Message</label>
            <input type="text" name="content[failed_message]" class="form-control"
                @if($obj->content && isset($obj->content['failed_message']))
            value="{{ $obj->content['failed_message'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Loading Text</label>
            <input type="text" name="content[loading_text]" class="form-control"
                @if($obj->content && isset($obj->content['loading_text']))
            value="{{ $obj->content['loading_text'] }}"
            @endif
            >
        </div>
    </fieldset>


    <H3>Learn more Section</H3>
    <fieldset>
        <div class="form-group col-md-6">
            <label>Title</label>
            <input type="text" name="content[learn_more_title]" class="form-control"
                @if($obj->content && isset($obj->content['learn_more_title']))
            value="{{ $obj->content['learn_more_title'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-6">
            <label>Sub Title</label>
            <input type="text" name="content[learn_more_subtitle]" class="form-control"
                @if($obj->content && isset($obj->content['learn_more_subtitle']))
            value="{{ $obj->content['learn_more_subtitle'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-6">
            <label>See More Label</label>
            <input type="text" name="content[see_more_label]" class="form-control"
                @if($obj->content && isset($obj->content['see_more_label']))
            value="{{ $obj->content['see_more_label'] }}"
            @endif >
        </div>
        <div class="form-group">
            @if ($obj->type == 'en')
                <a href="{{route('admin.listing-items.index',[5])}}" class="btn btn-primary" target="_blank"> Learn more
                </a>
                <input type="hidden" name="content[learn_more_listing_id]" value="5">
            @else
                <a href="{{route('admin.listing-items.index',[31])}}" class="btn btn-primary" target="_blank"> Learn more
                </a>
                <input type="hidden" name="content[learn_more_listing_id]" value="31">
            @endif

        </div>

    </fieldset>
</div>
