<h1>settings_password</h1>

<div>
    <x-input-label for="current_password" :value="__('現在のパスワード')" />
    <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
</div>

<div>
    <x-input-label for="password" :value="__('新しいパスワード')" />
    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
</div>

<div>
    <x-input-label for="password_confirmation" :value="__('パスワード(確認)')" />
    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
</div>

<a href="#" class="btn password_change">変更する</a>
<a href="/settings" class="btn return_settings">キャンセル</a>
