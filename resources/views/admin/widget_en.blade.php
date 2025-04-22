<div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
                    data-validate=true>
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
                                        value="{{$data['map']['map']}}">
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


        {{-- /upvc products --}}

        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm"
                    data-validate=true>
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
                                          value="@if(!empty($data['get_in_touch']['title'])){{$data['get_in_touch']['title']}} @endif">
                                    </div>

                                    <div class="form-group col-md-12">
                                        Sub Title
                                       <input type="text" name="section[sub_title]" class="form-control"
                                       value="@if(!empty($data['get_in_touch']['sub_title'])){{$data['get_in_touch']['sub_title']}} @endif">
                                    </div>

                                    <div class="form-group col-md-12">
                                        Button Text
                                       <input type="text" name="section[button_text]" class="form-control"
                                          value="@if(!empty($data['get_in_touch']['button_text'])){{$data['get_in_touch']['button_text']}} @endif">
                                    </div>

                                    <div class="form-group col-md-12">
                                        Button Url
                                       <input type="text" name="section[button_url]" class="form-control"
                                          value="@if(!empty($data['get_in_touch']['button_url'])){{$data['get_in_touch']['button_url']}} @endif">
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
                                          value="@if(!empty($data['learn_more']['title'])){{$data['learn_more']['title']}} @endif">
                                    </div>

                                    <div class="form-group col-md-12">
                                        Sub Title
                                       <input type="text" name="section[sub_title]" class="form-control"
                                       value="@if(!empty($data['learn_more']['sub_title'])){{$data['learn_more']['sub_title']}} @endif">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <a href="{{route('admin.listing-items.index',[1])}}" class="btn btn-sm btn-danger" target="_blank" > Etihad rail </a>
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

