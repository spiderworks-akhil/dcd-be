
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

            <h3>Chairman</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Name</label>
                    <input type="text" name="content[name]" class="form-control"
                        @if($obj->content && isset($obj->content['name']))
                            value="{{ $obj->content['name'] }}"
                        @endif
                    >
                </div>

                <div class="form-group col-md-12">
                    <label>Designation</label>
                    <input type="text" name="content[designation]" class="form-control"
                        @if($obj->content && isset($obj->content['designation']))
                            value="{{ $obj->content['designation'] }}"
                        @endif
                    >
                </div>

                <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'Chairman Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'chairman_image',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Members</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    @if ($obj->type == 'en')
                        <input type="hidden" name="content[members_listing_id]" value="8">
                        <a href="{{route('admin.listing-items.index',[8])}}" class="btn btn-sm btn-danger" target="_blank" > Add Members </a>
                    @else
                         <input type="hidden" name="content[members_listing_id]" value="28">
                        <a href="{{route('admin.listing-items.index',[28])}}" class="btn btn-sm btn-danger" target="_blank" > Add Members </a>
                    @endif
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
                        <a href="{{route('admin.listing-items.index',[14])}}" class="btn btn-primary" target="_blank">About board learn more listing
                        </a>
                        <input type="hidden" name="content[about_board_learn_more_listing_id]" value="14">
                    @else
                        <a href="{{route('admin.listing-items.index',[29])}}" class="btn btn-primary" target="_blank">About board learn more listing
                        </a>
                        <input type="hidden" name="content[about_board_learn_more_listing_id]" value="29">
                    @endif
                    </div>
            </fieldset>

        </div>
