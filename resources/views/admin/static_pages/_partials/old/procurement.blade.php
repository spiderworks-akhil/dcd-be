<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <h3>Top Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[title_3]" class="form-control"
                @if ($obj->content && isset($obj->content['title_3'])) value="{{ $obj->content['title_3'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_2]" class="form-control"
                @if ($obj->content && isset($obj->content['title_2'])) value="{{ $obj->content['title_2'] }}" @endif>
        </div>


        <div class="form-group col-md-12">
            <label> Description</label>
            <textarea name="content[banner_shortdescription]" class="form-control ">
@if ($obj->content && isset($obj->content['banner_shortdescription']))
{{ $obj->content['banner_shortdescription'] }}
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
    </fieldset>

    <h3>Supplier registration Section</h3>
    <fieldset>

        @php
            $media_id_works_first_featured_image1 =
                $obj->content && isset($obj->content['media_id_works_first_featured_image1'])
                    ? $obj->content['media_id_works_first_featured_image1']
                    : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_works_first_featured_image1,
            'title' => 'featured Image ',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_works_first_featured_image1]',
            'id' => 'media_id_works_first_featured_image1',
            'display' => 'horizontal',
        ])
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[title_6]" class="form-control"
                @if ($obj->content && isset($obj->content['title_6'])) value="{{ $obj->content['title_6'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_7]" class="form-control"
                @if ($obj->content && isset($obj->content['title_7'])) value="{{ $obj->content['title_7'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url text</label>
            <input type="text" name="content[title_8]" class="form-control"
                @if ($obj->content && isset($obj->content['title_8'])) value="{{ $obj->content['title_8'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url</label>
            <input type="text" name="content[url]" class="form-control"
                @if ($obj->content && isset($obj->content['url'])) value="{{ $obj->content['url'] }}" @endif>

    </fieldset>




    <h3>Supplier Code of Conduct Section</h3>
    <fieldset>

        @php
            $media_id_works_first_featured_image2 =
                $obj->content && isset($obj->content['media_id_works_first_featured_image2'])
                    ? $obj->content['media_id_works_first_featured_image2']
                    : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_works_first_featured_image2,
            'title' => 'featured Image ',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_works_first_featured_image2]',
            'id' => 'media_id_works_first_featured_image2',
            'display' => 'horizontal',
        ])
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[title_0]" class="form-control"
                @if ($obj->content && isset($obj->content['title_0'])) value="{{ $obj->content['title_0'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_01]" class="form-control"
                @if ($obj->content && isset($obj->content['title_01'])) value="{{ $obj->content['title_01'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url text</label>
            <input type="text" name="content[title_02]" class="form-control"
                @if ($obj->content && isset($obj->content['title_02'])) value="{{ $obj->content['title_02'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url</label>
            <input type="text" name="content[url_1]" class="form-control"
                @if ($obj->content && isset($obj->content['url_1'])) value="{{ $obj->content['url_1'] }}" @endif>

    </fieldset>


    <h3>View procurement FAQs Section</h3>
    <fieldset>

        @php
            $media_id_works_first_featured_image3 =
                $obj->content && isset($obj->content['media_id_works_first_featured_image3'])
                    ? $obj->content['media_id_works_first_featured_image3']
                    : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_works_first_featured_image3,
            'title' => 'featured Image ',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_works_first_featured_image3]',
            'id' => 'media_id_works_first_featured_image3',
            'display' => 'horizontal',
        ])
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[title_03]" class="form-control"
                @if ($obj->content && isset($obj->content['title_03'])) value="{{ $obj->content['title_03'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_04]" class="form-control"
                @if ($obj->content && isset($obj->content['title_04'])) value="{{ $obj->content['title_04'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url text</label>
            <input type="text" name="content[title_05]" class="form-control"
                @if ($obj->content && isset($obj->content['title_05'])) value="{{ $obj->content['title_05'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Url</label>
            <input type="text" name="content[url_2]" class="form-control"
                @if ($obj->content && isset($obj->content['url_2'])) value="{{ $obj->content['url_2'] }}" @endif>

    </fieldset>

    <h3>self-registrants Section </h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label> Title</label>
            <input type="text" name="content[title_06]" class="form-control"
                @if ($obj->content && isset($obj->content['title_06'])) value="{{ $obj->content['title_06'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label> Description</label>
            <textarea name="content[banner_shortdescription01]" class="form-control ">
