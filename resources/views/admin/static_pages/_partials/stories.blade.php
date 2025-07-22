
        <div id="form-vertical" class="form-horizontal form-wizard-wrapper">

            <h3>Add Stories</h3>
            <fieldset>
                {{-- <div class="form-group col-md-12">
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
             --}}
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

           
        </div>
        