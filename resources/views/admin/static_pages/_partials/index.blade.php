
<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
<h3>Banner Content</h3>
<fieldset>
 
    <div class="form-group col-md-12">
        @if ($obj->type == 'en')
            <a href="{{route('admin.sliders.edit',[encrypt(1)])}}" class="btn btn-sm btn-danger" target="_blank"> Add Sliders </a>
        @else
            <a href="{{route('admin.sliders.edit',[encrypt(2)])}}" class="btn btn-sm btn-danger" target="_blank"> Add Sliders </a>
        @endif
    </div>
</fieldset>

<h3>Inspiring Stories</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[title_2]" class="form-control"
            @if($obj->content && isset($obj->content['title_2']))
                value="{{ $obj->content['title_2'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Main Title</label>
        <input type="text" name="content[main_title_2]" class="form-control"
            @if($obj->content && isset($obj->content['main_title_2']))
                value="{{ $obj->content['main_title_2'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-6">
        <label>Button Text</label>
        <input type="text" name="content[story_btn_text]" class="form-control"
            @if($obj->content && isset($obj->content['story_btn_text']))
                value="{{ $obj->content['story_btn_text'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[story_btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['story_btn_link']))
                value="{{ $obj->content['story_btn_link'] }}"
            @endif
        >
    </div>
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

<h3>Events Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[events_title]" class="form-control"
            @if($obj->content && isset($obj->content['events_title']))
                value="{{ $obj->content['events_title'] }}"
            @endif
        >
    </div>
    <div class="row">
    <div class="form-group col-md-6">
        <label>Button Text</label>
        <input type="text" name="content[btn_text]" class="form-control"
            @if($obj->content && isset($obj->content['btn_text']))
                value="{{ $obj->content['btn_text'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['btn_link']))
                value="{{ $obj->content['btn_link'] }}"
            @endif
        >
    </div>
    </div>
</fieldset>
<h3>Divisions Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[divisions_title]" class="form-control"
            @if($obj->content && isset($obj->content['divisions_title']))
                value="{{ $obj->content['divisions_title'] }}"
            @endif
        >
    </div>


    <div class="row">
        <div class="form-group col-md-6">
            <label>Button Text</label>
            <input type="text" name="content[divisions_btn_text]" class="form-control"
                @if($obj->content && isset($obj->content['divisions_btn_text']))
                    value="{{ $obj->content['divisions_btn_text'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-6">
            <label>Button Link</label>
            <input type="text" name="content[divisions_btn_link]" class="form-control"
                @if($obj->content && isset($obj->content['divisions_btn_link']))
                    value="{{ $obj->content['divisions_btn_link'] }}"
                @endif
            >
        </div>
    </div>
    
    <div class="form-group col-md-12">
            <a href="{{route('admin.services.index',['type'=>$obj->type])}}" class="btn btn-sm btn-danger" target="_blank"> Add Divisions </a>
    </div>
</fieldset>
<h3>Social Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[social_title]" class="form-control"
            @if($obj->content && isset($obj->content['social_title']))
                value="{{ $obj->content['social_title'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Small text</label>
        <textarea name="content[small_text]" class="form-control" rows="5">@if($obj->content && isset($obj->content['small_text'])){{ $obj->content['small_text'] }}@endif</textarea>
    </div>

   
</fieldset>
<h3>Awards Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[awards_title]" class="form-control"
            @if($obj->content && isset($obj->content['awards_title']))
                value="{{ $obj->content['awards_title'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Description</label>
        <textarea name="content[awards_description]" class="form-control" rows="5">@if($obj->content && isset($obj->content['awards_description'])){{ $obj->content['awards_description'] }}@endif</textarea>
    </div>
    <div class="form-group col-md-12">
        @if ($obj->type == 'en')
            <input type="hidden" name="content[awards_listing_id]" value="4">
            <a href="{{route('admin.listing-items.index',[4])}}" class="btn btn-sm btn-danger" target="_blank"> Add Awards </a>
        @else
            <input type="hidden" name="content[awards_listing_id]" value="5">
            <a href="{{route('admin.listing-items.index',[5])}}" class="btn btn-sm btn-danger" target="_blank"> Add Awards </a>
        @endif
        
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Button Text</label>
            <input type="text" name="content[social_btn_text]" class="form-control"
                @if($obj->content && isset($obj->content['social_btn_text']))
                    value="{{ $obj->content['social_btn_text'] }}"
                @endif
            >
        </div>
        <div class="form-group col-md-6">
            <label>Button Link</label>
            <input type="text" name="content[social_btn_link]" class="form-control"
                @if($obj->content && isset($obj->content['social_btn_link']))
                    value="{{ $obj->content['social_btn_link'] }}"
                @endif
            >
        </div>
    </div>
</fieldset>
<h3>News Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[news_title]" class="form-control"
            @if($obj->content && isset($obj->content['news_title']))
                value="{{ $obj->content['news_title'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-12">
        <label>Description</label>
        <textarea name="content[news_description]" class="form-control" rows="5">@if($obj->content && isset($obj->content['news_description'])){{ $obj->content['news_description'] }}@endif</textarea>
    </div>
    <div class="form-group col-md-6">
        <label>Button Text</label>
        <input type="text" name="content[news_btn_text]" class="form-control"
            @if($obj->content && isset($obj->content['news_btn_text']))
                value="{{ $obj->content['news_btn_text'] }}"
            @endif
        >
    </div>
    <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[news_btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['news_btn_link']))
                value="{{ $obj->content['news_btn_link'] }}"
            @endif
        >
    </div>
        <a href="{{route('admin.news.index')}}" class="btn btn-sm btn-danger" target="_blank"> Add News </a>
    
</fieldset>
</div>
