@extends('layouts.app')

@section('css')
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endsection

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>SMTP</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary float-right" href="{{ route('smtp.create') }}">
                    Add New
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body p-0">
            <div id="dataTableBuilder_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer smtp-tabel">
                <table id="smtp-tabel" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <!-- <th>Description</th> -->
                            <th width="300px">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix"> </div>
    </div>
@endsection

@section('footer_script')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>

    <script type="text/javascript">
        var table = $('#smtp-tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('smtp.index') }}",
                columns: [
                    {data: 'mailer_id', name: 'mailer_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                order: [[ 1, 'asc' ]]
            });

            $(document).on('click', '.delete-smtp', function(){
                if(confirm("Are you sure to delete this smtp?")){
                    let id = $(this).data("id");
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    $.ajax({
                        type:'DELETE',
                        url:'smtp/'+id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {'id': id},
                        success: function(data) {
                            toastr.success(data.msg);
                            table.draw();
                        },
                        error: function(data){
                            table.draw();
                            toastr.error('Something went wrong, Please try again');
                        }
                    });
                }
            }); 
    </script>
@endsection