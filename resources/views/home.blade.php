@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fs-4 fw-bold text-center">{{ __('Dashboard') }}</div>

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
            </div>
        </div>
        <div>
            <a class="btn btn-primary " href="/user/create" role="button">Add User</a>
        </div>
        </div>

        <div class="border col-12 my-2 py-4 rounded-2 table-responsive">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered" id="user_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

            var table = $('#user_datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        $('#user_datatable').on('click', '.btn_delete', function () {
            var id = $(this).data('id');
            var url= "/delete/"+id;
            var deleteConfirm = confirm("Are you sure to delete User with id : "+id+ "?");
            if (deleteConfirm == true) {
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                    {
                        url: url,
                        type: 'delete',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (){
                            console.log("it Works");

                        }
                    });
                table.ajax.reload();
            }
        });
    });
</script>
@endsection
