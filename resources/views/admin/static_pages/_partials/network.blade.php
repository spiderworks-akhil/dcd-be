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

    <h3>Map Image</h3>
    <fieldset>
        <div class="form-group">
            @php
                $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_1,
                'title' => 'Map Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_1]',
                'id' => 'map_image',
                'display' => 'horizontal'
            ])
        </div>
    </fieldset>
    <h3>Middle Content</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_2']))
                            value="{{ $obj->content['sub_title_2'] }}"
                        @endif>
                </div>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['title_2']))
                            value="{{ $obj->content['title_2'] }}"
                        @endif>
                </div>

                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_2']))
                            {{ $obj->content['description_2'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_3]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_3']))
                            {{ $obj->content['description_3'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @php
                        $media_id_2 = ($obj->content && isset($obj->content['media_id_2'])) ? $obj->content['media_id_2'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_2,
                        'title' => 'Network Video',
                        'popup_type' => 'single_image',
                        'type' => 'Video',
                        'holder_attr' => 'content[media_id_2]',
                        'id' => 'network_video',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>network Updates</h3>

            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_3]" class="form-control"
                        @if($obj->content && isset($obj->content['title_3']))
                            value="{{ $obj->content['title_3'] }}"
                        @endif >
                </div>

                <div class="form-group col-md-12">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_3]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_3']))
                            value="{{ $obj->content['sub_title_3'] }}"
                        @endif >

                </div>

                <div class="form-group col-md-12">
                    <label>Button</label>
                    <input type="text" name="content[button_1]" class="form-control"
                        @if($obj->content && isset($obj->content['button_1']))
                            value="{{ $obj->content['button_1'] }}"
                        @endif >
                </div>

                <div class="form-group col-md-12">
                    <label>Button url</label>
                    <input type="text" name="content[button_1_url]" class="form-control"
                        @if($obj->content && isset($obj->content['button_1_url']))
                            value="{{ $obj->content['button_1_url'] }}"
                        @endif >
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="content[title_4]" class="form-control"
                            @if($obj->content && isset($obj->content['title_4']))
                                value="{{ $obj->content['title_4'] }}"
                            @endif
                        >
                    </div>

                    <div class="col-md-6">
                        <label>Sub Title</label>
                        <input type="text" name="content[sub_title_4]" class="form-control"
                            @if($obj->content && isset($obj->content['sub_title_4']))
                                value="{{ $obj->content['sub_title_4'] }}"
                            @endif
                        >
                    </div>
                </div>

            <div class="form-group row">

                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" name="content[title_5]" class="form-control"
                        @if($obj->content && isset($obj->content['title_5']))
                            value="{{ $obj->content['title_5'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-6">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_5]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_5']))
                            value="{{ $obj->content['sub_title_5'] }}"
                        @endif
                    >
                </div>
            </div>

            <div class="form-group row">

                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" name="content[title_6]" class="form-control"
                        @if($obj->content && isset($obj->content['title_6']))
                            value="{{ $obj->content['title_6'] }}"
                        @endif >
                </div>

                <div class="form-group col-md-6">
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_6]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_6']))
                            value="{{ $obj->content['sub_title_6'] }}"
                        @endif>
                </div>
            </div>


                <div class="form-group col-md-12">
                    <label>Year</label>
                    <input type="text" name="content[year]" class="form-control"
                        @if($obj->content && isset($obj->content['year']))
                            value="{{ $obj->content['year'] }}"
                        @endif>
                </div>

            </fieldset>

            <h3>Bottom Content</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_7]" class="form-control"
                        @if($obj->content && isset($obj->content['title_7']))
                            value="{{ $obj->content['title_7'] }}"
                        @endif >
                </div>


                <div class="form-group col-md-12">
                    <label>Button</label>
                    <input type="text" name="content[button_2]" class="form-control"
                        @if($obj->content && isset($obj->content['button_2']))
                            value="{{ $obj->content['button_2'] }}"
                        @endif >
                </div>

                <div class="form-group col-md-12">
                    <label>Button url</label>
                    <input type="text" name="content[button_2_url]" class="form-control"
                        @if($obj->content && isset($obj->content['button_2_url']))
                            value="{{ $obj->content['button_2_url'] }}"
                        @endif >
                </div>

            </fieldset>
            <h3>Learn More Section</h3>
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
                <div class="form-group col-md-12">
                     @if ($obj->type == 'en')
                        <a href="{{url('sw-admin/listing-items/11')}}" target="_blank" class="btn btn-primary">View</a>
                        <input type="hidden" name="content[learn_more_listing_id]" value="11">
                    @else
                        <a href="{{url('sw-admin/listing-items/24')}}" target="_blank" class="btn btn-primary">View</a>
                        <input type="hidden" name="content[learn_more_listing_id]" value="24">
                    @endif
                </div>
            </fieldset>

        <h3>Network Images</h3>
        <fieldset>
            <div class="form-group">
                @php
                    $media_id_3 = ($obj->content && isset($obj->content['media_id_3'])) ? $obj->content['media_id_3'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_3,
                    'title' => 'Network Image1',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_3]',
                    'id' => 'network_image1',
                    'display' => 'horizontal'
                ])

            </div>

            <div class="form-group">
                @php
                    $media_id_4 = ($obj->content && isset($obj->content['media_id_4'])) ? $obj->content['media_id_4'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_4,
                    'title' => 'Network Image2',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_4]',
                    'id' => 'network_image2',
                    'display' => 'horizontal'
                ])
            </div>

        </fieldset>

</div>
