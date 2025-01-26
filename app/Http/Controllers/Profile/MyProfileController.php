<?php

namespace App\Http\Controllers\Profile;

use App\Entity\Actions\ProfileAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProfileRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image as Image;

class MyProfileController extends BaseController
{
    public function __construct(private ProfileAction $profileAction)
    {
        parent::__construct();
        $this->profileAction = $profileAction;
    }

    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->route('/')->with('alert', 'У вас нет прав для просмотра');
        }

        $sum =  ($user->image ? 10 : 0) +
            ($user->phone ? 10 : 0) +
            ($user->whatsapp ? 5 : 0) +
            ($user->telegram ? 5 : 0) +
            ($user->instagram ? 5 : 0) +
            ($user->vkontakte ? 5 : 0);

        $fullness = (round(($sum / 45) * 100));

        return view('pages.user.user', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'user' => $user,
            'fullness' => $fullness,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $this->profileAction->update($request, Auth::user());

        return Redirect::route('profile.edit')->with('status', 'Профиль обновлён');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $this->profileAction->destroy($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
