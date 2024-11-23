<div class="login-container">
    <div class="login-header">
        <img src="{{asset('assets/perpustakaan1.jpeg')}}" alt="Library Logo" class="img-responsive">
        <h2>Library Management</h2>
    </div>
    <form>
        <div class="form-group">
            <input type="name" wire:model="email" class="form-control" id="email" placeholder="Email Address">
            @error('email')
            <div class="alert alert-secondary" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Password">
            @error('password')
            <div class="alert alert-secondary" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>
        <button type="button" wire:click="proses" class="btn btn-primary btn-login">Login</button>
    </form>
    <div class="text-center">
        <a href="#">Forgot password?</a>
    </div>
</div>