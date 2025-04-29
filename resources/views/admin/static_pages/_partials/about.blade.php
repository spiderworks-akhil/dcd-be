
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
                    <label>Sub Title</label>
                    <input type="text" name="content[sub_title_1]" class="form-control"
                        @if($obj->content && isset($obj->content['sub_title_1']))
                            value="{{ $obj->content['sub_title_1'] }}"
                        @endif
                    >
                </div>         
              
            </fieldset>
            <h3>Journey Block 1</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_journey_block_1]" class="form-control"
                        @if($obj->content && isset($obj->content['title_journey_block_1']))
                            value="{{ $obj->content['title_journey_block_1'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_journey_block_1]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_journey_block_1']))
                            {{ $obj->content['description_journey_block_1'] }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    @php
                        $media = $obj->content['media_id_journey_block_1'] ?? null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media,
                        'title' => 'Image for Journey Block 1',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_journey_block_1]',
                        'id' => 'content_image_journey_block_1',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Journey Block 2</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_journey_block_2]" class="form-control"
                        @if($obj->content && isset($obj->content['title_journey_block_2']))
                            value="{{ $obj->content['title_journey_block_2'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_journey_block_2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_journey_block_2']))
                            {{ $obj->content['description_journey_block_2'] }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    @php
                        $media = $obj->content['media_id_journey_block_2'] ?? null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media,
                        'title' => 'Image for Journey Block 2',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_journey_block_2]',
                        'id' => 'content_image_journey_block_2',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Journey Block 3</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_journey_block_3]" class="form-control"
                        @if($obj->content && isset($obj->content['title_journey_block_3']))
                            value="{{ $obj->content['title_journey_block_3'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_journey_block_3]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_journey_block_3']))
                            {{ $obj->content['description_journey_block_3'] }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    @php
                        $media = $obj->content['media_id_journey_block_3'] ?? null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media,
                        'title' => 'Image for Journey Block 3',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_journey_block_3]',
                        'id' => 'content_image_journey_block_3',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Journey Block 4</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_journey_block_4]" class="form-control"
                        @if($obj->content && isset($obj->content['title_journey_block_4']))
                            value="{{ $obj->content['title_journey_block_4'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_journey_block_4]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_journey_block_4']))
                            {{ $obj->content['description_journey_block_4'] }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    @php
                        $media = $obj->content['media_id_journey_block_4'] ?? null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media,
                        'title' => 'Image for Journey Block 4',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_journey_block_4]',
                        'id' => 'content_image_journey_block_4',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>

            <h3>Journey Block 5</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_journey_block_5]" class="form-control"
                        @if($obj->content && isset($obj->content['title_journey_block_5']))
                            value="{{ $obj->content['title_journey_block_5'] }}"
                        @endif
                    >
                </div>
                <div class="form-group col-md-12">
                    <label>Content</label>
                    <textarea name="content[description_journey_block_5]" class="form-control editor">
                        @if($obj->content && isset($obj->content['description_journey_block_5']))
                            {{ $obj->content['description_journey_block_5'] }}
                        @endif
                    </textarea>
                </div>
                <div class="form-group">
                    @php
                        $media = $obj->content['media_id_journey_block_5'] ?? null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media,
                        'title' => 'Image for Journey Block 5',
                        'popup_type' => 'single_image',
                        'type' => 'Image',
                        'holder_attr' => 'content[media_id_journey_block_5]',
                        'id' => 'content_image_journey_block_5',
                        'display' => 'horizontal'
                    ])
                </div>
            </fieldset>
            {{-- History Block --}}
        <h3>History Block</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_history_block]" class="form-control"
                    @if($obj->content && isset($obj->content['title_history_block']))
                        value="{{ $obj->content['title_history_block'] }}"
                    @endif
                >
            </div>

            <div class="form-group col-md-12">
                <label>Content</label>
                <textarea name="content[description_history_block]" class="form-control editor">
                    @if($obj->content && isset($obj->content['description_history_block']))
                        {{ $obj->content['description_history_block'] }}
                    @endif
                </textarea>
            </div>

            <div class="form-group">
                @php
                    $media = $obj->content['media_id_history_block'] ?? null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media,
                    'title' => 'History Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_history_block]',
                    'id' => 'content_image_history_block',
                    'display' => 'horizontal'
                ])
            </div>
        </fieldset>

        {{-- Vision Block --}}
        <h3>Vision Block</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_vision_block]" class="form-control"
                    @if($obj->content && isset($obj->content['title_vision_block']))
                        value="{{ $obj->content['title_vision_block'] }}"
                    @endif
                >
            </div>

            <div class="form-group col-md-12">
                <label>Content</label>
                <textarea name="content[description_vision_block]" class="form-control editor">
                    @if($obj->content && isset($obj->content['description_vision_block']))
                        {{ $obj->content['description_vision_block'] }}
                    @endif
                </textarea>
            </div>
        </fieldset>

        {{-- Mission Block --}}
        <h3>Mission Block</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_mission_block]" class="form-control"
                    @if($obj->content && isset($obj->content['title_mission_block']))
                        value="{{ $obj->content['title_mission_block'] }}"
                    @endif
                >
            </div>

            <div class="form-group col-md-12">
                <label>Content</label>
                <textarea name="content[description_mission_block]" class="form-control editor">
                    @if($obj->content && isset($obj->content['description_mission_block']))
                        {{ $obj->content['description_mission_block'] }}
                    @endif
                </textarea>
            </div>
        </fieldset>

        {{-- Activities Block --}}
        <h3>Activities Block</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_activities_block]" class="form-control"
                    @if($obj->content && isset($obj->content['title_activities_block']))
                        value="{{ $obj->content['title_activities_block'] }}"
                    @endif
                >
            </div>

            <div class="form-group">
                @php
                    $media = $obj->content['media_id_activities_block'] ?? null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media,
                    'title' => 'Activities Image',
                    'popup_type' => 'single_image',
                    'type' => 'Image',
                    'holder_attr' => 'content[media_id_activities_block]',
                    'id' => 'content_image_activities_block',
                    'display' => 'horizontal'
                ])
            </div>
        </fieldset>

        {{-- Activities Block 2 --}}
         
        </div>
        