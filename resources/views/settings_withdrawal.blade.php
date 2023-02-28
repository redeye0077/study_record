<h1>settings_withdrawal</h1>
<h1>「退会する」のボタンを押すと</h1>
<h1>退会が完了いたします。</h1>
<h1>本当に退会してもよろしいですか？</h1>

<div class="btn-group">

    <form action="{{ route('settings.withdrawal.post') }}" method="post">
    @csrf
    @method('POST')
    <button type="submit" class="py-2 px-3 bg-red-400 rounded-lg text-white">退会する</button>
    </form>

    <div class='ml-3'>
        <a href="/settings" class="btn return_settings">キャンセル</a>
    </div>
</div>
