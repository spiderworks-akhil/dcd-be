<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Home Banner</h3>
    <fieldset>
        <div class="form-group">
            @php
            $media_id_banner_video_1 = ($obj->content && isset($obj->content['media_id_banner_video_1'])) ? $obj->content['media_id_banner_video_1'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_banner_video_1,
            'title' => 'Banner Video',
            'popup_type' => 'single_image',
            'type' => 'Video',
            'holder_attr' => 'content[media_id_banner_video_1]',
            'id' => 'media_id_banner_video_1',
            'display' => 'horizontal'
            ])
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
            <label>Description</label>
            <textarea name="content[banner_description]" class="form-control">
                        @if($obj->content && isset($obj->content['banner_description']))
                            {{ $obj->content['banner_description'] }}
                        @endif
                    </textarea>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[banner_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['banner_button_text']))
                value="{{ $obj->content['banner_button_text'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[banner_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['banner_button_link']))
                value="{{ $obj->content['banner_button_link'] }}"
                @endif
                >
            </div>
        </div>
    </fieldset>

    <h3>Media Centre Top</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[media_centre_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_subtitle']))
                value="{{ $obj->content['media_centre_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[media_centre_title]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_title']))
                value="{{ $obj->content['media_centre_title'] }}"
                @endif
                >
            </div>
        </div>
        <div class="row">

            <div class="form-group col-md-6">
                <label>Explore Button text</label>
                <input type="text" name="content[top_explore_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['top_explore_button_text']))
                value="{{ $obj->content['top_explore_button_text'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Read More Button text</label>
                <input type="text" name="content[button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['button_text']))
                value="{{ $obj->content['button_text'] }}"
                @endif
                >
            </div>
            @if ($obj->type == 'ar')
                <div class="form-group col-md-6">
                    <label>Explore Button text</label>
                    <input type="text" name="content[top_explore_button_text_1]" class="form-control"
                        @if($obj->content && isset($obj->content['top_explore_button_text_1']))
                    value="{{ $obj->content['top_explore_button_text_1'] }}"
                    @endif
                    >
                </div>
            @endif

        <div class="form-group col-md-6">
            <label>Button link</label>
            <input type="text" name="content[button_link]" class="form-control"
                @if($obj->content && isset($obj->content['button_link']))
            value="{{ $obj->content['button_link'] }}"
            @endif
            >
        </div>
        <div class="col-md-12">
            <a class="btn btn-info" target="_blank" href="{{route('admin.news.index')}}">
                <i class="fas fa-list"></i> Our News
            </a>
        </div>
    </fieldset>

    <h3>Transport Solutions</h3>
    <fieldset>
        <div class="form-group">
            @php
            $media_id_transport_image = ($obj->content && isset($obj->content['media_id_transport_image'])) ? $obj->content['media_id_transport_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_transport_image,
            'title' => 'Transport Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_transport_image]',
            'id' => 'media_id_transport_image',
            'display' => 'horizontal'
            ])
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[transport_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['transport_subtitle']))
                value="{{ $obj->content['transport_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[transport_title]" class="form-control"
                    @if($obj->content && isset($obj->content['transport_title']))
                value="{{ $obj->content['transport_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[transport_description]" class="form-control">
                        @if($obj->content && isset($obj->content['transport_description']))
                            {{ $obj->content['transport_description'] }}
                        @endif
                    </textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[transport_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['transport_button_text']))
                value="{{ $obj->content['transport_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[transport_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['transport_button_link']))
                value="{{ $obj->content['transport_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>

    <h3>Railway Network </h3>
    <fieldset>
        <div class="form-group">
            @php
            $media_id_railway_network_image = ($obj->content && isset($obj->content['media_id_railway_network_image'])) ? $obj->content['media_id_railway_network_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_railway_network_image,
            'title' => 'Railway Network Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_railway_network_image]',
            'id' => 'media_id_railway_network_image',
            'display' => 'horizontal'
            ])
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[railway_network_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['railway_network_subtitle']))
                value="{{ $obj->content['railway_network_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[railway_network_title]" class="form-control"
                    @if($obj->content && isset($obj->content['railway_network_title']))
                value="{{ $obj->content['railway_network_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[railway_network_description]" class="form-control">
                        @if($obj->content && isset($obj->content['railway_network_description']))
                            {{ $obj->content['railway_network_description'] }}
                        @endif
                    </textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[railway_network_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['railway_network_button_text']))
                value="{{ $obj->content['railway_network_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[railway_network_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['railway_network_button_link']))
                value="{{ $obj->content['railway_network_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>Progress & Development </h3>
    <fieldset>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[process_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['process_subtitle']))
                value="{{ $obj->content['process_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[process_title]" class="form-control"
                    @if($obj->content && isset($obj->content['process_title']))
                value="{{ $obj->content['process_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group">
            @php
            $media_id_process_image = ($obj->content && isset($obj->content['media_id_process_image'])) ? $obj->content['media_id_process_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_process_image,
            'title' => 'Process Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_process_image]',
            'id' => 'media_id_process_image',
            'display' => 'horizontal'
            ])
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <div class="form-group">
                    @php
                    $media_id_process_block_1_image = ($obj->content && isset($obj->content['media_id_process_block_1_image'])) ? $obj->content['media_id_process_block_1_image'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                    'file' => $media_id_process_block_1_image,
                    'title' => 'Process Block 1 Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_process_block_1_image]',
                    'id' => 'media_id_process_block_1_image',
                    'display' => 'horizontal'
                    ])
                </div>
                <label>Sub Title</label>
                <input type="text" name="content[process_block_1_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_1_subtitle']))
                value="{{ $obj->content['process_block_1_subtitle'] }}"
                @endif
                >
                <label>Title</label>
                <input type="text" name="content[process_block_1_title]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_1_title']))
                value="{{ $obj->content['process_block_1_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    @php
                    $media_id_process_block_2_image = ($obj->content && isset($obj->content['media_id_process_block_2_image'])) ? $obj->content['media_id_process_block_2_image'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                    'file' => $media_id_process_block_2_image,
                    'title' => 'Process Block 2 Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_process_block_2_image]',
                    'id' => 'media_id_process_block_2_image',
                    'display' => 'horizontal'
                    ])
                </div>
                <label>Sub Title</label>
                <input type="text" name="content[process_block_2_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_2_subtitle']))
                value="{{ $obj->content['process_block_2_subtitle'] }}"
                @endif
                >
                <label>Title</label>
                <input type="text" name="content[process_block_2_title]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_2_title']))
                value="{{ $obj->content['process_block_2_title'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    @php
                    $media_id_process_block_3_image = ($obj->content && isset($obj->content['media_id_process_block_3_image'])) ? $obj->content['media_id_process_block_3_image'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                    'file' => $media_id_process_block_3_image,
                    'title' => 'Process Block 3 Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_process_block_3_image]',
                    'id' => 'media_id_process_block_3_image',
                    'display' => 'horizontal'
                    ])
                </div>
                <label>Sub Title</label>
                <input type="text" name="content[process_block_3_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_3_subtitle']))
                value="{{ $obj->content['process_block_3_subtitle'] }}"
                @endif
                >
                <label>Title</label>
                <input type="text" name="content[process_block_3_title]" class="form-control"
                    @if($obj->content && isset($obj->content['process_block_3_title']))
                value="{{ $obj->content['process_block_3_title'] }}"
                @endif
                >
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Social Text</label>
                <input type="text" name="content[process_social_text]" class="form-control"
                    @if($obj->content && isset($obj->content['process_social_text']))
                value="{{ $obj->content['process_social_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <div class="form-group">
                    @php
                    $media_id_process_social_image = ($obj->content && isset($obj->content['media_id_process_social_image'])) ? $obj->content['media_id_process_social_image'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                    'file' => $media_id_process_social_image,
                    'title' => 'Process Social Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_process_social_image]',
                    'id' => 'media_id_process_social_image',
                    'display' => 'horizontal'
                    ])
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Social Button Text</label>
                <input type="text" name="content[process_social_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['process_social_button_text']))
                value="{{ $obj->content['process_social_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Social Button Link</label>
                <input type="text" name="content[process_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['process_button_link']))
                value="{{ $obj->content['process_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>Projects </h3>
    <fieldset>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[projects_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['projects_subtitle']))
                value="{{ $obj->content['projects_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[projects_title]" class="form-control"
                    @if($obj->content && isset($obj->content['projects_title']))
                value="{{ $obj->content['projects_title'] }}"
                @endif
                >
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Play video</label>
            <input type="text" name="content[play_video]" class="form-control"
                @if($obj->content && isset($obj->content['play_video']))
            value="{{ $obj->content['play_video'] }}"
            @endif
            >
        </div>
        <div class="form-group">
            @php
            $media_id_projects_vimio_thumb_image = ($obj->content && isset($obj->content['media_id_projects_vimio_thumb_image'])) ? $obj->content['media_id_projects_vimio_thumb_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_projects_vimio_thumb_image,
            'title' => 'Project Vimio Thumb Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_projects_vimio_thumb_image]',
            'id' => 'media_id_projects_vimio_thumb_image',
            'display' => 'horizontal'
            ])
            <label>Vimio Link</label>
            <input type="text" name="content[projects_vimio_link]" class="form-control"
                @if($obj->content && isset($obj->content['projects_vimio_link']))
            value="{{ $obj->content['projects_vimio_link'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[projects_description]" class="form-control">
                        @if($obj->content && isset($obj->content['projects_description']))
                            {{ $obj->content['projects_description'] }}
                        @endif
                    </textarea>
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[projects_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['projects_button_text']))
                value="{{ $obj->content['projects_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[projects_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['projects_button_link']))
                value="{{ $obj->content['projects_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>Careers </h3>
    <fieldset>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[careers_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['careers_subtitle']))
                value="{{ $obj->content['careers_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[careers_title]" class="form-control"
                    @if($obj->content && isset($obj->content['careers_title']))
                value="{{ $obj->content['careers_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group">
            @php
            $media_id_careers_image = ($obj->content && isset($obj->content['media_id_careers_image'])) ? $obj->content['media_id_careers_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_careers_image,
            'title' => 'Careers Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_careers_image]',
            'id' => 'media_id_careers_image',
            'display' => 'horizontal'
            ])
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[careers_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['careers_button_text']))
                value="{{ $obj->content['careers_button_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[careers_button_link]" class="form-control"
                    @if($obj->content && isset($obj->content['careers_button_link']))
                value="{{ $obj->content['careers_button_link'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>Media Centre Bottom </h3>
    <fieldset>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[media_centre_bottom_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_subtitle']))
                value="{{ $obj->content['media_centre_bottom_subtitle'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" name="content[media_centre_bottom_title]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_title']))
                value="{{ $obj->content['media_centre_bottom_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[media_centre_bottom_description]" class="form-control">
                        @if($obj->content && isset($obj->content['media_centre_bottom_description']))
                            {{ $obj->content['media_centre_bottom_description'] }}
                        @endif
                    </textarea>
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <label>Text 1</label>
                <input type="text" name="content[media_centre_bottom_explore_text_1]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_text_1']))
                value="{{ $obj->content['media_centre_bottom_explore_text_1'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Link 1</label>
                <input type="text" name="content[media_centre_bottom_explore_link_1]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_link_1']))
                value="{{ $obj->content['media_centre_bottom_explore_link_1'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Text 2</label>
                <input type="text" name="content[media_centre_bottom_explore_text_2]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_text_2']))
                value="{{ $obj->content['media_centre_bottom_explore_text_2'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Link 2</label>
                <input type="text" name="content[media_centre_bottom_explore_link_2]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_link_2']))
                value="{{ $obj->content['media_centre_bottom_explore_link_2'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Text 3</label>
                <input type="text" name="content[media_centre_bottom_explore_text_3]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_text_3']))
                value="{{ $obj->content['media_centre_bottom_explore_text_3'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Link 3</label>
                <input type="text" name="content[media_centre_bottom_explore_link_3]" class="form-control"
                    @if($obj->content && isset($obj->content['media_centre_bottom_explore_link_3']))
                value="{{ $obj->content['media_centre_bottom_explore_link_3'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-6">
                <label>Explore Button text</label>
                <input type="text" name="content[bottom_explore_button_text]" class="form-control"
                    @if($obj->content && isset($obj->content['bottom_explore_button_text']))
                value="{{ $obj->content['bottom_explore_button_text'] }}"
                @endif
                >
            </div>
        </div>

    </fieldset>
    <h3>Bottom Banner</h3>
    <fieldset>

        <div class="form-group">
            @php
            $media_id_bottom_banner_logo_image = ($obj->content && isset($obj->content['media_id_bottom_banner_logo_image'])) ? $obj->content['media_id_bottom_banner_logo_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_bottom_banner_logo_image,
            'title' => 'Bottom logo Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_bottom_banner_logo_image]',
            'id' => 'media_id_bottom_banner_logo_image',
            'display' => 'horizontal'
            ])
        </div>

        <div class="form-group">
            @php
            $media_id_bottom_banner_image = ($obj->content && isset($obj->content['media_id_bottom_banner_image'])) ? $obj->content['media_id_bottom_banner_image'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_bottom_banner_image,
            'title' => 'Bottom Banner Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_bottom_banner_image]',
            'id' => 'media_id_bottom_banner_image',
            'display' => 'horizontal'
            ])
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[bottom_banner_description]" class="form-control">
                        @if($obj->content && isset($obj->content['bottom_banner_description']))
                            {{ $obj->content['bottom_banner_description'] }}
                        @endif
                    </textarea>
        </div>




    </fieldset>
    <h3>Contact Us</h3>
    <fieldset>

        <div class="row">

            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[conatact_us_title]" class="form-control"
                    @if($obj->content && isset($obj->content['conatact_us_title']))
                value="{{ $obj->content['conatact_us_title'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[conatact_us_description]" class="form-control">
                        @if($obj->content && isset($obj->content['conatact_us_description']))
                            {{ $obj->content['conatact_us_description'] }}
                        @endif
                    </textarea>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[conatact_usbutton_text]" class="form-control"
                    @if($obj->content && isset($obj->content['conatact_usbutton_text']))
                value="{{ $obj->content['conatact_usbutton_text'] }}"
                @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Button Link</label>
                <input type="text" name="content[conatact_usbutton_link]" class="form-control"
                    @if($obj->content && isset($obj->content['conatact_usbutton_link']))
                value="{{ $obj->content['conatact_usbutton_link'] }}"
                @endif
                >
            </div>
        </div>



    </fieldset>

    <h3>Social Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Social Text</label>
            <input type="text" name="content[social_text]" class="form-control"
                @if($obj->content && isset($obj->content['social_text']))
            value="{{ $obj->content['social_text'] }}"
            @endif
            >
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label>Twitter</label>
                <input type="text" name="content[twitter]" class="form-control"
                    @if($obj->content && isset($obj->content['twitter']))
                value="{{ $obj->content['twitter'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-2">
                <label>Facebook</label>
                <input type="text" name="content[facebook]" class="form-control"
                    @if($obj->content && isset($obj->content['facebook']))
                value="{{ $obj->content['facebook'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-2">
                <label>Instagram</label>
                <input type="text" name="content[instagram]" class="form-control"
                    @if($obj->content && isset($obj->content['instagram']))
                value="{{ $obj->content['instagram'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-2">
                <label>TikTok</label>
                <input type="text" name="content[tiktok]" class="form-control"
                    @if($obj->content && isset($obj->content['tiktok']))
                value="{{ $obj->content['tiktok'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-2">
                <label>YouTube</label>
                <input type="text" name="content[youtube]" class="form-control"
                    @if($obj->content && isset($obj->content['youtube']))
                value="{{ $obj->content['youtube'] }}"
                @endif
                >
            </div>

            <div class="form-group col-md-2">
                <label>LinkedIn</label>
                <input type="text" name="content[linkedin]" class="form-control"
                    @if($obj->content && isset($obj->content['linkedin']))

          value="{{ $obj->content['linkedin'] }}"
                @endif
                >
            </div>
        </div>
    </fieldset>

</div>
