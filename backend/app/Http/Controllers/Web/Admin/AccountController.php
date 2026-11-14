<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AccountController extends Controller
{
    public function pending()
    {
        $users = User::whereIn('role', [2, 3])
            ->where('status', 0)
            ->with(['vendor', 'shop'])
            ->get();

        return view('admin.accounts.pending', compact('users'));
    }

    public function approve(User $user)
    {
        return $this->setStatus($user, 1, 'Account approved');
    }

    public function reject(User $user)
    {
        return $this->setStatus($user, 2, 'Account rejected');
    }

    private function setStatus(User $user, int $status, string $message)
    {
        abort_if($user->role == 1, 403);

        $user->update(['status' => $status]);
        $user->vendor?->update(['status' => $status]);
        $user->shop?->update(['status' => $status]);

        return back()->with('success', $message);
    }
}