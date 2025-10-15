
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
    {{-- <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[story_btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['story_btn_link']))
                value="{{ $obj->content['story_btn_link'] }}"
            @endif
        >
    </div> --}}
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
    {{-- <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['btn_link']))
                value="{{ $obj->content['btn_link'] }}"
            @endif
        >
    </div> --}}
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
        {{-- <div class="form-group col-md-6">
            <label>Button Link</label>
            <input type="text" name="content[divisions_btn_link]" class="form-control"
                @if($obj->content && isset($obj->content['divisions_btn_link']))
                    value="{{ $obj->content['divisions_btn_link'] }}"
                @endif
            >
        </div> --}}
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

    <div class="row">

        <div class="form-group col-md-6">
            <label>Card 1 - Video Description</label>
            <input type="text" name="content[video_description_1]" class="form-control"
                @if($obj->content && isset($obj->content['video_description_1']))
                    value="{{ $obj->content['video_description_1'] }}"
                @endif
            >
        </div>
        

         <div class="form-group col-md-6">
            <label>Link </label>
            <input type="text" name="content[link_1]" class="form-control"
                @if($obj->content && isset($obj->content['link_1']))
                    value="{{ $obj->content['link_1'] }}"
                @endif
            >
        </div>


        <div class="form-group col-md-6">
                @php
                    $media_id_1 = $obj->content && isset($obj->content['media_id_1']) ? $obj->content['media_id_1'] : null;
                @endphp
                @include('admin.media.set_file', [
                    'file' => $media_id_1,
                    'title' => 'Video',
                    'popup_type' => 'single_video',
                    'type' => 'Video',
                    'holder_attr' => 'content[media_id_1]',
                    'id' => 'content_video_1',
                    'display' => 'horizontal',
                ])
        </div>

        <div class="form-group col-md-12"></div>


         <div class="form-group col-md-6">
            <label>Card 2 - Image Description</label>
            <input type="text" name="content[image_short_description_1]" class="form-control"
                @if($obj->content && isset($obj->content['image_short_description_1']))
                    value="{{ $obj->content['image_short_description_1'] }}"
                @endif
            >
        </div>

          <div class="form-group col-md-6">
            <label>Link </label>
            <input type="text" name="content[link_2]" class="form-control"
                @if($obj->content && isset($obj->content['link_2']))
                    value="{{ $obj->content['link_2'] }}"
                @endif
            >
        </div>



        {{-- <div class="form-group col-md-6">
            <label>Image title</label>
            <input type="text" name="content[image_title_1]" class="form-control"
                @if($obj->content && isset($obj->content['image_title_1']))
                    value="{{ $obj->content['image_title_1'] }}"
                @endif
            >
        </div> --}}
        <div class="form-group  col-md-6">
            <label>  Image  </label>

            @php
                $media_id_2 = $obj->content && isset($obj->content['media_id_2']) ? $obj->content['media_id_2'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_2,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_2]',
                'id' => 'content_image_2',
                'display' => 'horizontal',
            ])
        </div>
         <div class="form-group  col-md-6">
            <label>Logo  Image 1</label>

            @php
                $media_id_media_story_1 = $obj->content && isset($obj->content['media_id_media_story_1']) ? $obj->content['media_id_media_story_1'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_media_story_1,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_media_story_1]',
                'id' => 'media_story_1',
                'display' => 'horizontal',
            ])
        </div>

         <div class="form-group  col-md-6">
            <label>Logo Image 2</label>

            @php
                $media_id_media_story_2 = $obj->content && isset($obj->content['media_id_media_story_2']) ? $obj->content['media_id_media_story_2'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_media_story_2,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_media_story_2]',
                'id' => 'media_story_2',
                'display' => 'horizontal',
            ])
        </div>
         <div class="form-group  col-md-6">
            <label>Logo Image 3</label>

            @php
                $media_id_media_story_3 = $obj->content && isset($obj->content['media_id_media_story_3']) ? $obj->content['media_id_media_story_3'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_media_story_3,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_media_story_3]',
                'id' => 'media_story_3',
                'display' => 'horizontal',
            ])
        </div>
         <div class="form-group  col-md-6">
            <label>Logo Image 4</label>

            @php
                $media_id_media_story_4 = $obj->content && isset($obj->content['media_id_media_story_4']) ? $obj->content['media_id_media_story_4'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_media_story_4,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_media_story_4]',
                'id' => 'media_story_4',
                'display' => 'horizontal',
            ])
        </div>
         <div class="form-group  col-md-6">
            <label>Logo Image 5</label>

            @php
                $media_id_media_story_5 = $obj->content && isset($obj->content['media_id_media_story_5']) ? $obj->content['media_id_media_story_5'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_media_story_5,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_media_story_5]',
                'id' => 'media_story_5',
                'display' => 'horizontal',
            ])
        </div>

        

         <div class="form-group col-md-6">
            <label>Card 3 - Image title </label>
            <input type="text" name="content[image_title_2]" class="form-control"
                @if($obj->content && isset($obj->content['image_title_2']))
                    value="{{ $obj->content['image_title_2'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-6">
            <label>Link </label>
            <input type="text" name="content[link_3]" class="form-control"
                @if($obj->content && isset($obj->content['link_3']))
                    value="{{ $obj->content['link_3'] }}"
                @endif
            >
        </div>


        <div class="form-group  col-md-6">
            <label>Image  </label>

            @php
                $media_id_3 = $obj->content && isset($obj->content['media_id_3']) ? $obj->content['media_id_3'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_3,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_3]',
                'id' => 'content_image_3',
                'display' => 'horizontal',
            ])
        </div>

        <div class="form-group  col-md-12"></div>


         


          <div class="form-group col-md-6">
            <label>Card 4 - Link </label>
            <input type="text" name="content[link_4]" class="form-control"
                @if($obj->content && isset($obj->content['link_4']))
                    value="{{ $obj->content['link_4'] }}"
                @endif
            >
        </div>

       

          

         <div class="form-group  col-md-6">
            <label>Image  </label>

            @php
                $media_id_4 = $obj->content && isset($obj->content['media_id_4']) ? $obj->content['media_id_4'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_4,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_4]',
                'id' => 'content_image_4',
                'display' => 'horizontal',
            ])
        </div>


         <div class="form-group col-md-6">
            <label>Card 5 - Image title </label>
            <input type="text" name="content[image_title_4]" class="form-control"
                @if($obj->content && isset($obj->content['image_title_4']))
                    value="{{ $obj->content['image_title_4'] }}"
                @endif
            >
        </div>


          <div class="form-group col-md-6">
            <label>Link </label>
            <input type="text" name="content[link_5]" class="form-control"
                @if($obj->content && isset($obj->content['link_5']))
                    value="{{ $obj->content['link_5'] }}"
                @endif
            >
        </div>

        
        <div class="form-group  col-md-6">
            <label>  Image </label>

            @php
                $media_id_5 = $obj->content && isset($obj->content['media_id_5']) ? $obj->content['media_id_5'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_5,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_5]',
                'id' => 'content_image_5',
                'display' => 'horizontal',
            ])
        </div>

        <div class="form-group col-md-12"></div>

        
