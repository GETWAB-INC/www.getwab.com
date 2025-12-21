<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        // Получаем последний посещённый раздел из сессии
        $lastSection = session('last_account_section');

        if ($lastSection) {
            // Если есть сохранённый URL — редиректим туда
            return redirect($lastSection);
        }

        // Если ничего не было посещено — по умолчанию идём в профиль
        return redirect()->route('account.profile');
    }


    public function reports(Request $request)
    {
        $user = Auth::user();
        // Сохраняем текущий URL как последний посещённый
        session(['last_account_section' => route('account.reports')]);
        return view('account.reports', compact('user'));
    }

    public function packages(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.packages')]);
        return view('account.packages', compact('user'));
    }

    public function subscription(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.subscription')]);
        return view('account.subscription', compact('user'));
    }

    public function billing(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.billing')]);
        return view('account.billing', compact('user'));
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        session(['last_account_section' => route('account.profile')]);
        return view('account.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Валидация входных данных
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'jobTitle' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'currentPassword' => 'nullable|string',
            'newPassword' => 'nullable|string|min:8|confirmed',
            'confirmPassword' => 'nullable|same:newPassword',
        ]);

        $user = auth()->user();

        // Обновление основных полей профиля
        $user->name = $validated['firstName'] ?? $user->name;
        $user->surname = $validated['lastName'] ?? $user->surname;
        $user->job = $validated['jobTitle'] ?? $user->job;
        $user->organization = $validated['organization'] ?? $user->organization;
        $user->email = $validated['email'] ?? $user->email;
        $user->phone = $validated['phone'] ?? $user->phone;

        // Проверка и смена пароля (если указаны)
        if ($validated['currentPassword'] && $validated['newPassword']) {
            if (!Hash::check($validated['currentPassword'], $user->password)) {
                return back()->withErrors(['currentPassword' => 'The current password is incorrect.']);
            }

            $user->password = Hash::make($validated['newPassword']);
        }

        // Сохранение изменений
        try {
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error saving: ' . $e->getMessage()]);
        }
    }


    public function uploadAvatar(Request $request)
    {
        // Проверка: есть ли файл
        if (!$request->hasFile('avatar')) {
            return response()->json([
                'success' => false,
                'message' => 'No file selected'
            ], 400);
        }

        $file = $request->file('avatar');

        // Валидация: только изображения
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // до 2 МБ
        ]);

        $user = Auth::user();

        // Генерируем уникальное имя файла
        $filename = Str::uuid() . '.' . $file->extension();

        // Сохраняем в storage/app/public/avatars
        $path = $file->storeAs('avatars', $filename, 'public');

        // Обновляем путь к аватару в модели пользователя
        $user->avatar = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar uploaded',
            'avatar_url' => Storage::url($path)
        ]);
    }

    public function removeAvatar(Request $request)
    {
        $user = Auth::user();

        // Проверяем, есть ли у пользователя аватар
        if (!$user->avatar) {
            return response()->json([
                'success' => false,
                'message' => 'No avatar to remove'
            ], 400);
        }

        // Получаем полный путь к файлу в хранилище
        $filePath = storage_path('app/public/' . $user->avatar);

        // Проверяем существование файла перед удалением
        if (file_exists($filePath)) {
            try {
                // Удаляем файл из хранилища
                unlink($filePath);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete file: ' . $e->getMessage()
                ], 500);
            }
        }

        // Очищаем поле avatar в базе данных
        $user->avatar = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar removed successfully'
        ]);
    }
}
