
        <div id="form-vertical" class="form-horizontal form-wizard-wrapper">

            <h3>Top Content</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_1]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_1']))
                            value="{{ $obj->content['sub_title_1'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_1]" class="form-control"
                        @if($obj->content && isset($obj->content['title_1']))
                            value="{{ $obj->content['title_1'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Short Description</label>
                    <textarea name="content[description_1]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_1']))
                            {{ $obj->content['description_1'] }}
                        @endif
                    </textarea>
                </div>

            </fieldset>

            <h3>About Video</h3>
            <fieldset>
                <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'About Video',
                        'popup_type' => 'single_image',
                        'type' => 'Video',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'about_video',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Our Story</h3>
            <fieldset>


                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_2']))
                            value="{{ $obj->content['sub_title_2'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['title_2']))
                            value="{{ $obj->content['title_2'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label> Content</label>
                    <textarea name="content[description_2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_2']))
                            {{ $obj->content['description_2'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label> Content</label>
                    <textarea name="content[description_3]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_3']))
                            {{ $obj->content['description_3'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Caption</label>
                    <input type="text" name="content[caption_1]" class="form-control"
                        @if($obj->content && isset($obj->content['caption_1']))
                            value="{{ $obj->content['caption_1'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Url</label>
                    <input type="text" name="content[url]" class="form-control"
                        @if($obj->content && isset($obj->content['url']))
                            value="{{ $obj->content['url'] }}"
                        @endif
                    >
                </div>

                <div class="form-group">
                    @php
                        $media_id_2 = ($obj->content && isset($obj->content['media_id_2'])) ? $obj->content['media_id_2'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_2,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_2]',
                        'id' => 'about_image_1',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Principles</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Principles Sub Title</label>
                    <input type="text" name="content[sub_title_3]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_3']))
                            value="{{ $obj->content['sub_title_3'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Principles Title</label>
                    <input type="text" name="content[title_3]" class="form-control"
                        @if($obj->content && isset($obj->content['title_3']))
                            value="{{ $obj->content['title_3'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label> Title</label>
                    <input type="text" name="content[title_4]" class="form-control"
                        @if($obj->content && isset($obj->content['title_4']))
                            value="{{ $obj->content['title_4'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_4]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_4']))
                            {{ $obj->content['description_4'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @php
                        $media_id_3 = ($obj->content && isset($obj->content['media_id_3'])) ? $obj->content['media_id_3'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_3,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_3]',
                        'id' => 'about_image_2',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group col-md-12">
                    <label> Title</label>
                    <input type="text" name="content[title_5]" class="form-control"
                        @if($obj->content && isset($obj->content['title_5']))
                            value="{{ $obj->content['title_5'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_5]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_5']))
                            {{ $obj->content['description_5'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @php
                        $media_id_4 = ($obj->content && isset($obj->content['media_id_4'])) ? $obj->content['media_id_4'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_4,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_4]',
                        'id' => 'about_image_3',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group col-md-12">
                    <label> Title</label>
                    <input type="text" name="content[title_6]" class="form-control"
                        @if($obj->content && isset($obj->content['title_6']))
                            value="{{ $obj->content['title_6'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_6]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_6']))
                            {{ $obj->content['description_6'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @php
                        $media_id_5 = ($obj->content && isset($obj->content['media_id_5'])) ? $obj->content['media_id_5'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_5,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_5]',
                        'id' => 'about_image_4',
                        'display' => 'horizontal'
                    ])
                </div>

            </fieldset>

            <h3>Benefits </h3>
            <fieldset>
                <div class="form-group">
                    @php
                        $media_id_6 = ($obj->content && isset($obj->content['media_id_6'])) ? $obj->content['media_id_6'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_6,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_6]',
                        'id' => 'about_image_5',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group col-md-12">
                    <label> Title</label>
                    <input type="text" name="content[title_7]" class="form-control"
                        @if($obj->content && isset($obj->content['title_7']))
                            value="{{ $obj->content['title_7'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_7]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_7']))
                            value="{{ $obj->content['sub_title_7'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Button</label>
                    <input type="text" name="content[button_1]" class="form-control"
                        @if($obj->content && isset($obj->content['button_1']))
                            value="{{ $obj->content['button_1'] }}"
                        @endif>
                </div>

                <div class="form-group col-md-12">
                    <label>Button url</label>
                    <input type="text" name="content[button_1_url]" class="form-control"
                        @if($obj->content && isset($obj->content['button_1_url']))
                            value="{{ $obj->content['button_1_url'] }}"
                        @endif >
                </div>

            </fieldset>

            <h3>careers</h3>
            <fieldset>

                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_8]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_8']))
                            value="{{ $obj->content['sub_title_8'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label> Title</label>
                    <input type="text" name="content[title_8]" class="form-control"
                        @if($obj->content && isset($obj->content['title_8']))
                            value="{{ $obj->content['title_8'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_8]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_8']))
                            {{ $obj->content['description_8'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Button</label>
                    <input type="text" name="content[button_2]" class="form-control"
                        @if($obj->content && isset($obj->content['button_2']))
                            value="{{ $obj->content['button_2'] }}"
                        @endif
                    >
                </div>


                <div class="form-group col-md-12">
                    <label>Button url</label>
                    <input type="text" name="content[button_2_url]" class="form-control"
                        @if($obj->content && isset($obj->content['button_2_url']))
                            value="{{ $obj->content['button_2_url'] }}"
                        @endif >
                </div>

                <div class="form-group">
                    @php
                        $media_id_7 = ($obj->content && isset($obj->content['media_id_7'])) ? $obj->content['media_id_7'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_7,
                        'title' => 'About Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_7]',
                        'id' => 'about_image_6',
                        'display' => 'horizontal'
                    ])
                </div>

            </fieldset>

            <h3>Learn more Section</h3>
            <fieldset>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="content[learn_more_title]" class="form-control"
                            @if($obj->content && isset($obj->content['learn_more_title']))
                                value="{{ $obj->content['learn_more_title'] }}"
                            @endif >
                    </div>
                    <div class="form-group col-md-6">
                        <label>See More Label</label>
                        <input type="text" name="content[see_more_label]" class="form-control"
                            @if($obj->content && isset($obj->content['see_more_label']))
                                value="{{ $obj->content['see_more_label'] }}"
                            @endif >
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label>Description</label>
                    <textarea name="content[learn_more_description]" class="form-control ">
                        @if($obj->content && isset($obj->content['learn_more_description']))
                            {{ $obj->content['learn_more_description'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @if ($obj->type == 'en')
                        <a href="{{route('admin.listing-items.index',[13])}}" class="btn btn-primary" target="_blank">About learn more listing
                        </a>
                        <input type="hidden" name="content[about_learn_more_listing_id]" value="13">
                    @else
                        <a href="{{route('admin.listing-items.index',[30])}}" class="btn btn-primary" target="_blank">About learn more listing
                        </a>
                        <input type="hidden" name="content[about_learn_more_listing_id]" value="30">
                    @endif

                    </div>
            </fieldset>

        </div>
