<h1>settings_login_id</h1>
<h1>メールアドレスの更新</h1>
    <div>
        <x-input-label for="email" :value="__('メール')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"/>
        {{-- :value="old('email', $user->email)" required autocomplete="email" /> --}}
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>
            <a href="#" class="btn mail_change">変更する</a>
            <a href="/settings" class="btn return_settings">キャンセル</a>
