
        <div id="form-vertical" class="form-horizontal form-wizard-wrapper">

            <h3>Top Content</h3>
            <fieldset>

                <div class="form-group col-md-12">
                    <label>Short Title</label>
                    <input type="text" name="content[short_title_1]" class="form-control"
                        @if($obj->content && isset($obj->content['short_title_1']))
                            value="{{ $obj->content['short_title_1'] }}"
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

                <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'career video',
                        'popup_type' => 'single_image',
                        'type' => 'Video',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'content_image_1',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Careers at Etihad Rail</h3>
            <fieldset>

                <div class="form-group col-md-12">
                    <label>Short Title</label>
                    <input type="text" name="content[short_title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['short_title_2']))
                            value="{{ $obj->content['short_title_2'] }}"
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
                    <label>Content</label>
                    <textarea name="content[career_description_1]" class="form-control editor">
                        @if($obj->content && isset($obj->content['career_description_1']))
                            {{ $obj->content['career_description_1'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[career_description_2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['career_description_2']))
                            {{ $obj->content['career_description_2'] }}
                        @endif
                    </textarea>
                </div>

            </fieldset>

            <h3>Banner </h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_3]" class="form-control"
                        @if($obj->content && isset($obj->content['title_3']))
                            value="{{ $obj->content['title_3'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[banner_description]" class="form-control editor">
                        @if($obj->content && isset($obj->content['banner_description']))
                            {{ $obj->content['banner_description'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group col-md-12">
                    <label>Button Text</label>
                    <input type="text" name="content[button_text_1]" class="form-control"
                        @if($obj->content && isset($obj->content['button_text_1']))
                            value="{{ $obj->content['button_text_1'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Button Url</label>
                    <input type="text" name="content[button_url_1]" class="form-control"
                        @if($obj->content && isset($obj->content['button_url_1']))
                            value="{{ $obj->content['button_url_1'] }}"
                        @endif
                    >
                </div>

                <div class="form-group">
                    @php
                        $media_id_2 = ($obj->content && isset($obj->content['media_id_2'])) ? $obj->content['media_id_2'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_2,
                        'title' => 'Banner Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_2]',
                        'id' => 'content_image_2',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Supporting National Talent </h3>

            <fieldset>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_4]" class="form-control"
                        @if($obj->content && isset($obj->content['title_4']))
                            value="{{ $obj->content['title_4'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_2']))
                            {{ $obj->content['description_2'] }}
                        @endif
                    </textarea>
                </div>

                <div class="form-group">
                    @php
                        $media_id_3 = ($obj->content && isset($obj->content['media_id_3'])) ? $obj->content['media_id_3'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_3,
                        'title' => 'Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_3]',
                        'id' => 'content_image_3',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Growth of nation</h3>

            <fieldset>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_5]" class="form-control"
                        @if($obj->content && isset($obj->content['title_5']))
                            value="{{ $obj->content['title_5'] }}"
                        @endif
                    >
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
                        $media_id_4 = ($obj->content && isset($obj->content['media_id_4'])) ? $obj->content['media_id_4'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_4,
                        'title' => 'Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_4]',
                        'id' => 'content_image_4',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Making an impact</h3>

            <fieldset>

                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_6]" class="form-control"
                        @if($obj->content && isset($obj->content['title_6']))
                            value="{{ $obj->content['title_6'] }}"
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
                        $media_id_5 = ($obj->content && isset($obj->content['media_id_5'])) ? $obj->content['media_id_5'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_5,
                        'title' => 'Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_5]',
                        'id' => 'content_image_5',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Banner Image</h3>

            <fieldset>
                <div class="form-group">
                    @php
                        $media_id_6 = ($obj->content && isset($obj->content['media_id_6'])) ? $obj->content['media_id_6'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_6,
                        'title' => 'Banner Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_6]',
                        'id' => 'content_image_6',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Bottom Content</h3>

             <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_7]" class="form-control"
                        @if($obj->content && isset($obj->content['title_7']))
                            value="{{ $obj->content['title_7'] }}"
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

             </fieldset>

             <h3>Search available roles</h3>

             <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_8]" class="form-control"
                        @if($obj->content && isset($obj->content['title_8']))
                            value="{{ $obj->content['title_8'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Short Title</label>
                    <input type="text" name="content[short_title_8]" class="form-control"
                        @if($obj->content && isset($obj->content['short_title_8']))
                            value="{{ $obj->content['short_title_8'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Button Text</label>
                    <input type="text" name="content[button_text_2]" class="form-control"
                        @if($obj->content && isset($obj->content['button_text_2']))
                            value="{{ $obj->content['button_text_2'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Button Url</label>
                    <input type="text" name="content[button_url_2]" class="form-control"
                        @if($obj->content && isset($obj->content['button_url_2']))
                            value="{{ $obj->content['button_url_2'] }}"
                        @endif
                    >
                </div>

             </fieldset>

        </div>
