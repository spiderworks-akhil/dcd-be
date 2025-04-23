<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
<fieldset>
    <h3>Top section </h3>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[title_1]" class="form-control"
            @if($obj->content && isset($obj->content['title_1']))
                value="{{ $obj->content['title_1'] }}"
            @endif
        >
    </div>
    <div class="card-body row">
        <div class="form-group col-md-12">
            <label>Description </label>
            <textarea name="content[section_description_first]" class="form-control editor ">
@if ($obj->content && isset($obj->content['section_description_first']))
{{ $obj->content['section_description_first'] }}
@endif
</textarea>
        </div>
    </div>
</fieldset>

</div>
