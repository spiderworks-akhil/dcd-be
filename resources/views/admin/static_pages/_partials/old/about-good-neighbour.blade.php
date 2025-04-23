
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

                <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'Banner Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'banner_image_1',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Overview</h3>
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
            </fieldset>

            <h3>Transport</h3>
                <fieldset>
                    <div class="form-group col-md-12">
                        @if ($obj->type == 'en')
                             <a href="{{route('admin.listing-items.index',[2])}}" class="btn btn-sm btn-danger" target="_blank" > Add Transport List </a>
                            <input type="hidden" name="content[transport_listing_id]" value="2">

                        @else
                            <a href="{{route('admin.listing-items.index',[25])}}" class="btn btn-sm btn-danger" target="_blank" > Add Transport List </a>
                        <input type="hidden" name="content[transport_listing_id]" value="25">

                        @endif


                    </div>
            </fieldset>

            <h3>Gallery</h3>
                <fieldset>
                    <div class="form-group col-md-12">
                        <a href="{{route('admin.galleries.edit',['id'=> encrypt(3)])}}" class="btn btn-sm btn-danger" target="_blank" > Add Gallery </a>
                    </div>
            </fieldset>

            <h3>Bottom Content</h3>
            <fieldset>
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
                        'id' => 'banner_image_2',
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
                        <a href="{{route('admin.listing-items.index',[16])}}" class="btn btn-primary" target="_blank">About good neighbour learn more listing
                        </a>
                        <input type="hidden" name="content[good_neighbour_learn_more_listing_id]" value="16">
                    @else
                        <a href="{{route('admin.listing-items.index',[26])}}" class="btn btn-primary" target="_blank">About good neighbour learn more listing
                        </a>
                        <input type="hidden" name="content[good_neighbour_learn_more_listing_id]" value="26">
                    @endif
                    </div>
            </fieldset>

        </div>
