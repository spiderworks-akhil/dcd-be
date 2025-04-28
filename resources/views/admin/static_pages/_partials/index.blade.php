
<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

<h3>Banner Content</h3>
<fieldset>
 
    <div class="form-group col-md-12">
        @if ($obj->type == 'en')
            <a href="{{route('admin.sliders.edit',[encrypt(1)])}}" class="btn btn-sm btn-danger" target="_blank"> Add Sliders </a>
        @else
            <a href="{{route('admin.sliders.edit',[encrypt(2)])}}" class="btn btn-sm btn-danger" target="_blank"> Add Sliders </a>
        @endif
    </div>
</fieldset>

<h3>Inspiring Stories</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[title_2]" class="form-control"
            @if($obj->content && isset($obj->content['title_2']))
                value="{{ $obj->content['title_2'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        @if ($obj->type == 'en')
            <input type="hidden" name="content[story_listing_id]" value="2">
            <a href="{{route('admin.listing-items.index',[2])}}" class="btn btn-sm btn-danger" target="_blank" > Add Stories  </a>
        @else
                <input type="hidden" name="content[story_listing_id]" value="3">
            <a href="{{route('admin.listing-items.index',[3])}}" class="btn btn-sm btn-danger" target="_blank" > Add Stories  </a>
        @endif
    </div>
</fieldset>

<h3>Bottom Content</h3>
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
        <textarea name="content[description_3]" class="form-control editor">
            @if($obj->content && isset($obj->content['description_3']))
                {{ $obj->content['description_3'] }}
            @endif
        </textarea>
    </div>
    <div class="form-group">
        @php
            $media_id_3 = ($obj->content && isset($obj->content['media_id_3'])) ? $obj->content['media_id_3'] : null;
        @endphp
        @include('admin.media.set_file', [
            'file' => $media_id_3,
            'title' => 'Featured Image',
            'popup_type' => 'single_image',
            'type' => 'Image',
            'holder_attr' => 'content[media_id_3]',
            'id' => 'content_image_3',
            'display' => 'horizontal'
        ])
    </div>
</fieldset>
</div>
