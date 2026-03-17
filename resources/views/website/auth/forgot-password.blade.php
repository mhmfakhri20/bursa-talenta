<div class="modal fade" id="lupaPasswordModal" tabindex="-1" aria-labelledby="lupaPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- @if (session('status'))
                <div class="alert alert-success col-md-6 mt-3" style="max-width: 400px;">
                    {{ session('status') }}
                </div>
            @endif -->
            <form method="POST" action="{{ url('/forgot-password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="lupaPasswordModalLabel">Lupa Password Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailLupa" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailLupa" name="email" required autofocus>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ri-login-box-line"></i>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
