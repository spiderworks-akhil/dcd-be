
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

                <div class="row">

                <div class="form-group col-md-6">
                    <label>Featured</label>
                    <input type="text" name="content[featured]" class="form-control"
                        @if($obj->content && isset($obj->content['featured']))
                            value="{{ $obj->content['featured'] }}"
                        @endif
                    >
                </div>

                 <div class="form-group col-md-6">
                    <label>Accessibility</label>
                    <input type="text" name="content[accessibility]" class="form-control"
                        @if($obj->content && isset($obj->content['accessibility']))
                            value="{{ $obj->content['accessibility'] }}"
                        @endif
                    >
                </div>
                </div>
                <div class="row">

                <div class="form-group col-md-6">
                    <label>Featured Event Title</label>
                    <input type="text" name="content[featured_event_title]" class="form-control"
                        @if($obj->content && isset($obj->content['featured_event_title']))
                            value="{{ $obj->content['featured_event_title'] }}"
                        @endif
                    >
                </div>

                 <div class="form-group col-md-6">
                    <label>Discover All</label>
                    <input type="text" name="content[discover_all]" class="form-control"
                        @if($obj->content && isset($obj->content['discover_all']))
                            value="{{ $obj->content['discover_all'] }}"
                        @endif
                    >
                </div>
                </div>

            </fieldset>

            
        </div>
        