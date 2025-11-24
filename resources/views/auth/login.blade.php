<form action="/login" method="POST">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>

@if($errors->any())
    <div style="color: red;">
        {{ $errors->first() }}
    </div>
@endif
