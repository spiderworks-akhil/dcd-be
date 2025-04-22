<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Press Release</h3>
    <fieldset>
        <div class="row">

            <div class="form-group col-md-12">
                <label>Heading</label>
                <input type="text" name="content[press_release]" class="form-control"
                    @if($obj->content && isset($obj->content['press_release']))
                value="{{ $obj->content['press_release'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[top_title]" class="form-control"
                    @if($obj->content && isset($obj->content['top_title']))
                value="{{ $obj->content['top_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[top_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['top_subtitle']))
                value="{{ $obj->content['top_subtitle'] }}"
                @endif
                >
            </div>
        </div>
        <div class="form-group col-md-12">
                <label>Small Title</label>
                <input type="text" name="content[top_small_title]" class="form-control"
                    @if($obj->content && isset($obj->content['top_small_title']))
                value="{{ $obj->content['top_small_title'] }}"
                @endif
                >
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Previous</label>
                <input type="text" name="content[previous]" class="form-control"
                    @if($obj->content && isset($obj->content['previous']))
                value="{{ $obj->content['previous'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Next</label>
                <input type="text" name="content[next]" class="form-control"
                    @if($obj->content && isset($obj->content['next']))
                value="{{ $obj->content['next'] }}"
                @endif
                >
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Press Release </h5>
                        <p></p>
                        <a target="_blank" href="{{route('admin.news.index')}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <h3>In The News</h3>
    <fieldset>
        <div class="row">

            <div class="form-group col-md-12">
                <label>Heading</label>
                <input type="text" name="content[in_the_news]" class="form-control"
                    @if($obj->content && isset($obj->content['in_the_news']))
                value="{{ $obj->content['in_the_news'] }}"
                @endif
                >
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">In The News</h5>
                     @if ($obj->type == 'en')
                        <a href="{{url('sw-admin/listing-items/4')}}" target="_blank" class="btn btn-primary">View</a>
                        <input type="hidden" name="content[media_centre_in_the_news_listing_id]" value="4">
                    @else
                        <a href="{{url('sw-admin/listing-items/21')}}" target="_blank" class="btn btn-primary">View</a>
                        <input type="hidden" name="content[media_centre_in_the_news_listing_id]" value="21">
                    @endif

                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <h3>Video Gallery</h3>
    <fieldset>
        <div class="row">

            <div class="form-group col-md-12">
                <label>Heading</label>
                <input type="text" name="content[video_gallery]" class="form-control"
                    @if($obj->content && isset($obj->content['video_gallery']))
                value="{{ $obj->content['video_gallery'] }}"
                @endif
                >
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Video Gallery</h5>
                        @if ($obj->type == 'en')
                            <a href="{{route('admin.galleries.edit',[encrypt(1)])}}" target="_blank" class="btn btn-primary">View</a>
                        @else
                            <a href="{{route('admin.galleries.edit',[encrypt(5)])}}" target="_blank" class="btn btn-primary">View</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <h3>PR Contacts</h3>
    <fieldset>


        <div class="form-group col-md-12">
            <label>Heading</label>
            <input type="text" name="content[pr_contacts]" class="form-control"
                @if($obj->content && isset($obj->content['pr_contacts']))
            value="{{ $obj->content['pr_contacts'] }}"
            @endif
            >
        </div>

        <div class="form-group">
            @php
            $media_id_pr_contact_logo_image = ($obj->content && isset($obj->content['media_id_pr_contact_logo_image'])) ? $obj->content['media_id_pr_contact_logo_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_pr_contact_logo_image,
            'title' => 'Bottom Banner Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_pr_contact_logo_image]',
            'id' => 'media_id_pr_contact_logo_image',
            'display' => 'horizontal'
            ])
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[pr_contact_title]" class="form-control"
                @if($obj->content && isset($obj->content['pr_contact_title']))
            value="{{ $obj->content['pr_contact_title'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Text</label>
            <input type="text" name="content[pr_contact_text]" class="form-control"
                @if($obj->content && isset($obj->content['pr_contact_text']))
            value="{{ $obj->content['pr_contact_text'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Email</label>
            <input type="text" name="content[pr_contact_email]" class="form-control"
                @if($obj->content && isset($obj->content['pr_contact_email']))
            value="{{ $obj->content['pr_contact_email'] }}"
            @endif
            >
        </div>
    </fieldset>

    <h3>Media Enquiries</h3>
    <fieldset>
        <div class="form-group">
            @php
            $media_id_enquiries_image = ($obj->content && isset($obj->content['media_id_enquiries_image'])) ? $obj->content['media_id_enquiries_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_enquiries_image,
            'title' => 'Bottom Banner Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_enquiries_image]',
            'id' => 'media_id_enquiries_image',
            'display' => 'horizontal'
            ])
        </div>

        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[enquiries_title]" class="form-control"
                @if($obj->content && isset($obj->content['enquiries_title']))
            value="{{ $obj->content['enquiries_title'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[enquiries_description]" class="form-control">
                        @if($obj->content && isset($obj->content['enquiries_description']))
                            {{ $obj->content['enquiries_description'] }}
                        @endif
                    </textarea>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[enquiries_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['enquiries_button_text']))
                value="{{ $obj->content['enquiries_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[enquiries_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['enquiries_button_link']))
                value="{{ $obj->content['enquiries_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>More in Resource Centre</h3>
    <fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[more_in_resource_centre_title]" class="form-control"
            @if($obj->content && isset($obj->content['more_in_resource_centre_title']))
        value="{{ $obj->content['more_in_resource_centre_title'] }}"
        @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Text</label>
        <input type="text" name="content[more_in_resource_centre_text]" class="form-control"
            @if($obj->content && isset($obj->content['more_in_resource_centre_text']))
        value="{{ $obj->content['more_in_resource_centre_text'] }}"
        @endif
        >
    </div>
    <div class="row">
    <div class="form-group col-md-6">
                        <label>See More Label</label>
                        <input type="text" name="content[see_more_label]" class="form-control"
                            @if($obj->content && isset($obj->content['see_more_label']))
                                value="{{ $obj->content['see_more_label'] }}"
                            @endif >
                    </div>
    <div class="form-group col-md-6">
        @if ($obj->type == 'en')
            <a href="{{url('sw-admin/listing-items/3')}}" target="_blank" class="btn btn-primary">View</a>
            <input type="hidden" name="content[media_centre_more_in_resource_centre_listing_id]" value="3">
        @else
            <a href="{{url('sw-admin/listing-items/22')}}" target="_blank" class="btn btn-primary">View</a>
            <input type="hidden" name="content[media_centre_more_in_resource_centre_listing_id]" value="22">
        @endif
    </div>
    </div>

    </fieldset>


</div>