@if ($obj->content && isset($obj->content['banner_shortdescription01']))
{{ $obj->content['banner_shortdescription01'] }}
@endif
</textarea>
        </div>

        <div class="form-group col-md-12">
            <label>Email text</label>
            <input type="text" name="content[email]" class="form-control"
                @if ($obj->content && isset($obj->content['email'])) value="{{ $obj->content['email'] }}" @endif>


            <div class="form-group col-md-12">
                <label>Url text</label>
                <input type="text" name="content[title_07]" class="form-control"
                    @if ($obj->content && isset($obj->content['title_07'])) value="{{ $obj->content['title_07'] }}" @endif>
            </div>
            <div class="form-group col-md-12">
                <label>Url</label>
                <input type="text" name="content[url_4]" class="form-control"
                    @if ($obj->content && isset($obj->content['url_4'])) value="{{ $obj->content['url_4'] }}" @endif>
    </fieldset>
    <h3>Statement of Principles Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[title_08]" class="form-control"
                @if ($obj->content && isset($obj->content['title_08'])) value="{{ $obj->content['title_08'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_09]" class="form-control"
                @if ($obj->content && isset($obj->content['title_09'])) value="{{ $obj->content['title_09'] }}" @endif>
        </div>
        <div class="card-body row">
            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea name="content[section_description_first]" class="form-control editor">
                    @if ($obj->content && isset($obj->content['section_description_first']))
{{ $obj->content['section_description_first'] }}
@endif
                </textarea>
            </div>
        </div>
    </fieldset>
    <h3>Visit Us</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[visit_us_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['visit_us_title'])) value="{{ $obj->content['visit_us_title'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[visit_us_subtitle]" class="form-control"
                    @if ($obj->content && isset($obj->content['visit_us_subtitle'])) value="{{ $obj->content['visit_us_subtitle'] }}" @endif>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[visit_us_short_description]" class="form-control">
                @if ($obj->content && isset($obj->content['visit_us_short_description']))
{{ $obj->content['visit_us_short_description'] }}
@endif
            </textarea>
        </div>

        <div class="form-group col-md-12">
            <label>Location Title</label>
            <input type="text" name="content[visit_us_location_title]" class="form-control"
                @if ($obj->content && isset($obj->content['visit_us_location_title'])) value="{{ $obj->content['visit_us_location_title'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Location Address</label>
            <textarea name="content[visit_us_location_address]" class="form-control">
                @if ($obj->content && isset($obj->content['visit_us_location_address']))
{{ $obj->content['visit_us_location_address'] }}
@endif
            </textarea>
        </div>
        <div class="form-group col-md-12">
            <label>Location Button Text</label>
            <input type="text" name="content[visit_us_location_button_text]" class="form-control"
                @if ($obj->content && isset($obj->content['visit_us_location_button_text'])) value="{{ $obj->content['visit_us_location_button_text'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Location Map Link</label>
            <input type="text" name="content[visit_us_location_map_link]" class="form-control"
                @if ($obj->content && isset($obj->content['visit_us_location_map_link'])) value="{{ $obj->content['visit_us_location_map_link'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Location Map </label>
            <textarea name="content[visit_us_location_map]" class="form-control">
                @if ($obj->content && isset($obj->content['visit_us_location_map']))
{{ $obj->content['visit_us_location_map'] }}
@endif
            </textarea>
        </div>
    </fieldset>
    <h3>Learn More Section</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[learn_more_title]" class="form-control"
                    @if ($obj->content && isset($obj->content['learn_more_title'])) value="{{ $obj->content['learn_more_title'] }}" @endif>
            </div>
            <div class="form-group col-md-6">
                <label>See More Label</label>
                <input type="text" name="content[see_more_label]" class="form-control"
                    @if ($obj->content && isset($obj->content['see_more_label'])) value="{{ $obj->content['see_more_label'] }}" @endif>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[learn_more_description]" class="form-control ">
                        @if ($obj->content && isset($obj->content['learn_more_description']))
{{ $obj->content['learn_more_description'] }}
@endif
                    </textarea>
        </div>
        <div class="form-group col-md-12">
            @if ($obj->type == 'en')
                <a href="{{ url('sw-admin/listing-items/12') }}" target="_blank" class="btn btn-primary">View</a>
                <input type="hidden" name="content[learn_more_listing_id]" value="12">
            @else
                <a href="{{ url('sw-admin/listing-items/23') }}" target="_blank" class="btn btn-primary">View</a>
                <input type="hidden" name="content[learn_more_listing_id]" value="23">
            @endif
        </div>
    </fieldset>


</div>
