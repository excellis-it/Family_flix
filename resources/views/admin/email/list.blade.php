@extends('admin.layouts.master')
@section('title')
    Email List
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
            padding-right: 30px;
            /* Add space for the icon */
            cursor: pointer;
            color: #333;
            font-weight: bold;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: background-color 0.3s ease;
            /* Smooth transition for feedback */
        }

        .affiliate-url:hover {
            color: #000;
            /* Change color on hover */
        }

        .affiliate-url i {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
        }

        /* Style for the copy icon */
        .affiliate-url i.fas.fa-copy:before {
            content: '\f0c5';
            /* Unicode for copy icon */
            font-family: 'Font Awesome 5 Free';
            /* Font Awesome */
            font-size: 18px;
            color: #666;
        }

        /* Style for copied state */
        .affiliate-url.copied {
            background-color: #d4edda;
            /* Change background color when copied */
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
                    <h3>Email</h3>
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
                <div class="card w-100">
                    <div class="card-body">

                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col-md-6">
                                <div>
                                    <h4>List of Emails</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-1 justify-content-end">
                                    <div class="col-md-8 pr-0">
                                        <div class="search-field prod-search">
                                            <input type="text" name="search" id="search" placeholder="search..."
                                                required class="form-control">
                                            <a href="javascript:void(0)" class="prod-search-icon"><i
                                                    class="ti ti-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody cusrsor-pointer"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th><span class="fs-4 fw-semibold mb-0">Name</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Subject</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Title</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyContents">
                                    @include('admin.email.filter')

                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
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
            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('emails.ajax.list') }}",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        $('tbody').html(data.data);
                    }
                });
            }

            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });
            $(document).on('click', '.close-pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);

                var query = $('#search').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
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
                    text: "To delete this email",
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


@endpush
