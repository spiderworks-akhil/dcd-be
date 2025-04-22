<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Top Content</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[sub_title_1]" class="form-control"
                @if($obj->content && isset($obj->content['sub_title_1']))
            value="{{ $obj->content['sub_title_1'] }}"
            @endif>
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
            <input type="text" name="content[short_description]" class="form-control"
                @if($obj->content && isset($obj->content['short_description']))
            value="{{ $obj->content['short_description'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Button Text</label>
            <input type="text" name="content[button_text]" class="form-control"
                @if($obj->content && isset($obj->content['button_text']))
            value="{{ $obj->content['button_text'] }}"
            @endif>
        </div>

    </fieldset>

    <h3>Logo</h3>
    <fieldset>

        <div class="form-group row">
            <div class="col-md-6">
                <label>Title</label>
                <input type="text" name="content[title_2]" class="form-control"
                    @if($obj->content && isset($obj->content['title_2']))
                value="{{ $obj->content['title_2'] }}"
                @endif
                >
            </div>

            <div class="col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[sub_title_2]" class="form-control"
                    @if($obj->content && isset($obj->content['sub_title_2']))
                value="{{ $obj->content['sub_title_2'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label>Title</label>
                <input type="text" name="content[title_3]" class="form-control"
                    @if($obj->content && isset($obj->content['title_3']))
                value="{{ $obj->content['title_3'] }}"
                @endif
                >
            </div>

            <div class="col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[sub_title_3]" class="form-control"
                    @if($obj->content && isset($obj->content['sub_title_3']))
                value="{{ $obj->content['sub_title_3'] }}"
                @endif
                >
            </div>
        </div>

        <div class="form-group">
            @php
            $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_1,
            'title' => 'Logo',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_1]',
            'id' => 'logo',
            'display' => 'horizontal'
            ])
        </div>
    </fieldset>
    <h3>Gallery </h3>
    <fieldset>
        <div class="form-group col-md-12">
        <a href="{{route('admin.galleries.edit',[encrypt(2)])}}" target="_blank" class="btn btn-primary">View</a>
        </div>
    </fieldset>

    @if ($obj->type == 'en')
        <input type="hidden" name="content[resources_listing_id]" value="3">
    @else
        <input type="hidden" name="content[resources_listing_id]" value="17">
    @endif

    <h3>Resources</h3>
    <fieldset>

        <div class="col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_4]" class="form-control"
                @if($obj->content && isset($obj->content['title_4']))
            value="{{ $obj->content['title_4'] }}"
            @endif
            >
        </div>

        <div class="col-md-12">
            <label>Sub Title</label>
            <input type="text" name="content[sub_title_4]" class="form-control"
                @if($obj->content && isset($obj->content['sub_title_4']))
            value="{{ $obj->content['sub_title_4'] }}"
            @endif
            >
        </div>

        <div class="form-group col-md-12">

            @if ($obj->type == 'en')
                <a href="{{route('admin.listing-items.index',[3])}}" class="btn btn-sm btn-danger" target="_blank"> Add Resources </a>

            @else
                <a href="{{route('admin.listing-items.index',[17])}}" class="btn btn-sm btn-danger" target="_blank"> Add Resources </a>

            @endif

        </div>
    </fieldset>


</div>
