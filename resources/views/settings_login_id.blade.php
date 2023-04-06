<form method="POST" action="{{ route('settings.login.id.update') }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">新しいログインID</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <button type="submit" class="btn_btn-primary">変更する</button>
</form>
<a href="/settings" class="btn_return_settings">キャンセル</a>
