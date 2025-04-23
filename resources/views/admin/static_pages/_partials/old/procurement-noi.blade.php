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
    <h3>NOC section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_3]" class="form-control"
                @if($obj->content && isset($obj->content['title_3']))
                    value="{{ $obj->content['title_3'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Short Description</label>
            <textarea name="content[banner_shortdescription_1]" class="form-control ">@if($obj->content && isset($obj->content['banner_shortdescription_1'])) {{$obj->content['banner_shortdescription_1']}} @endif</textarea>
        </div>
        <div class="form-group col-md-12">
            <label>Button Title</label>
            <input type="text" name="content[title_4]" class="form-control"
                @if($obj->content && isset($obj->content['title_4']))
                    value="{{ $obj->content['title_4'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Page url</label>
            <input type="text" name="content[url]" class="form-control"  @if($obj->content && isset($obj->content['url']))
                    value="{{ $obj->content['url'] }}"
                @endif>
        </div>
    </fieldset>
    <h3>Headquaters Details</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_5]" class="form-control"
                @if($obj->content && isset($obj->content['title_5']))
                    value="{{ $obj->content['title_5'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label>Address Description</label>
            <textarea name="content[banner_shortdescription_5]" class="form-control ">@if($obj->content && isset($obj->content['banner_shortdescription_5'])) {{$obj->content['banner_shortdescription_5']}} @endif</textarea>
        </div>

        <div class="form-group col-md-12">
            <label>Phone number</label>
            <input type="text" name="content[number]" class="form-control"
                @if($obj->content && isset($obj->content['number']))
                    value="{{ $obj->content['number'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-12">
            <label>Map</label>
            <textarea name="content[map]" class="form-control ">@if($obj->content && isset($obj->content['map'])) {{$obj->content['map']}} @endif</textarea>
        </div>
    </fieldset>
</div>
