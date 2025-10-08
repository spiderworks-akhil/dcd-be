{{-- <div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm" data-validate=true>
            @csrf
            <input type="hidden" name="id" value="1">
            <div class="card">
                <div class="card-header">
                    Map
                </div>
                <div class="card-body row">
                    <div class="col-md-12">

                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-12">
                                Title
                                <input type="text" name="section[map]" class="form-control"
                                    value="{{ $data['map']['map'] }}">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>
</div> --}}


{{-- /upvc products --}}

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm" data-validate=true>
            @csrf
            <input type="hidden" name="id" value="2">
            <div class="card">
                <div class="card-header">
                    Get In Touch
                </div>
                <div class="card-body row">
                    <div class="col-md-12">

                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-12">
                                Title
                                <input type="text" name="section[title]" class="form-control"
                                    value="@if (!empty($data['get_in_touch']['title'])) {{ $data['get_in_touch']['title'] }} @endif">
                            </div>

                            <div class="form-group col-md-12">
                                Sub Title
                                <input type="text" name="section[sub_title]" class="form-control"
                                    value="@if (!empty($data['get_in_touch']['sub_title'])) {{ $data['get_in_touch']['sub_title'] }} @endif">
                            </div>

                            <div class="form-group col-md-12">
                                Button Text
                                <input type="text" name="section[button_text]" class="form-control"
                                    value="@if (!empty($data['get_in_touch']['button_text'])) {{ $data['get_in_touch']['button_text'] }} @endif">
                            </div>

                            <div class="form-group col-md-12">
                                Button Url
                                <input type="text" name="section[button_url]" class="form-control"
                                    value="@if (!empty($data['get_in_touch']['button_url'])) {{ $data['get_in_touch']['button_url'] }} @endif">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="3">

            <div class="card">
                <div class="card-header">
                    Learn More
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <input type="hidden" name="section[etihad_rail_listing_id]" value="1">

                        <div class="row" style="text-align: center;">

                            <div class="form-group col-md-12">
                                Title
                                <input type="text" name="section[title]" class="form-control"
                                    value="@if (!empty($data['learn_more']['title'])) {{ $data['learn_more']['title'] }} @endif">
                            </div>

                            {{-- <div class="form-group col-md-12">
                                Sub Title
                                <input type="text" name="section[sub_title]" class="form-control"
                                    value="@if (!empty($data['learn_more']['sub_title'])) {{ $data['learn_more']['sub_title'] }} @endif">
                            </div> --}}

                            <div class="form-group col-md-12">
                                <a href="{{ route('admin.listing-items.index', [1]) }}" class="btn btn-sm btn-danger"
                                    target="_blank"> Listing </a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="8">
            <div class="card">
                <div class="card-header">
                    volunteer
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="form-group col-md-12">
                            <label>Image</label>
                            @php
                                $media_id_1 = isset($data['volunteer']['media_id_1'])
                                    ? (object) $data['volunteer']['media_id_1']
                                    : null;
                            @endphp
                            @include('admin.media.set_file', [
                                'file' => $media_id_1,
                                'title' => 'Image',
                                'popup_type' => 'single_image',
                                'type' => 'Image',
                                'holder_attr' => 'section[media_id_1]',
                                'id' => 'media_id_1',
                                'display' => 'horizontal',
                            ])
                        </div>

                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-6">
                                Small Title
                                <input type="text" name="section[small_title]" class="form-control"
                                    value="@if (!empty($data['volunteer']['small_title'])) {{ $data['volunteer']['small_title'] ?? '' }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                Main Title
                                <input type="text" name="section[main_title]" class="form-control"
                                    value="@if (!empty($data['volunteer']['main_title'])) {{ $data['volunteer']['main_title'] ?? '' }} @endif">
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-12">
                                Short Description
                                <textarea name="section[short_description]" id="short_description" cols="30" rows="2" class="form-control">
@if (!empty($data['volunteer']['short_description']))
{{ $data['volunteer']['short_description'] ?? '' }}
@endif
</textarea>
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-6">
                                Button Link
                                <input type="text" name="section[button_link]" class="form-control"
                                    value="@if (!empty($data['volunteer']['button_link'])) {{ $data['volunteer']['button_link'] ?? '' }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                Button Text
                                <input type="text" name="section[button_text]" class="form-control"
                                    value="@if (!empty($data['volunteer']['button_text'])) {{ $data['volunteer']['button_text'] ?? '' }} @endif">
                            </div>

                        </div>

                         <div class="form-group col-md-12">
                            <label>Logo</label>
                            @php
                                $media_id_logo = isset($data['volunteer']['media_id_logo'])
                                    ? (object) $data['volunteer']['media_id_logo']
                                    : null;
                            @endphp
                            @include('admin.media.set_file', [
                                'file' => $media_id_logo,
                                'title' => 'Image',
                                'popup_type' => 'single_image',
                                'type' => 'Image',
                                'holder_attr' => 'section[media_id_logo]',
                                'id' => 'media_id_logo',
                                'display' => 'horizontal',
                            ])
                        </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="9">
            <div class="card">
                <div class="card-header">
                    Join The Club
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="row" style="text-align: center;">
                            <div class="form-group col-md-12">
                                Title
                                <input type="text" name="section[title]" class="form-control"
                                    value="@if (!empty($data['join_the_club']['title'])) {{ $data['join_the_club']['title'] }} @endif">
                            </div>
                            <div class="form-group col-md-12">
                                Short Description
                                <textarea name="section[short_description]" cols="30" rows="2" class="form-control">
