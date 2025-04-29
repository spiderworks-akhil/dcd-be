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

    <h3>Events & Updates</h3>
    <fieldset>
        <div class="form-group">
            <label> Upcoming Events Title</label>
            <input type="text" name="content[events_updates_title]" class="form-control"
                @if($obj->content && isset($obj->content['events_updates_title']))
            value="{{ $obj->content['events_updates_title'] }}"
            @endif
            >
        </div>
        
        <div class="form-group row">
            <div class="col-md-6">
                <label>Featured Events Title</label>
                <input type="text" name="content[featured_events_title]" class="form-control"
                    @if($obj->content && isset($obj->content['featured_events_title']))
                value="{{ $obj->content['featured_events_title'] }}"
                @endif
                >
            </div>
            <div class="col-md-6">
                <label>Featured Events Sub Title</label>
                <input type="text" name="content[featured_events_subtitle]" class="form-control"
                    @if($obj->content && isset($obj->content['featured_events_subtitle']))
                value="{{ $obj->content['featured_events_subtitle'] }}"
                @endif
                >
            </div>
        </div>
        

        <div class="form-group col-md-12">
        @if ($obj->type == 'en')
            <input type="hidden" name="content[event_updates_listing_id]" value="6">
            <a href="{{route('admin.listing-items.index',[6])}}" class="btn btn-sm btn-danger" target="_blank" > Add Event Updates</a>
        @else
                <input type="hidden" name="content[event_updates_listing_id]" value="7">
            <a href="{{route('admin.listing-items.index',[7])}}" class="btn btn-sm btn-danger" target="_blank" >  Add Event Updates  </a>
        @endif
    </div>

    </fieldset>
    <h3>Rewinds Gallery</h3>
    <fieldset>
        <div class="form-group">
            <a href="{{ route('admin.galleries.edit', [encrypt(1)]) }}" target="_blank" class="btn btn-primary">
                <i class="fas fa-arrow-right mr-2"></i>Go to Gallery Module 
            </a>
        </div>
    </fieldset>

</div>