
        <div id="form-vertical" class="form-horizontal form-wizard-wrapper">

            <h3>Top Content</h3>
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
                    <label>Content</label>
                    <textarea name="content[description_1]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_1']))
                            {{ $obj->content['description_1'] }}
                        @endif
                    </textarea>
                </div>
                {{-- <div class="form-group">
                    @php
                        $media_id_1 = ($obj->content && isset($obj->content['media_id_1'])) ? $obj->content['media_id_1'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_1,
                        'title' => 'Featured Image',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_1]',
                        'id' => 'content_image_1',
                        'display' => 'horizontal'
                    ])
                </div> --}}
            </fieldset>

            
        </div>
        