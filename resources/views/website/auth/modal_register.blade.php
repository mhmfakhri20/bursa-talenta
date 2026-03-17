<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Daftar Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameRegister" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nameRegister" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailRegister" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailRegister" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegister" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordRegister" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirm" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passwordConfirm" name="password_confirmation"
                            required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <small>Sudah punya akun? <a href="" data-bs-dismiss="modal" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</a></small>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ri-save-line"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
