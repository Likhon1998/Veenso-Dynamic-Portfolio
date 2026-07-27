@if (session('success'))
    <div class="flash flash-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="flash flash-error">{{ session('error') }}</div>
@endif
@if (isset($errors) && $errors->any())
    <div class="flash flash-error">
        <ul class="flash-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
