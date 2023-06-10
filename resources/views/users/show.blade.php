@extends('adminlte::page')
@section('title', 'User Accounts')

@section('content_header')
    <x-header title="{{ $user->first_name }} {{ $user->last_name }}">
        <a href="{{ route('users.accounts.create', $user) }}" class="btn btn-primary">
            Add Account
        </a>
        <a href="{{ route('users.accounts.export', ['user' => $user]) }}" class="btn btn-primary">
            Export
        </a>
    </x-header>
@stop

@section('content')
    <div class="py-4">
        <x-adminlte-card theme="primary" theme-mode="outline">
            <x-table>
                <thead>
                    <tr>
                        <th>Platform</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Mobile Numbers</th>
                        <th>Password</th>
                        <th>Pin</th>
                        <th>Note</th>
                        <th style="width: 100px">Action</th>
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
                    url: "{{ route('users.show', $user) }}",
                },
                columns: [{
                    data: 'platform',
                    name: 'platform',
                }, {
                    data: 'email',
                    name: 'email',
                }, {
                    data: 'username',
                    name: 'username',
                }, {
                    data: 'mobile_numbers',
                    name: 'mobile_numbers',
                    orderable: false,
                }, {
                    data: 'password',
                    name: 'password',
                }, {
                    data: 'pin',
                    name: 'pin',
                }, {
                    data: 'note',
                    name: 'note',
                }, {
                    data: 'action',
                    data: 'action',
                    orderable: false,
                    searchable: false,
                }, ],
            });

            $(document).on('click', '.delete-button', function(e) {
                e.preventDefault();

                // Use SweetAlert2 to prompt the user
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the delete form
                        $(this).siblings('.delete-form').submit();
                    }
                });
            });
        });
    </script>
@stop
