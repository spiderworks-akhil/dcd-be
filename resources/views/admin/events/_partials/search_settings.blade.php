<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="filter-form" id="searchForm">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="publication_status">Status</label>
                                <select name="publication_status" class="form-control datatable-advanced-search webadmin-select2-input">
                                    <option value="">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Waiting for approval">Waiting for approval</option>
                                    {{-- <option value="Approved">Approved</option> --}}
                                    <option value="Rejected">Rejected</option>
                                    <option value="Published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="language">Language</label>
                                <select name="language" class="form-control datatable-advanced-search webadmin-select2-input">
                                    <option value="">All</option>
                                    <option value="en">English</option>
                                    <option value="ar">Arabic</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="from_date">Created From</label>
                                <input type="text" class="form-control datatable-advanced-search filter-datepicker" name="from_date-created_at" autocomplete="off" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="to_date">Created To</label>
                                <input type="text" class="form-control datatable-advanced-search filter-datepicker" name="to_date-created_at" autocomplete="off" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="created_by">Created By</label>
                                <select name="created_by" class="form-control datatable-advanced-search webadmin-select2-input">
                                    <option value="">All</option>
                                    @foreach (($search_settings['admins'] ?? []) as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="updated_by">Updated By</label>
                                <select name="updated_by" class="form-control datatable-advanced-search webadmin-select2-input">
                                    <option value="">All</option>
                                    @foreach (($search_settings['admins'] ?? []) as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group flex items-center mt-4">
                                <button type="button" class="btn btn-primary px-4 mr-2" onclick="dt();">Filter</button>
                                <button type="button" class="btn btn-secondary px-4" id="search-table-clear-btn">Clear</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>