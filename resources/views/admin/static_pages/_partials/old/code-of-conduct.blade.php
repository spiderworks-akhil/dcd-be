<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <h3>Top Section</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Sub Title</label>
                <input type="text" name="content[title_3]" class="form-control"
                    @if($obj->content && isset($obj->content['title_3']))
                        value="{{ $obj->content['title_3'] }}"
                    @endif
                >
            </div>
            <div class="form-group col-md-12">
                <label>Title</label>
                <input type="text" name="content[title_2]" class="form-control"
                    @if($obj->content && isset($obj->content['title_2']))
                        value="{{ $obj->content['title_2'] }}"
                    @endif
                >
            </div>

            <div class="form-group col-md-12">
                <label>Top Description 1</label>
                <textarea name="content[top_description1]" class="form-control editor">
                            @if($obj->content && isset($obj->content['top_description1']))
                                {{ $obj->content['top_description1'] }}
                            @endif
                        </textarea>
            </div>
        {{-- <div class="form-group col-md-12">
            <label> Description</label>
            <textarea name="content[banner_shortdescription]" class="form-control ">@if($obj->content && isset($obj->content['banner_shortdescription'])) {{$obj->content['banner_shortdescription']}} @endif</textarea>
        </div> --}}



        <div class="form-group col-md-12">
            <label>Top Description 2</label>
            <textarea name="content[top_description2]" class="form-control editor">
                        @if($obj->content && isset($obj->content['top_description2']))
                            {{ $obj->content['top_description2'] }}
                        @endif
                    </textarea>
        </div>

</fieldset>
<h3>Click Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Button Text</label>
        <textarea name="content[button_text]" class="form-control ">@if($obj->content && isset($obj->content['button_text'])) {{$obj->content['button_text']}} @endif</textarea>
    </div>
    <div class="form-group col-md-12">
        <label>Button Link</label>
        <textarea name="content[button_link]" class="form-control ">@if($obj->content && isset($obj->content['button_link'])) {{$obj->content['button_link']}} @endif</textarea>
    </div>
    <div class="form-group">
                    @php
                        $media_id_pdf = ($obj->content && isset($obj->content['media_id_pdf'])) ? $obj->content['media_id_pdf'] : null;
                    @endphp
                    @include('admin.media.set_file', [
                        'file' => $media_id_pdf,
                        'title' => 'Pdf',
                        'popup_type' => 'single_image',
                        'type' => 'Pdf',
                        'holder_attr' => 'content[media_id_pdf]',
                        'id' => 'media_id_pdf',
                        'display' => 'horizontal'
                    ])
                </div>
</fieldset>
</div>
