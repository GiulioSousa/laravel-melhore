<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait AvatarTrait
{
    public function newAvatar(Request $request): string
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $avatarPath = $file->storeAs(
                'img/profile-avatar',
                $request['login'] . '.' . $extension
            );
        } else {
            $profileBlank = 'img/profile-avatar/profile-blank.png';
            $avatarPath = 'img/profile-avatar/' . $request['login'] . '.png';
            Storage::copy($profileBlank, $avatarPath);
        }

        return $avatarPath;
    }

    public function updateAvatar(Request $request): string
    {
        $user = Auth::user();
        $login = $user->login;
        $currentAvatarPath = $user->avatar;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();

            Storage::delete($currentAvatarPath);

            $login == $request['login'] ?
                $currentAvatarPath :
                $currentAvatarPath = 'img/profile-avatar/' . $request['login'] . '.' . $extension;

            $avatarPath = $file->storeAs(
                'img/profile-avatar',
                $request['login'] . '.' . $extension
            ); 

            return $avatarPath;

        } elseif ($login != $request['login']) {
            $splitPath = explode('.', $currentAvatarPath);
            $extension = end($splitPath);
            $newAvatarPath = 'img/profile-avatar/' . $request['login'] . '.' . $extension;
            Storage::move($currentAvatarPath, $newAvatarPath);

            return $newAvatarPath;
        }

        return $currentAvatarPath;
    }

    public function deleteAvatar(User $user)
    {
        Storage::delete($user->avatar);
    }
}