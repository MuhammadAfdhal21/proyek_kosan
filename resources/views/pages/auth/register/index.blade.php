<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
            <h3 class="text-center mb-4">Register</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Pilih Role</option>
                        <option value="penyewa" {{ old('role') == 'penyewa' ? 'selected' : '' }}>Penyewa Kos</option>
                        <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik Kos</option>
                    </select>
                </div>

                <!-- Field khusus untuk pemilik -->
                <div id="pemilik-fields" style="display: none;">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Full Name</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                    </div>

                    <div class="mb-3">
                        <label for="kontak" class="form-label">Phone</label>
                        <input type="text" name="kontak" class="form-control" value="{{ old('kontak') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roleSelect = document.getElementById("role");
            const pemilikFields = document.getElementById("pemilik-fields");

            function toggleFields() {
                if (roleSelect.value === "pemilik") {
                    pemilikFields.style.display = "block";
                } else {
                    pemilikFields.style.display = "none";
                }
            }

            roleSelect.addEventListener("change", toggleFields);

            // Jalankan saat halaman dimuat (untuk old value)
            toggleFields();
        });
    </script>
</body>

</html>
