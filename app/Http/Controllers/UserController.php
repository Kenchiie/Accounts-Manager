<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->withCount('accounts');

            return DataTables::of($users)
                ->addColumn('accounts_count', function ($user) {
                    return $user->accounts()->count();
                })
                ->addColumn('action', function ($user) {
                    $viewBtn = view('components.table-view-button', ['url' => route('users.show', $user)]);
                    $editBtn = view('components.table-edit-button', ['url' => route('users.edit', $user)]);
                    $deleteBtn = view('components.table-delete-button', ['url' => route('users.destroy', $user)])->with(['model' => $user]);

                    return $viewBtn . $editBtn . $deleteBtn;
                })
                ->orderColumn('accounts_count', function ($query, $order) {
                    return $query->orderBy('accounts_count', $order);
                })
                ->setRowAttr([
                    'data-accounts-count' => function ($user) {
                        return $user->accounts()->count();
                    },
                ])
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        toastr()->success('User has been added.', 'Success');
        return redirect()->route('users.index');
    }

    public function show(User $user, Request $request)
    {
        if ($request->ajax()) {
            $accounts = Account::query()
                ->with('mobileNumbers')
                ->where('user_id', $user->id);

            return DataTables::eloquent($accounts)
                ->addColumn('mobile_numbers', function ($account) {
                    return $account->mobileNumbers->pluck('number')->implode(', ');
                })
                ->addColumn('action', function ($account) use ($user) {
                    $editBtn = view('components.table-edit-button', ['url' => route('users.accounts.edit', [$user, $account])]);
                    $deleteBtn = view('components.table-delete-button', ['url' => route('users.accounts.destroy', [$user, $account])]);

                    return $editBtn . $deleteBtn;
                })
                ->filterColumn('mobile_numbers', function ($query, $keyword) {
                    $query->with('mobileNumbers')->whereHas('mobileNumbers', function ($q) use ($keyword) {
                        $q->where('number', 'like', '%' . $keyword . '%');
                    });
                })
                ->rawColumns(['mobile_numbers', 'action'])
                ->make(true);
        }

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());

        toastr()->success('User has been updated.', 'Success');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        toastr()->success('User has been deleted.', 'Success');
        return redirect()->route('users.index');
    }
}
