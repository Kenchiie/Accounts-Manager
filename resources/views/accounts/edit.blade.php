@extends('adminlte::page')
@section('title', 'Accounts | Edit')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="row py-4">
        <div class="col-md-6 col-12 mx-auto">
            <x-adminlte-card theme="primary" theme-mode="outline" title="Edit Account">
                @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

                <form action='{{ route('users.accounts.update', [$user, $account]) }}' method='POST'>
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="required" for="platform">Platform</label>
                        <x-adminlte-input name="platform" id="platform" value="{{ old('platform', $account->platform) }}" required autofocus />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <x-adminlte-input type="email" name="email" id="email" value="{{ old('email', $account->email) }}"
                            autocomplete="off" />
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <x-adminlte-input name="username" id="username" value="{{ old('username', $account->username) }}" autocomplete="off" />
                    </div>
                    <div class="mobile-number-container">
                        <label for="mobile-numbers1">Mobile Number</label>
                        @php
                            $oldMobileNumbers = old('mobile_numbers', $account->mobileNumbers->pluck('number')->toArray());
                        @endphp

                        @if (empty($oldMobileNumbers))
                            <x-adminlte-input name="mobile_numbers[]" class="mobile-numbers" id="mobile-numbers1"
                                data-id="1" autocomplete="off">
                                <x-slot name="appendSlot">
                                    <button type="button" class="input-group-text text-danger remove-mobile"
                                        title="Remove mobile">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </x-slot>
                            </x-adminlte-input>
                        @endif

                        @foreach ($oldMobileNumbers as $number)
                            <x-adminlte-input name="mobile_numbers[]" class="mobile-numbers" id="mobile-numbers1"
                                data-id="1" value="{{ $number }}">
                                <x-slot name="appendSlot">
                                    <button type="button" class="input-group-text text-danger remove-mobile"
                                        title="Remove mobile">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </x-slot>
                            </x-adminlte-input>
                        @endforeach
                    </div>
                    <button type="button" href="#" class="btn btn-primary btn-sm add-mobile"
                        style="margin-top: -5px">
                        <i class="fa fa-plus"></i> Add Mobile
                    </button>
                    <div class="mt-3">
                        <label for="password">Password</label>
                        <x-adminlte-input name="password" id="password" value="{{ old('password', $account->password) }}" autocomplete="off" />
                    </div>
                    <div>
                        <label for="pin">Pin</label>
                        <x-adminlte-input type="number" name="pin" id="pin" value="{{ old('pin', $account->pin) }}"
                            autocomplete="off" />
                    </div>
                    <div>
                        <label for="note">Note</label>
                        <x-adminlte-textarea name="note" id="note" rows="3" autocomplete="off">
                            {{ old('note', $account->note) }}
                        </x-adminlte-textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-danger">Discard</a>
                    </div>
                </form>
            </x-adminlte-card>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.add-mobile').on('click', function() {
                let elementCount = $('.mobile-numbers').length;
                let currentCount = elementCount + 1;
                let element = `
                    <x-adminlte-input name="mobile_numbers[]" class="mobile-numbers" id="mobile-numbers${currentCount}" data-id="${currentCount}" autocomplete="off">
                        <x-slot name="appendSlot">
                            <button type="button" class="input-group-text text-danger remove-mobile" title="Remove mobile">
                                <i class="fas fa-trash"></i>
                            </button>
                        </x-slot>
                    </x-adminlte-input>
                `;

                $('.mobile-number-container').append(element);
                $(`#mobile-numbers${currentCount}`).trigger('focus');
            });

            $(document).on('click', '.remove-mobile', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>
@endsection
