<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

    <h3>Top Content</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_1]" class="form-control"
                @if ($obj->content && isset($obj->content['title_1'])) value="{{ $obj->content['title_1'] }}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Short Description</label>
            <input type="text" name="content[short_description]" class="form-control"
                @if ($obj->content && isset($obj->content['short_description'])) value="{{ $obj->content['short_description'] }}" @endif>
        </div>
    </fieldset>

    <h3>Discover </h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_2]" class="form-control"
                @if ($obj->content && isset($obj->content['title_2'])) value="{{ $obj->content['title_2'] }}" @endif>
        </div>
        <div class="form-group">
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
    </fieldset>

    <h3>Board of directors </h3>
    <fieldset>
        <div class="row">

            <div class="form-group col-md-6">
                <label>Executive Director</label>
                <input type="text" name="content[executive_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['executive_director'])) value="{{ $obj->content['executive_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Executive Director Name</label>
                <input type="text" name="content[executive_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['executive_director_name'])) value="{{ $obj->content['executive_director_name'] }}" @endif>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Financial Director</label>
                <input type="text" name="content[financial_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['financial_director'])) value="{{ $obj->content['financial_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Executive Director Name</label>
                <input type="text" name="content[financial_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['financial_director_name'])) value="{{ $obj->content['financial_director_name'] }}" @endif>
            </div>
        </div>

         <div class="row">
            <div class="form-group col-md-6">
                <label>Marketing Director</label>
                <input type="text" name="content[marketing_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['marketing_director'])) value="{{ $obj->content['marketing_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Marketing Director Name </label>
                <input type="text" name="content[marketing_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['marketing_director_name'])) value="{{ $obj->content['marketing_director_name'] }}" @endif>
            </div>
        </div>

    </fieldset>

     <h3>Investment Office </h3>
    <fieldset>
         <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_3]" class="form-control"
                @if ($obj->content && isset($obj->content['title_3'])) value="{{ $obj->content['title_3'] }}" @endif>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Head of the Services and Logistics</label>
                <input type="text" name="content[services_and_logistic_head]" class="form-control"
                    @if ($obj->content && isset($obj->content['services_and_logistic_head'])) value="{{ $obj->content['services_and_logistic_head'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label> Name</label>
                <input type="text" name="content[services_and_logistic_head_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['services_and_logistic_head_name'])) value="{{ $obj->content['services_and_logistic_head_name'] }}" @endif>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label> Media Director</label>
                <input type="text" name="content[media_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['media_director'])) value="{{ $obj->content['media_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Media Director Name</label>
                <input type="text" name="content[media_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['media_director_name'])) value="{{ $obj->content['media_director_name'] }}" @endif>
            </div>
        </div>

    </fieldset>

      <h3>Communication Office </h3>
    <fieldset>
         <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[title_4]" class="form-control"
                @if ($obj->content && isset($obj->content['title_4'])) value="{{ $obj->content['title_4'] }}" @endif>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Sports Director</label>
                <input type="text" name="content[sports_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['sports_director'])) value="{{ $obj->content['sports_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Sports Director Name</label>
                <input type="text" name="content[sports_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['sports_director_name'])) value="{{ $obj->content['sports_director_name'] }}" @endif>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label> Cultural and Community Director</label>
                <input type="text" name="content[culture_and_community_director]" class="form-control"
                    @if ($obj->content && isset($obj->content['culture_and_community_director'])) value="{{ $obj->content['culture_and_community_director'] }}" @endif>
            </div>

            <div class="form-group col-md-6">
                <label>Cultural and Community Director Name</label>
                <input type="text" name="content[culture_and_community_director_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['culture_and_community_director_name'])) value="{{ $obj->content['culture_and_community_director_name'] }}" @endif>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <label> Head of the Community Activities</label>
                <input type="text" name="content[head_of_community_activities]" class="form-control"
                    @if ($obj->content && isset($obj->content['head_of_community_activities'])) value="{{ $obj->content['head_of_community_activities'] }}" @endif>
            </div>

            {{-- <div class="form-group col-md-6">
                <label>Head of the Community Activities Name</label>
                <input type="text" name="content[community_activity_head_name]" class="form-control"
                    @if ($obj->content && isset($obj->content['community_head_name'])) value="{{ $obj->content['community_head_name'] }}" @endif>
            </div> --}}
        </div>

    </fieldset>

</div>
