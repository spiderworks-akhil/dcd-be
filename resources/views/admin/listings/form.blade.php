<div class="settings-item w-100 confirm-wrap card" style="border:0; background:none;">
  <div class="row m-0">
    <form id="inputForm" data-validate=true class="w-100" method="POST" @if($obj->id) action="{{ route($route.'.update') }}" @else action="{{ route($route.'.store') }}" @endif enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif />
        <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$obj->name}}">
        </div>
        <div class="form-group col-md-12">
          Configurations
          <hr/>
        </div>
        <div class="row m-0">
          <div class="form-group col-md-6">
              <label for="name">Title</label>
              <select class="form-control" name="title">
                <option value="No" @if($obj->title == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->title == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>

          <div class="form-group col-md-6">
            <label for="name">Short Title</label>
            <select class="form-control" name="short_title">
              <option value="No" @if($obj->short_title == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->short_title == "Yes") selected="selected" @endif>Yes</option>
            </select>
            </div>

          <div class="form-group col-md-6">
              <label for="name">Short Description</label>
              <select class="form-control" name="short_description">
                <option value="No" @if($obj->short_description == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->short_description == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="name">Detailed Description</label>
              <select class="form-control" name="detailed_description">
                <option value="No" @if($obj->detailed_description == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->detailed_description == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>

          <div class="form-group col-md-6">
            <label for="name">Extra Description</label>
            <select class="form-control" name="extra_description">
              <option value="No" @if($obj->extra_description == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->extra_description == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

          <div class="form-group col-md-6">
              <label for="name">Icon</label>
              <select class="form-control" name="icon">
                <option value="No" @if($obj->icon == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->icon == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="name">Image</label>
              <select class="form-control" name="image">
                <option value="No" @if($obj->image == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->image == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="name">Alt Image</label>
              <select class="form-control" name="alt_image">
                <option value="No" @if($obj->alt_image == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->alt_image == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="name">Banner Image</label>
              <select class="form-control" name="banner">
                <option value="No" @if($obj->banner == "No") selected="selected" @endif >No</option>
                <option value="Yes" @if($obj->banner == "Yes") selected="selected" @endif>Yes</option>
              </select>
          </div>

          <div class="form-group col-md-6">
            <label for="name">Logo</label>
            <select class="form-control" name="logo">
              <option value="No" @if($obj->logo == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->logo == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="name">Date</label>
            <select class="form-control" name="date">
              <option value="No" @if($obj->date == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->date == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="name">Url Title</label>
            <select class="form-control" name="url_title">
              <option value="No" @if($obj->url_title == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->url_title == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

          <div class="form-group col-md-6">
            <label for="name">Url</label>
            <select class="form-control" name="url">
              <option value="No" @if($obj->url == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->url == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="name">Author </label>
            <select class="form-control" name="author_id">
              <option value="No" @if($obj->author_id == "No") selected="selected" @endif >No</option>
              <option value="Yes" @if($obj->author_id == "Yes") selected="selected" @endif>Yes</option>
            </select>
        </div>

        </div>
        <div class="  col-md-12">
           <button type="button" id="webadmin-ajax-form-submit-btn" class="btn btn-primary float-right">Submit</button>

        </div>

       
    </form>
  </div>
</div>