@if (!empty($data['join_the_club']['short_description']))
{{ $data['join_the_club']['short_description'] }}
@endif
</textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    Button Text
                                    <input type="text" name="section[button_text]" class="form-control"
                                        value="@if (!empty($data['join_the_club']['button_text'])) {{ $data['join_the_club']['button_text'] }} @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    Button Link
                                    <input type="text" name="section[button_link]" class="form-control"
                                        value="@if (!empty($data['join_the_club']['button_link'])) {{ $data['join_the_club']['button_link'] }} @endif">
                                </div>

                                
                            </div>
                             <div class="form-group col-md-12">
                            <input type="hidden" name="section[join_the_club_listing_id]" value="33">
                            <a href="{{ route('admin.listing-items.index', [33]) }}" class="btn btn-sm btn-danger"
                                    target="_blank"> Images List </a>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="11">
            <div class="card">
                <div class="card-header">
                    Popup
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="row" style="text-align: center;">

                            <div class="form-group col-md-12">
                                Title
                                <input type="text" name="section[title]" class="form-control"
                                    value="@if (!empty($data['popup']['title'])) {{ $data['popup']['title'] }} @endif">
                            </div>

                            <div class="form-group col-md-12">
                                <label>Image</label>
                                @php
                                    $media_id_2 = isset($data['popup']['media_id_2'])
                                        ? (object) $data['popup']['media_id_2']
                                        : null;
                                @endphp
                                @include('admin.media.set_file', [
                                    'file' => $media_id_2,
                                    'title' => 'Image',
                                    'popup_type' => 'single_image',
                                    'type' => 'Image',
                                    'holder_attr' => 'section[media_id_2]',
                                    'id' => 'media_id_2',
                                    'display' => 'horizontal',
                                ])
                            </div>

                            <div class="form-group col-md-12">
                                Button Link
                                <input type="text" name="section[button_link]" class="form-control"
                                    value="@if (!empty($data['popup']['button_link'])) {{ $data['popup']['button_link'] }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                Live Streaming Title
                                <input type="text" name="section[live_streaming_title]" class="form-control"
                                    value="@if (!empty($data['popup']['live_streaming_title'])) {{ $data['popup']['live_streaming_title'] }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                Watch Button Title
                                <input type="text" name="section[watch_button_title]" class="form-control"
                                    value="@if (!empty($data['popup']['watch_button_title'])) {{ $data['popup']['watch_button_title'] }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                Close Button Title
                                <input type="text" name="section[close_button_title]" class="form-control"
                                    value="@if (!empty($data['popup']['close_button_title'])) {{ $data['popup']['close_button_title'] }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input type="hidden" name="show_popup" value="no">

                                    <input class="form-check-input" type="checkbox" id="showPopupCheckbox"
                                        name="section[show_popup]" value="yes"
                                        @if (!empty($data['popup']['show_popup']) && $data['popup']['show_popup'] == 'yes') checked @endif>
                                    <label class="form-check-label" for="showPopupCheckbox">
                                        Show Popup
                                    </label>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="13">
            <div class="card">
                <div class="card-header">
                    Youtube Live Stream
                </div>
                <div class="card-body row">
                    <div class="col-md-12">

                        <div class="form-group col-md-12">
                            <input type="hidden" name="section[live_stream_listing_id]" value="31">
                            <a href="{{ route('admin.listing-items.index', [31]) }}" class="btn btn-sm btn-danger"
                                target="_blank"> Live stream </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-sm btn-primary">Update</button>
            </div>
    </div>
    </form>
</div>




<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
            data-validate=true>
            @csrf
            <input type="hidden" name="id" value="15">
            <div class="card">
                <div class="card-header">
                    Subscribe
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="row" style="text-align: center;">

                            <div class="form-group col-md-6">
                                Title
                                <input type="text" name="section[subscribe_title]" class="form-control"
                                    value="@if (!empty($data['subscribe']['subscribe_title'])) {{ $data['subscribe']['subscribe_title'] }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                 Description
                                <input type="text" name="section[subscribe_description]" class="form-control"
                                    value="@if (!empty($data['subscribe']['subscribe_description'])) {{ $data['subscribe']['subscribe_description'] }} @endif">
                            </div>

                             <div class="form-group col-md-6">
                                 Button Text
                                <input type="text" name="section[subscribe_button_text]" class="form-control"
                                    value="@if (!empty($data['subscribe']['subscribe_button_text'])) {{ $data['subscribe']['subscribe_button_text'] }} @endif">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
