<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <h3>Top Section</h3>
        <fieldset>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Sub Title</label>
                    <input type="text" name="content[banner_sub_title]" class="form-control"
                        @if($obj->content && isset($obj->content['banner_sub_title']))
                            value="{{ $obj->content['banner_sub_title'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-6">
                    <label>title</label>
                    <input type="text" name="content[banner_title]" class="form-control" @if($obj->content && isset($obj->content['banner_title'])) value="{{$obj->content['banner_title']}}" @endif >
                </div>
            </div>

        



        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[banner_shortdescription]" class="form-control ">@if($obj->content && isset($obj->content['banner_shortdescription'])) {{$obj->content['banner_shortdescription']}} @endif</textarea>
        </div>



    </fieldset>
    <h3>Middle content</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_1]" class="form-control"
                @if($obj->content && isset($obj->content['title_1']))
                    value="{{ $obj->content['title_1'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label> Description</label>
            <textarea name="content[middle_tdescription]" class="form-control ">@if($obj->content && isset($obj->content['middle_tdescription'])) {{$obj->content['middle_tdescription']}} @endif</textarea>
        </div>

        <div class="form-group col-md-12">
            <label>Email</label>
            <input type="text" name="content[email]" class="form-control"
                @if($obj->content && isset($obj->content['email']))
                    value="{{ $obj->content['email'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Button Title</label>
            <input type="text" name="content[title_2]" class="form-control"
                @if($obj->content && isset($obj->content['title_2']))
                    value="{{ $obj->content['title_2'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Page url</label>
            <input type="text" name="content[url]" class="form-control"  @if($obj->content && isset($obj->content['url']))
                    value="{{ $obj->content['url'] }}"
                @endif>
        </div>
    </fieldset>
    <h3>FAQ Section</h3>
    <fieldset>
        <div class="row">
            <div class="form-group col-md-6">
                <label>FAQ  Title</label>
                <input type="text" name="content[title_3]" class="form-control"
                    @if($obj->content && isset($obj->content['title_3']))
                        value="{{ $obj->content['title_3'] }}"
                    @endif
                >
            </div>
            <div class="form-group col-md-6">
                <label>Sub Title</label>
                <input type="text" name="content[faq_sub_title]" class="form-control"
                    @if($obj->content && isset($obj->content['faq_sub_title']))
                        value="{{ $obj->content['faq_sub_title'] }}"
                    @endif
                >
            </div>
        </div>
        
        
    </fieldset>

    <h3>Footer section</h3>
    <fieldset>
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

<div class="form-group col-md-12">
    <label>  Title</label>
    <input type="text" name="content[title_4]" class="form-control"
        @if($obj->content && isset($obj->content['title_4']))
            value="{{ $obj->content['title_4'] }}"
        @endif
    >
</div>
    </fieldset>
</div>
