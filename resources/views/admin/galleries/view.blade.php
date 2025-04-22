<div class="settings-item w-100 confirm-wrap">
    <hr/>
    <div class="row m-0">
        <div class="col-12">
            <div data-simplebar>
                <div class="tab-content chat-list" id="pills-tabContent" >
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="row m-0">
                            @php
                                $attributes = $obj->toArray();
                                unset($attributes['id']);
                            @endphp
                            @foreach($attributes as $key=>$value)
                                    <div class="form-group col-md-12">
                                        <label for="name">{{ucwords(str_replace('_', ' ', $key))}}: </label>
                                        <b>{!! BladeHelper::formatView($key, $value, $obj) !!}</b>
                                    </div>
                            @endforeach

                            @if(count($obj->gallery)>0)
                                <div class="gallery">
                                    <h4>Gallery</h4>
                                    @foreach($obj->gallery as $key=>$item)
                                        @if($item->upload_type == 'Upload')
                                            <a href="{{ asset($item->media->file_path) }}" target="_blank">
                                                @if($item->media->media_type == 'Image')
                                                    <img src="{{ asset($item->media->file_path) }}?ver={{time()}}" width="200px">
                                                @else
                                                    <img src="{{ asset($item->video_preview_image) }}?ver={{time()}}" width="200px">
                                                @endif
                                            </a>
                                        @else
                                            <a href="{{ $item->youtube_url }}" target="_blank">
                                                @if($item->media)
                                                    <img src="{{ asset($item->media->file_path) }}?ver={{time()}}" width="200px">
                                                @else
                                                    <img src="{{ $item->youtube_preview }}?ver={{time()}}" width="200px">
                                                @endif
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if(count($obj->faq))
                                <div class="faq w-100">
                                    <h4>FAQ</h4>
                                    @include('admin._partials.faq', ['faq' => $obj->faq])
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>              
</div>
