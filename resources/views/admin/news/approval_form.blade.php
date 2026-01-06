<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Approval</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Check and Confirm Content Status</h2>

        <div class="card p-4">

            {{-- ✅ Show dynamic model heading --}}
            <h5>
                @if ($modelType === 'news')
                    {{ $item->title }}
                @elseif($modelType === 'event')
                    {{ $item->name }}
                @else
                    Content Item
                @endif
            </h5>

            <div class="mt-3 p-3 border rounded">
                @if ($approval_notification && $approval_notification->status !== null)
                    {{-- ✅ Show approval result only if approved or rejected --}}
                    @if ($approval_notification->status === 'approved')
                        <span class="badge badge-success">Approved ✅</span>
                    @elseif ($approval_notification->status === 'rejected')
                        <span class="badge badge-danger">Rejected ❌</span>
                    @elseif ($approval_notification->status === 'pending')
                        {{-- ✅ Show form if status is pending --}}
                        <form action="{{ route('approval.submit', ['id' => encrypt($approval_notification->id)]) }}"
                            method="POST" class="mt-3">

                            @csrf

                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter remarks (optional)"></textarea>
                            </div>

                            <div class="form-group">
                                @if ($preselect_status === 'approve')
                                    <button type="submit" name="status" value="approved" class="btn btn-success">
                                        Approve
                                    </button>
                                @elseif ($preselect_status === 'reject')
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                        Reject
                                    </button>
                                @else
                                    <button type="submit" name="status" value="approved" class="btn btn-success">
                                        Approve
                                    </button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                        Reject
                                    </button>
                                @endif
                            </div>

                        </form>
                    @endif

                    @if ($approval_notification->remarks)
                        <p class="mt-2 mb-0">
                            <strong>Remarks:</strong> {{ $approval_notification->remarks }}
                        </p>
                    @endif
                @else
                    {{-- ✅ Show form if there's no status at all --}}
                    <form action="{{ route('approval.submit', ['id' => encrypt($approval_notification->id)]) }}"
                        method="POST" class="mt-3">

                        @csrf

                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter remarks (optional)"></textarea>
                        </div>

                        <div class="form-group">
                            @if ($preselect_status === 'approve')
                                <button type="submit" name="status" value="approved" class="btn btn-success">
                                    Approve
                                </button>
                            @elseif ($preselect_status === 'reject')
                                <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                    Reject
                                </button>
                            @else
                                <button type="submit" name="status" value="approved" class="btn btn-success">
                                    Approve
                                </button>
                                <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                    Reject
                                </button>
                            @endif
                        </div>

                    </form>
                @endif
            </div>

        </div>
    </div>

</body>

</html>
