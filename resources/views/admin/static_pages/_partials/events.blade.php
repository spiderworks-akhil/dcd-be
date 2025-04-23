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
    </fieldset>
</div>