<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="filter-form" id="searchForm">
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="username">Date</label>
                                <input type="text" class="form-control datatable-advanced-search date-range-picker" name="date_between-news.created_at">
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="useremail">Status</label>
                                <select name="publication_status" class="form-control datatable-advanced-search webadmin-select2-input">
                                    <option value="">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Waiting for approval">Waiting for approval</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Published">Published</option>

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