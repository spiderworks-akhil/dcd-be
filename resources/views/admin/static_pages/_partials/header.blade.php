
        <div id="form-vertical" class="form-horizontal form-wizard-wrapper">

            <h3>Header</h3>
            <fieldset>

                <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'header Logo',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'content_image_1',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group">
                    @php
                        $media_id_2 = ($obj->content && isset($obj->content['media_id_2'])) ? $obj->content['media_id_2'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_2,
                        'title' => 'Favicon Logo',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_2]',
                        'id' => 'content_image_2',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group">
                    @php
                        $media_id_3 = ($obj->content && isset($obj->content['media_id_3'])) ? $obj->content['media_id_3'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_3,
                        'title' => 'Plain Logo',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_3]',
                        'id' => 'content_image_3',
                        'display' => 'horizontal'
                    ])
                </div>

                <div class="form-group col-md-12">
                    <label> Button Text</label>
                    <input type="text" name="content[contact_us]" class="form-control"
                        @if($obj->content && isset($obj->content['contact_us']))
                            value="{{ $obj->content['contact_us'] }}"
                        @endif>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-group col-md-12">
                    @if ($obj->type == 'en')
                        <a href="{{route('admin.menus.edit',['id'=> encrypt(1)])}}" class="btn btn-sm btn-danger" target="_blank" > Add Header menu </a>
                    @else
                        <a href="{{route('admin.menus.edit',['id'=> encrypt(3)])}}" class="btn btn-sm btn-danger" target="_blank" > Add Header menu </a>
                     @endif
                    </div>
                </div>
            </fieldset>
        </div>
