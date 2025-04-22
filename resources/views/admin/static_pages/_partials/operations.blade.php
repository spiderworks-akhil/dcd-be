<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Top Content</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[top_sub_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['top_sub_title'])) value="{{ $obj->content['top_sub_title'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[top_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['top_title'])) value="{{ $obj->content['top_title'] }}" @endif>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[top_description]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['top_description']))
{{ $obj->content['top_description'] }}
@endif
                    </textarea>
        </div>
        <div class="form-group">
            @php
                $media_id_banner_video =
                    $obj->content && isset($obj->content['media_id_banner_video'])
                        ? $obj->content['media_id_banner_video']
                        : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_banner_video,
                'title' => 'Video',
                'popup_type' => 'single_image',
                'type' => 'Video',
                'holder_attr' => 'content[media_id_banner_video]',
                'id' => 'content_image_1',
                'display' => 'horizontal',
            ])
        </div>
    </fieldset>

    <h3>Overview Section</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[overview_sub_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['overview_sub_title'])) value="{{ $obj->content['overview_sub_title'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[overview_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['overview_title'])) value="{{ $obj->content['overview_title'] }}" @endif>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Description 1</label>
                <textarea name="content[overview_description_1]" class="form-control ">
                        @if ($obj->content && isset($obj->content['overview_description_1']))
{{ $obj->content['overview_description_1'] }}
@endif
                    </textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Description 2</label>
                <textarea name="content[overview_description_2]" class="form-control ">
                    @if ($obj->content && isset($obj->content['overview_description_2']))
{{ $obj->content['overview_description_2'] }}
@endif
                </textarea>
            </div>
        </div>
        <div class="form-group">
            @php
                $media_id_enquiries_image =
                    $obj->content && isset($obj->content['media_id_enquiries_image'])
                        ? $obj->content['media_id_enquiries_image']
                        : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_enquiries_image,
                'title' => 'Bottom Banner Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_enquiries_image]',
                'id' => 'media_id_enquiries_image',
                'display' => 'horizontal',
            ])
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[enquiries_title]" class="form-control"
                @if ($obj->content && isset($obj->content['enquiries_title'])) value="{{ $obj->content['enquiries_title'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[enquiries_description]" class="form-control">
                        @if ($obj->content && isset($obj->content['enquiries_description']))
{{ $obj->content['enquiries_description'] }}
@endif
                    </textarea>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[enquiries_button_text]" class="form-control"
                    @if ($obj->content && isset($obj->content['enquiries_button_text'])) value="{{ $obj->content['enquiries_button_text'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[enquiries_button_link]" class="form-control"
                    @if ($obj->content && isset($obj->content['enquiries_button_link'])) value="{{ $obj->content['enquiries_button_link'] }}" @endif>
            </div>
        </div>

    </fieldset>

    <h3>Mid Image</h3>
    <fieldset>

        <div class="form-group">
            @php
                $media_id_mid_image =
                    $obj->content && isset($obj->content['media_id_mid_image'])
                        ? $obj->content['media_id_mid_image']
                        : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_mid_image,
                'title' => 'Mid Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_mid_image]',
                'id' => 'media_id_mid_image',
                'display' => 'horizontal',
            ])
        </div>
    </fieldset>

    <h3>Learn More</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[learn_more_sub_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['learn_more_sub_title'])) value="{{ $obj->content['learn_more_sub_title'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[learn_more_title_1]" class="form-control"
                    @if ($obj->content && isset($obj->content['learn_more_title_1'])) value="{{ $obj->content['learn_more_title_1'] }}" @endif>
            </div>
        </div>


        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[learn_more_description]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['learn_more_description']))
{{ $obj->content['learn_more_description'] }}
@endif
                    </textarea>
        </div>

        @if ($obj->type == 'en')
            <a href="{{ route('admin.listing-items.index', [10]) }}" class="btn btn-sm btn-danger" target="_blank"> Add
                Transport List </a>
            <input type="hidden" name="content[transport_listing_id]" value="10">
        @else
            <a href="{{ route('admin.listing-items.index', [18]) }}" class="btn btn-sm btn-danger" target="_blank"> Add
                Transport List </a>
            <input type="hidden" name="content[transport_listing_id]" value="18">
        @endif

    </fieldset>
    <h3>Contact Block</h3>
    <fieldset>
        <div class="form-group col-md-6">
            <label>Title</label>
            <input type="text" name="content[contact_title]" class="form-control"
                @if ($obj->content && isset($obj->content['contact_title'])) value="{{ $obj->content['contact_title'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[contact_description]" id="contact_description" class="form-control editor">
                        @if ($obj->content && isset($obj->content['contact_description']))
{{ $obj->content['contact_description'] }}
@endif
                    </textarea>
        </div>
        <div class="form-group">
            @php
                $media_id_contact_img =
                    $obj->content && isset($obj->content['media_id_contact_img'])
                        ? $obj->content['media_id_contact_img']
                        : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_contact_img,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_contact_img]',
                'id' => 'content_image_2',
                'display' => 'horizontal',
            ])

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label>Placeholder 1</label>
                <input type="text" name="content[form_placeholder_1]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_1'])) value="{{ $obj->content['form_placeholder_1'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 2</label>
                <input type="text" name="content[form_placeholder_2]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_2'])) value="{{ $obj->content['form_placeholder_2'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 3</label>
                <input type="text" name="content[form_placeholder_3]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_3'])) value="{{ $obj->content['form_placeholder_3'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Placeholder 4</label>
                <input type="text" name="content[form_placeholder_4]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_4'])) value="{{ $obj->content['form_placeholder_4'] }}" @endif>
            </div>
            <!-- <div class="form-group col-md-4">
                <label>Placeholder 5</label>
                <input type="text" name="content[form_placeholder_5]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_5'])) value="{{ $obj->content['form_placeholder_5'] }}" @endif
                >
            </div>
            <div class="form-group col-md-4">
                <label>Placeholder 6</label>
                <input type="text" name="content[form_placeholder_6]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_placeholder_6'])) value="{{ $obj->content['form_placeholder_6'] }}" @endif
                >
            </div> -->

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label>Label 1</label>
                <input type="text" name="content[form_label_1]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_label_1'])) value="{{ $obj->content['form_label_1'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Label 2</label>
                <input type="text" name="content[form_label_2]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_label_2'])) value="{{ $obj->content['form_label_2'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Label 3</label>
                <input type="text" name="content[form_label_3]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_label_3'])) value="{{ $obj->content['form_label_3'] }}" @endif>
            </div>
            <div class="form-group col-md-3">
                <label>Label 4</label>
                <input type="text" name="content[form_label_4]" class="form-control"
                    @if ($obj->content && isset($obj->content['form_label_4'])) value="{{ $obj->content['form_label_4'] }}" @endif>
            </div>

        </div>

        <div class="form-group col-md-12">
            <label>Button Text</label>
            <input type="text" name="content[contact_button_text]" class="form-control"
                @if ($obj->content && isset($obj->content['contact_button_text'])) value="{{ $obj->content['contact_button_text'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Success Message</label>
            <input type="text" name="content[success_message]" class="form-control"
                @if ($obj->content && isset($obj->content['success_message'])) value="{{ $obj->content['success_message'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Failed Message</label>
            <input type="text" name="content[failed_message]" class="form-control"
                @if ($obj->content && isset($obj->content['failed_message'])) value="{{ $obj->content['failed_message'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Loading Text</label>
            <input type="text" name="content[loading_text]" class="form-control"
                @if ($obj->content && isset($obj->content['loading_text'])) value="{{ $obj->content['loading_text'] }}" @endif>
        </div>

    </fieldset>
    <h3>logistics Section</h3>
    <fieldset>
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


        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[logistics_title]" class="form-control"
                @if ($obj->content && isset($obj->content['logistics_title'])) value="{{ $obj->content['logistics_title'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[logistics_description]" class="form-control editor">
        @if ($obj->content && isset($obj->content['logistics_description']))
{{ $obj->content['logistics_description'] }}
@endif
    </textarea>
        </div>

        @if ($obj->type == 'en')
            <a href="{{ route('admin.listing-items.index', [6]) }}" class="btn btn-primary"
                target="_blank">logistics listing </a>
            <input type="hidden" name="content[logistics_listing_id]" value="6">
        @else
            <a href="{{ route('admin.listing-items.index', [19]) }}" class="btn btn-primary"
                target="_blank">logistics listing </a>
            <input type="hidden" name="content[logistics_listing_id]" value="19">
        @endif


    </fieldset>
    <h3>Learn more Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[sub_learn_more_title]" class="form-control"
                @if ($obj->content && isset($obj->content['sub_learn_more_title'])) value="{{ $obj->content['sub_learn_more_title'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[learn_more_title]" class="form-control"
                @if ($obj->content && isset($obj->content['learn_more_title'])) value="{{ $obj->content['learn_more_title'] }}" @endif>
        </div>
        <div class="form-group col-md-6">
            <label>See More Label</label>
            <input type="text" name="content[see_more_label]" class="form-control"
                @if ($obj->content && isset($obj->content['see_more_label'])) value="{{ $obj->content['see_more_label'] }}" @endif>
        </div>


        @if ($obj->type == 'en')
            <a href="{{ route('admin.listing-items.index', [7]) }}" class="btn btn-primary"
                target="_blank">Operations learn more listing
            </a>
            <input type="hidden" name="content[operations_learn_more_listing_id]" value="7">
        @else
            <a href="{{ route('admin.listing-items.index', [20]) }}" class="btn btn-primary"
                target="_blank">Operations learn more listing
            </a>
            <input type="hidden" name="content[operations_learn_more_listing_id]" value="20">
        @endif

    </fieldset>

</div>
