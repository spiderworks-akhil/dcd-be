
<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Footer</h3>
    <fieldset>

        <div class="form-group">
            @php
                $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_1,
                'title' => 'Footer Logo',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_1]',
                'id' => 'content_image_1',
                'display' => 'horizontal'
            ])
        </div>


        <div class="form-group col-md-12">
            <label> Copyright</label>
            <input type="text" name="content[copyright]" class="form-control"
                @if($obj->content && isset($obj->content['copyright']))
                    value="{{ $obj->content['copyright'] }}"
                @endif>
        </div>

        <div class="form-group col-md-12">
            <div class="form-group col-md-12">
            @if ($obj->type == 'en')
                <a href="{{route('admin.menus.edit',['id'=> encrypt(2)])}}" class="btn btn-sm btn-danger" target="_blank" > Add Footer menu </a>
            @else
                <a href="{{route('admin.menus.edit',['id'=> encrypt(4)])}}" class="btn btn-sm btn-danger" target="_blank" > Add Footer menu </a>
            @endif
            </div>

        </div>
    </fieldset>

</div>
