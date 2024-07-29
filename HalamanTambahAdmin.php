  <!-- Form Input -->
  <div class="content-page" id="halaman-tambah-admin" style="display: none;">
      <h2>Form Input Admin Baru</h2>
      <form>
          <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Masukkan username">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Masukkan password">
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
      </form>

      <!-- Tabel -->
      <div class="mt-5">
          <h2>Daftar Pengguna</h2>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Username</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>1</td>
                      <td>user1</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>user2</td>
                  </tr>
                  <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
              </tbody>
          </table>
      </div>
  </div>