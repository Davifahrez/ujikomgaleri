<div class="container py-4">
    <!-- Header: Judul Galeri dan Tombol Tambah Foto -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Photo Gallery</h1>
        <!-- Tombol untuk membuka modal tambah foto -->
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">
            <i class="bi bi-plus-lg me-2"></i>Add Photo
        </button>
    </div>

    <!-- Grid untuk Menampilkan Foto-foto -->
    <div class="row g-2">
        <?php
        // Menghubungkan ke database
        require 'config/conn.php';

        // Query untuk mengambil data foto beserta nama user dan nama album
        $query = "SELECT photos.*, users.user_name, albums.album_name 
                  FROM photos 
                  JOIN users ON photos.users_id = users.id 
                  JOIN albums ON photos.albums_id = albums.id";
        $result = $conn->query($query);

        // Looping setiap data foto yang diambil dari database
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <!-- Card Foto -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="position-relative">
                    <!-- Gambar foto yang ketika diklik akan membuka modal view -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $row['id']; ?>" class="d-block">
                        <div class="ratio ratio-1x1">
                            <img src="galeri/<?php echo $row['photo_file']; ?>" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="<?php echo htmlspecialchars($row['photo_title']); ?>">
                        </div>
                    </a>
                </div>
            </div>

            <!-- Modal View Foto -->
            <div class="modal fade" id="viewModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Header Modal -->
                        <div class="modal-header">
                            <h5 class="modal-title">View Photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- Body Modal -->
                        <div class="modal-body p-0">
                            <table class="table m-0">
                                <tr>
                                    <!-- Kolom Foto (60% lebar) -->
                                    <td class="w-60 p-0 border-0 align-top">
                                        <img class="img-fluid object-fit-cover" src="galeri/<?php echo $row['photo_file']; ?>" alt="Photo">
                                    </td>
                                    <!-- Kolom Informasi Foto (40% lebar) -->
                                    <td class="w-40 p-3 border-0">
                                        <!-- Informasi User -->
                                        <div class="d-flex align-items-center mb-3">
                                            <!-- Contoh avatar (bisa diganti dengan foto user) -->
                                            <div class="rounded-circle bg-secondary" style="width: 32px; height: 32px;"></div>
                                            <div class="ms-2">
                                                <strong><?php echo htmlspecialchars($row['user_name']); ?></strong>
                                            </div>
                                        </div>

                                        <!-- Detail Foto -->
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="p-1"><strong>Title</strong></td>
                                                <td class="p-1"><?php echo htmlspecialchars($row['photo_title']); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-1"><strong>Description</strong></td>
                                                <td class="p-1"><?php echo htmlspecialchars($row['photo_desc']); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="p-1"><strong>Album</strong></td>
                                                <td class="p-1"><?php echo $row['album_name']; ?></td>
                                            </tr>
                                        </table>

                                        <!-- Komentar pada Foto -->
                                        <div id="comment-container" class="comment-container text-break mb-3">
                                            <?php
                                            // Query untuk mengambil komentar berdasarkan foto
                                            $getcomment = "SELECT comments.comment, users.user_name, comments.reply
                                                           FROM comments 
                                                           JOIN users ON comments.users_id = users.id
                                                           WHERE comments.photos_id = {$row['id']}";
                                            $commentresult = $conn->query($getcomment);
                                            
                                            if ($commentresult) {
                                                while ($commentrow = mysqli_fetch_assoc($commentresult)) {
                                                    echo "<strong>" . htmlspecialchars($commentrow['user_name']) . "</strong>: " 
                                                         . htmlspecialchars($commentrow['comment']);
                                                    if (!empty($commentrow['reply'])) {
                                                        echo "<div class='reply'>Reply: " . htmlspecialchars($commentrow['reply']) . "</div>";
                                                    }
                                                    echo "<br>";
                                                }
                                            } else {
                                                echo "No comments.";
                                            }
                                            ?>
                                        </div>

                                        <!-- Form Tambah Komentar -->
                                        <form method="POST" action="app/galeri/comment/commentprocess.php">
                                            <!-- Menyisipkan id foto secara tersembunyi -->
                                            <input type="hidden" name="photos_id" value="<?php echo $row['id']; ?>">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="comment" placeholder="Write a comment..." required>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- Footer Modal (bisa ditambahkan tombol edit atau delete jika diperlukan) -->
                    </div>
                </div>
            </div>
        <?php } // Akhir dari looping foto ?>
    </div>

    <!-- Modal Tambah Foto -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Form untuk tambah foto -->
                <form method="POST" action="app/galeri/photos/tambah.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Photo</h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input File Foto -->
                        <div class="mb-3">
                            <label for="photoFile" class="form-label">Photo File</label>
                            <input type="file" class="form-control" id="photoFile" name="photo_file" required>
                        </div>
                        <!-- Input Judul Foto -->
                        <div class="mb-3">
                            <label for="photoTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="photoTitle" name="photo_title" required>
                        </div>
                        <!-- Input Deskripsi Foto -->
                        <div class="mb-3">
                            <label for="photoDesc" class="form-label">Description</label>
                            <textarea class="form-control" id="photoDesc" name="photo_desc" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script: Otomatis membuka modal view jika terdapat parameter "photos_id" pada URL -->
<?php if(isset($_GET['photos_id'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var photoModal = new bootstrap.Modal(document.getElementById('viewModal<?php echo $_GET['photos_id']; ?>'));
        photoModal.show();
    });
</script>
<?php endif; ?>
