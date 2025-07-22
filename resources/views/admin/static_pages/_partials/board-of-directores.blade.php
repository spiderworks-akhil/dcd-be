
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
               
            </fieldset>

            <h3>Middle Content</h3>
            <fieldset>
                <div class="form-group col-md-12">
                    <label>Title</label>
                    <input type="text" name="content[title_2]" class="form-control"
                        @if($obj->content && isset($obj->content['title_2']))
                            value="{{ $obj->content['title_2'] }}"
                        @endif
                    >
                </div>
            </fieldset>

            
        </div>
        