<div class="form-group col-md-6">
            <label>Card 6 - Link </label>
            <input type="text" name="content[link_6]" class="form-control"
                @if($obj->content && isset($obj->content['link_6']))
                    value="{{ $obj->content['link_6'] }}"
                @endif
            >
        </div>

        <div class="form-group  col-md-6">
            <label>Image  </label>

            @php
                $media_id_6 = $obj->content && isset($obj->content['media_id_6']) ? $obj->content['media_id_6'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_6,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_6]',
                'id' => 'content_image_6',
                'display' => 'horizontal',
            ])
        </div>

          

           <div class="form-group col-md-6">
            <label>Card 7 - Image title </label>
            <input type="text" name="content[image_title_6]" class="form-control"
                @if($obj->content && isset($obj->content['image_title_6']))
                    value="{{ $obj->content['image_title_6'] }}"
                @endif
            >
        </div>

        <div class="form-group col-md-6">
            <label>Link </label>
            <input type="text" name="content[link_7]" class="form-control"
                @if($obj->content && isset($obj->content['link_7']))
                    value="{{ $obj->content['link_7'] }}"
                @endif
            >
        </div>


        <div class="form-group  col-md-6">
            <label>Image  </label>

            @php
                $media_id_7 = $obj->content && isset($obj->content['media_id_7']) ? $obj->content['media_id_7'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_7,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_7]',
                'id' => 'content_image_7',
                'display' => 'horizontal',
            ])
        </div>

          


    </div>



</fieldset>
<h3>Awards Section</h3>
<fieldset>
 <div class="form-group col-md-12">
        <label>Short Title</label>
        <input type="text" name="content[award_short_title]" class="form-control"
            @if($obj->content && isset($obj->content['award_short_title']))
                value="{{ $obj->content['award_short_title'] }}"
            @endif
        >
    </div>

    <div class="row">

    <div class="form-group  col-md-6">
            <label>Image 1</label>

            @php
                $media_id_award_image_1 = $obj->content && isset($obj->content['media_id_award_image_1']) ? $obj->content['media_id_award_image_1'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_award_image_1,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_award_image_1]',
                'id' => 'award_image_1',
                'display' => 'horizontal',
            ])
        </div>
        <div class="form-group  col-md-6">
            <label>Image 2</label>

            @php
                $media_id_award_image_2 = $obj->content && isset($obj->content['media_id_award_image_2']) ? $obj->content['media_id_award_image_2'] : null;
            @endphp
            @include('admin.media.set_file', [
                'file' => $media_id_award_image_2,
                'title' => 'Image',
                'popup_type' => 'single_image',
                'type' => 'Image',
                'holder_attr' => 'content[media_id_award_image_2]',
                'id' => 'award_image_2',
                'display' => 'horizontal',
            ])
        </div>
    </div>
    
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
    {{-- <div class="form-group col-md-12">
        <label>Description</label>
        <textarea name="content[news_description]" class="form-control" rows="5">@if($obj->content && isset($obj->content['news_description'])){{ $obj->content['news_description'] }}@endif</textarea>
    </div> --}}
    <div class="form-group col-md-6">
        <label>Button Text</label>
        <input type="text" name="content[news_btn_text]" class="form-control"
            @if($obj->content && isset($obj->content['news_btn_text']))
                value="{{ $obj->content['news_btn_text'] }}"
            @endif
        >
    </div>
    {{-- <div class="form-group col-md-6">
        <label>Button Link</label>
        <input type="text" name="content[news_btn_link]" class="form-control"
            @if($obj->content && isset($obj->content['news_btn_link']))
                value="{{ $obj->content['news_btn_link'] }}"
            @endif
        >
    </div> --}}
        <a href="{{route('admin.news.index')}}" class="btn btn-sm btn-danger" target="_blank"> Add News </a>

</fieldset>

</div>
