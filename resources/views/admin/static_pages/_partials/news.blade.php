<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Home Banner</h3>
    <fieldset>
        {{-- <div class="form-group">
            @php
            $media_id_banner_image_1 = ($obj->content && isset($obj->content['media_id_banner_image_1'])) ? $obj->content['media_id_banner_image_1'] : null;
            @endphp
            @include('admin.media.set_file', [
            'file' => $media_id_banner_image_1,
            'title' => 'Banner Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_banner_image_1]',
            'id' => 'media_id_banner_image_1',
            'display' => 'horizontal'
            ])
        </div> --}}
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[banner_title]" class="form-control"
                @if($obj->content && isset($obj->content['banner_title']))
            value="{{ $obj->content['banner_title'] }}"
            @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[banner_description]" class="form-control" rows="3">
                @if($obj->content && isset($obj->content['banner_description']))
                    {!! $obj->content['banner_description'] !!}
                @endif
            </textarea>
        </div>

        <div class="row">
         <div class="form-group col-md-6">
            <label>Featured News Heading</label>
            <input type="text" name="content[featured]" class="form-control"
                @if($obj->content && isset($obj->content['featured']))
            value="{{ $obj->content['featured'] }}"
            @endif
            >
        </div>

         <div class="form-group col-md-6">
            <label>Latest News Heading</label>
            <input type="text" name="content[latest]" class="form-control"
                @if($obj->content && isset($obj->content['latest']))
            value="{{ $obj->content['latest'] }}"
            @endif
            >
        </div>
        </div>

          <div class="form-group col-md-6">
            <label>All News Heading</label>
            <input type="text" name="content[all_news]" class="form-control"
                @if($obj->content && isset($obj->content['all_news']))
            value="{{ $obj->content['all_news'] }}"
            @endif
            >
        </div>

    </fieldset>
</div>