<?php

namespace App\Http\Controllers;

use App\Exports\UserAccountExport;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\User;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function create(User $user)
    {
        return view('accounts.create', compact('user'));
    }

    public function store(User $user, AccountRequest $request)
    {
        $validated = $request->validated();

        $account = $user->accounts()->create([
            'platform' => $validated['platform'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'pin' => $validated['pin'],
            'note' => $validated['note'],
        ]);

        (new AccountService())->updateMobileNumbers($account, $validated);

        toastr()->success('Account has been added.', 'Success');

        if ($request['action'] == 'save_and_new') {
            return redirect()->route('users.accounts.create', $user);
        } else {
            return redirect()->route('users.show', $user);
        }
    }

    public function edit(User $user, Account $account)
    {
        return view('accounts.edit', compact('user', 'account'));
    }

    public function update(User $user, Account $account, AccountRequest $request)
    {
        $validated = $request->validated();

        $account->update([
            'platform' => $validated['platform'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => $validated['password'],
            'pin' => $validated['pin'],
            'note' => $validated['note'],
        ]);

        (new AccountService())->updateMobileNumbers($account, $validated);

        toastr()->success('Account has been updated.', 'Success');
        return redirect()->route('users.show', $user);
    }


    public function destroy(User $user, Account $account)
    {
        $account->delete();

        toastr()->success('Account has been deleted.', 'Success');
        return redirect()->route('users.show', $user);
    }

    public function export(User $user)
    {
        $fullName = str_replace(['_', ' '], '-', $user->first_name . '-' . $user->last_name);
        $fileName = strtolower($fullName). '-accounts.xlsx';

        return (new UserAccountExport($user))->download($fileName);
    }
}
