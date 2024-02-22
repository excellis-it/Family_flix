@extends('admin.layouts.master')
@section('title')
    Affiliate Marketer List
@endsection
@push('styles')
    <style>
        .error {
            color: red !important;
        }

        .affiliate-url {
            width: 300px;
            /* Adjust the width as needed */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }

        .affiliate-url {
    position: relative;
    display: inline-block;
    padding-right: 30px; /* Add space for the icon */
    cursor: pointer;
    color: #333;
    font-weight: bold;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition: background-color 0.3s ease; /* Smooth transition for feedback */
}

.affiliate-url:hover {
    color: #000; /* Change color on hover */
}

.affiliate-url i {
    position: absolute;
    top: 50%;
    right: 5px;
    transform: translateY(-50%);
}

/* Style for the copy icon */
.affiliate-url i.fas.fa-copy:before {
    content: '\f0c5'; /* Unicode for copy icon */
    font-family: 'Font Awesome 5 Free'; /* Font Awesome */
    font-size: 18px;
    color: #666;
}

/* Style for copied state */
.affiliate-url.copied {
    background-color: #d4edda; /* Change background color when copied */
}

    </style>
@endpush
@section('content')
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Affiliate Marketer</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"> List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 text-end mb-3">
                    <a class="print_btn" href="{{ route('affliate-marketer.create') }}">+ Add
                        New Affiliate Marketer</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Affiliate Marketer</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody" id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th> Name</th>
                                        <th> Email</th>
                                        <th> Phone</th>
                                        <th>Affiliate URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            var table = $('#myTable').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [3, 4, 5]
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1, 2]
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('affliate-marketer.ajax.list') }}",
                    type: "POST", // specifying the type of request
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // include CSRF token if you are using Laravel
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'affiliate_url',
                        name: 'affiliate_url',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
    <script>
       function copyText(element) {
    var text = element.textContent.trim(); // Trim to remove leading/trailing whitespace
    var dummy = document.createElement('textarea');
    dummy.value = text;
    document.body.appendChild(dummy);
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);

    // Visual feedback
    element.classList.add('copied');
    setTimeout(function() {
        element.classList.remove('copied');
    }, 1000); // Remove the 'copied' class after 1 second
}
    </script>
    <script>
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this affiliate marketer.",
                    type: "warning",
                    confirmButtonText: "Yes",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        window.location = $(this).data('route');
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
        });
    </script>

    <script>
        $(document).on('change', '.toggle-class', function(e) {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('affliate-marketer.change-status') }}',
                data: {
                    'status': status,
                    'user_id': user_id
                },
                success: function(resp) {
                    console.log(resp.success)
                }
            });
        });
    </script>
@endpush
