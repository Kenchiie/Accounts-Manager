@extends('adminlte::page')
@section('title', 'Users')

@section('content_header')
    <x-header title="Users">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            Add User
        </a>
    </x-header>
@stop

@section('content')
    <div class="py-4">
        <x-adminlte-card theme="primary" theme-mode="outline">
            <x-table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Accounts</th>
                        <th style="width: 120px">Action</th>
                    </tr>
                </thead>
            </x-table>
        </x-adminlte-card>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.SweetAlert2', true)
@section('js')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                },
                columns: [{
                    data: 'first_name',
                    name: 'first_name',
                }, {
                    data: 'last_name',
                    name: 'last_name',
                }, {
                    data: 'accounts_count',
                    name: 'accounts_count',
                }, {
                    data: 'action',
                    data: 'action',
                    orderable: false,
                    searchable: false,
                }, ],
            });

            $(document).on('click', '.delete-button', function(e) {
                e.preventDefault();
                let accountsCount = $(this).closest('tr').data('accounts-count');

                if (accountsCount > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'This user cannot be deleted as they have accounts added.',
                    })
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).siblings('.delete-form').submit();
                        }
                    })
                }
            });
        });
    </script>
@stop
