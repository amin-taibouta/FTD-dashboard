@extends('layouts.admin')

@section('main-content')

    @if (session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Custom page header alternative example-->
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="me-4 mb-3 mb-sm-0">
            <h1 class="mb-0">{{ _('Calls report') }}</h1>
            <div class="small">
                <span class="fw-500 text-primary">{{ date('l') }}</span>
                {{ date('F d, Y H:i T') }}
            </div>
        </div>
        <!-- Date range picker example-->
        <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem">
            <span class="input-group-text"><i data-feather="calendar"></i></span>
            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
        </div>
    </div>
    
        <div class="card mb-4">
            <div class="card-header"></div>
                <div class="card-body">
                    <table id="users-table">
                        <thead>
                            <tr>
                                <th>Date / time</th>
                                <th>Caller ID</th>
                                <th>Duration</th>
                                <th>Recording</th>
                                <th>Status</th>
                                <th>Actions</th>
							</tr>
                        </thead>
                    </table>
                </div>

                <script>
                $(function() {
                    $('#users-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('callsdatatables') !!}',
                        columns: [
                            { data: 'call_date', name: 'call_date' },
                            { data: 'caller_id', name: 'caller_id' },
                            { data: 'call_length', name: 'call_length' },
                            { data: 'recording_url', name: 'recording_url' },
                            { 
                                data: 'converted',
                                name: 'converted',
                                render : function(data, type, full, meta) {
                                    if (data == "Yes") {
										return '<div class="badge bg-info rounded-pill">Converted</div>';  
                                        //return '<div class="badge bg-warning rounded-pill">Disputed</div>';
                                    }
                                    /*if (full.email == "amin.taibouta6@gmail.com") {
                                        return '<div class="badge bg-danger rounded-pill">Rejected</div>';
                                    }
                                    if (full.email == "amin.taibouta1@gmail.com") {
                                        return '<div class="badge bg-secondary text-white rounded-pill">Approved</div>';
                                    }*/
								}	
                            },
                            { 
                                data: '',
                                name: '',
                                render : function(data, type, full, meta) {
                                    if (full.email == "amin.taibouta8@gmail.com") {
                                        return '';
                                    }
                                    if (full.email == "amin.taibouta6@gmail.com") {
                                        return '';
                                    }
                                    if (full.email == "amin.taibouta1@gmail.com") {
                                        return '';
                                    }
                                    return '<a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Dispute</a>';
                                }
                            }
                        ]
                    });
                });
                </script>

            </div>
        </div>
   
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ _('Submit a dispute about the call') }}</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0"><label for="exampleFormControlTextarea1">Please type in the dispute  reason</label><textarea class="form-control form-control-solid" id="exampleFormControlTextarea1" rows="3"></textarea></div>
                        </form>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">{{ _('Submit') }}</button></div>
                </div>
            </div>
        </div>
    
    @include('layouts.footer')
@endsection
