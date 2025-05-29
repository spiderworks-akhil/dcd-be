<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Banner Section</h3>
    <fieldset>

        <div class="form-group">
            @php
                $media_id_1 = $obj->content && isset($obj->content['media_id_1']) ? $obj->content['media_id_1'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_1,
                'title' => 'Banner Video',
                'popup_type' => 'single_image',
                'type' => 'video',
                'holder_attr' => 'content[media_id_1]',
                'id' => 'content_image_1',
                'display' => 'horizontal',
            ])
        </div>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_1]" class="form-control"
                @if ($obj->content && isset($obj->content['title_1'])) value="{{ $obj->content['title_1'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[description_1]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['description_1']))
{{ $obj->content['description_1'] }}
@endif
             </textarea>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                @php
                    $media_id_2 =
                        $obj->content && isset($obj->content['media_id_2']) ? $obj->content['media_id_2'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_2,
                    'title' => 'Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_2]',
                    'id' => 'content_image_2',
                    'display' => 'horizontal',
                ])
            </div>

            <div class="form-group col-md-4">
                @php
                    $media_id_3 =
                        $obj->content && isset($obj->content['media_id_3']) ? $obj->content['media_id_3'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_3,
                    'title' => 'Gif',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_3]',
                    'id' => 'content_image_3',
                    'display' => 'horizontal',
                ])
            </div>

            <div class="form-group col-md-4">
                @php
                    $media_id_4 =
                        $obj->content && isset($obj->content['media_id_4']) ? $obj->content['media_id_4'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_4,
                    'title' => 'Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_4]',
                    'id' => 'content_image_4',
                    'display' => 'horizontal',
                ])
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                @php
                    $media_id_5 =
                        $obj->content && isset($obj->content['media_id_5']) ? $obj->content['media_id_5'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_5,
                    'title' => 'Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_5]',
                    'id' => 'content_image_5',
                    'display' => 'horizontal',
                ])
            </div>

            <div class="form-group col-md-4">
                @php
                    $media_id_6 =
                        $obj->content && isset($obj->content['media_id_6']) ? $obj->content['media_id_6'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_6,
                    'title' => 'Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_6]',
                    'id' => 'content_image_6',
                    'display' => 'horizontal',
                ])
            </div>

            <div class="form-group col-md-4">
                @php
                    $media_id_7 =
                        $obj->content && isset($obj->content['media_id_7']) ? $obj->content['media_id_7'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_7,
                    'title' => 'Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_7]',
                    'id' => 'content_image_7',
                    'display' => 'horizontal',
                ])
            </div>
        </div>

        <div class="form-group col-md-12">
            <label>Image Heading</label>
            <input type="text" name="content[image_heading]" class="form-control"
                @if ($obj->content && isset($obj->content['image_heading'])) value="{{ $obj->content['image_heading'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Image Description 1 </label>
            <textarea name="content[image_description_1]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['image_description_1']))
{{ $obj->content['image_description_1'] }}
@endif
             </textarea>
        </div>

        <div class="form-group col-md-12">
            <label>Image Description 2 </label>
            <textarea name="content[image_description_2]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['image_description_2']))
{{ $obj->content['image_description_2'] }}
@endif
             </textarea>
        </div>
        <div class="row">

            <div class="form-group col-md-6">
                <label>Button Text</label>
                <input type="text" name="content[button_text]" class="form-control"
                    @if ($obj->content && isset($obj->content['button_text'])) value="{{ $obj->content['button_text'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Image Url</label>
                <input type="text" name="content[button_url]" class="form-control"
                    @if ($obj->content && isset($obj->content['button_url'])) value="{{ $obj->content['button_url'] }}" @endif>
            </div>

        </div>

    </fieldset>

    <h3>About sports and socio-culture</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_2]" class="form-control"
                @if ($obj->content && isset($obj->content['title_2'])) value="{{ $obj->content['title_2'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            @if ($obj->type == 'en')
                <input type="hidden" name="content[sports_and_socio_culture_listing_id]" value="22">
                <a href="{{ route('admin.listing-items.index', [22]) }}" class="btn btn-sm btn-danger" target="_blank">
                    Add sports and socio-culture</a>
            @else
                <input type="hidden" name="content[sports_and_socio_culture_listing_id]" value="23">
                <a href="{{ route('admin.listing-items.index', [23]) }}" class="btn btn-sm btn-danger" target="_blank">
                    Add sports and socio-culture </a>
            @endif
        </div>
    </fieldset>

    <h3>Sports</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_3]" class="form-control"
                @if ($obj->content && isset($obj->content['title_3'])) value="{{ $obj->content['title_3'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Content</label>
            <textarea name="content[description_3]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['description_3']))
{{ $obj->content['description_3'] }}
@endif
            </textarea>
        </div>

        <div class="form-group">
            @php
                $media_id_8 = $obj->content && isset($obj->content['media_id_8']) ? $obj->content['media_id_8'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_8,
                'title' => 'Video',
                'popup_type' => 'single_image',
                'type' => 'video',
                'holder_attr' => 'content[media_id_8]',
                'id' => 'content_image_8',
                'display' => 'horizontal',
            ])
        </div>

        <div class="form-group col-md-12">
            <label>Listing Title</label>
            <input type="text" name="content[listing_title_3]" class="form-control"
                @if ($obj->content && isset($obj->content['listing_title_3'])) value="{{ $obj->content['listing_title_3'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            @if ($obj->type == 'en')
                <input type="hidden" name="content[categories_in_sports_listing_id]" value="24">
                <a href="{{ route('admin.listing-items.index', [24]) }}" class="btn btn-sm btn-danger"
                    target="_blank">Add Categories in sports</a>
            @else
                <input type="hidden" name="content[categories_in_sports_listing_id]" value="25">
                <a href="{{ route('admin.listing-items.index', [25]) }}" class="btn btn-sm btn-danger"
                    target="_blank">Add Categories in sports </a>
            @endif
        </div>

    </fieldset>


    <h3>Games we feature in sports division</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_4]" class="form-control"
                @if ($obj->content && isset($obj->content['title_4'])) value="{{ $obj->content['title_4'] }}" @endif>
        </div>

        <div class="form-group col-md-12">
            @if ($obj->type == 'en')
                <input type="hidden" name="content[games_listing_id]" value="26">
                <a href="{{ route('admin.listing-items.index', [26]) }}" class="btn btn-sm btn-danger"
                    target="_blank">Add Games</a>
            @else
                <input type="hidden" name="content[games_listing_id]" value="27">
                <a href="{{ route('admin.listing-items.index', [27]) }}" class="btn btn-sm btn-danger"
                    target="_blank">Add Games </a>
            @endif
        </div>

        <h3>Socio- Culture</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_5]" class="form-control"
                    @if ($obj->content && isset($obj->content['title_5'])) value="{{ $obj->content['title_5'] }}" @endif>
            </div>
            <div class="form-group col-md-12">
                <label>Content</label>
                <textarea name="content[description_5]" class="form-control editor">
                        @if ($obj->content && isset($obj->content['description_5']))
{{ $obj->content['description_5'] }}
@endif
            </textarea>
            </div>

        <div class="form-group">
            @php
                $media_id_9 = $obj->content && isset($obj->content['media_id_9']) ? $obj->content['media_id_9'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_9,
                'title' => 'Video',
                'popup_type' => 'single_image',
                'type' => 'video',
                'holder_attr' => 'content[media_id_9]',
                'id' => 'content_image_9',
                'display' => 'horizontal',
            ])
        </div>

            <div class="form-group col-md-12">
                <label>Listing Title</label>
                <input type="text" name="content[listing_title_5]" class="form-control"
                    @if ($obj->content && isset($obj->content['listing_title_5'])) value="{{ $obj->content['listing_title_5'] }}" @endif>
            </div>

            <div class="form-group col-md-12">
                @if ($obj->type == 'en')
                    <input type="hidden" name="content[socio_culture_listing_id]" value="28">
                    <a href="{{ route('admin.listing-items.index', [28]) }}" class="btn btn-sm btn-danger"
                        target="_blank">Add socio culture</a>
                @else
                    <input type="hidden" name="content[socio_culture_listing_id]" value="29">
                    <a href="{{ route('admin.listing-items.index', [29]) }}" class="btn btn-sm btn-danger"
                        target="_blank">Add socio culture </a>
                @endif
            </div>
        </fieldset>

</div>
