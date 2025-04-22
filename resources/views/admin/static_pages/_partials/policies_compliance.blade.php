<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <fieldset>
        <h3>Top Content</h3>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_1]" class="form-control"
                @if($obj->content && isset($obj->content['title_1']))
                    value="{{ $obj->content['title_1'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-12">
            <label> Quality Title</label>
            <input type="text" name="content[title_2]" class="form-control"
                @if($obj->content && isset($obj->content['title_2']))
                    value="{{ $obj->content['title_2'] }}"
                @endif
            >

        </div>

        <div class="form-group col-md-12">
            <label> Quality url</label>
            <input type="text" name="content[quality_url]" class="form-control"
                @if($obj->content && isset($obj->content['quality_url']))
                    value="{{ $obj->content['quality_url'] }}"
                @endif
            >

        </div>



        <div class="form-group col-md-12">
            <label>Healthy, Safet Title</label>
            <input type="text" name="content[title_3]" class="form-control"
                @if($obj->content && isset($obj->content['title_3']))
                    value="{{ $obj->content['title_3'] }}"
                @endif
            >

        </div>

        <div class="form-group col-md-12">
            <label> Healthy url</label>
            <input type="text" name="content[health_url]" class="form-control"
                @if($obj->content && isset($obj->content['health_url']))
                    value="{{ $obj->content['health_url'] }}"
                @endif
            >

        </div>

    </fieldset>

</div>
