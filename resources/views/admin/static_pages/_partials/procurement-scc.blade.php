<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <h3>Top Section</h3>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Sub Title</label>
                <input type="text" name="content[title_1]" class="form-control"
                    @if($obj->content && isset($obj->content['title_1']))
                        value="{{ $obj->content['title_1'] }}"
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
            <label> Description</label>
            <textarea name="content[banner_shortdescription]" class="form-control ">@if($obj->content && isset($obj->content['banner_shortdescription'])) {{$obj->content['banner_shortdescription']}} @endif</textarea>
        </div>



    </fieldset>

    <h3>Description Section </h3>
    <fieldset>
        <div class="card-body row">
            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea name="content[section_description_first]" class="form-control editor">
                    @if ($obj->content && isset($obj->content['section_description_first']))
                        {{ $obj->content['section_description_first'] }}
                    @endif
                </textarea>
            </div>
        </div>
    </fieldset>

    </div>
