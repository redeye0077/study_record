<form method="POST" action="{{ route('SettingsLoginId.update') }}">
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
    <button type="submit" class="btn btn-primary">更新</button>
</form>
