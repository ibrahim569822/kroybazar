<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function pending()
    {
        $users = User::whereIn('role', [2, 3])
            ->where('status', 0)
            ->with(['vendor', 'shop'])
            ->get();

        return response()->json($users);
    }
    public function approve(User $user)
    {
        $this->setStatus($user, 1);   // 1 = approved
        return response()->json(['message' => 'Account approved']);
    }

    public function reject(User $user)
    {
        $this->setStatus($user, 2);   // 2 = suspended
        return response()->json(['message' => 'Account rejected']);
    }

    private function setStatus(User $user, int $status)
    {
        abort_if($user->role == 1, 403, 'Cannot change an admin account');

        $user->update(['status' => $status]);
        if ($status === 2) {
            $user->tokens()->delete();
        }

        $user->vendor?->update(['status' => $status]);   // warehouse profile, if any
        $user->shop?->update(['status' => $status]);     // shop profile, if any
    }
}
