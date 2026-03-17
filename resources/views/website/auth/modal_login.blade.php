<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- @if (session('status'))
                <div class="alert alert-success col-md-6 mt-3" style="max-width: 400px;">
                    {{ session('status') }}
                </div>
            @endif -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailLogin" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailLogin" name="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="passwordLogin" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordLogin" name="password" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <small>Belum punya akun? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal"
                                data-bs-target="#registerModal">Daftar</a></small><br>
                        <small class="">Lupa kata sandi? <a href="#" id="btn-forgot" data-bs-dismiss="modal" data-bs-toggle="modal"
                                data-bs-target="#lupaPasswordModal">Klik di sini</a></small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ri-login-box-line"></i>
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>