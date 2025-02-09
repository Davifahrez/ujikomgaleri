<div class="container">
    <h1>Albums</h1>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
    </div>
    <table class="table mt-3">
        <tr>
            <th>Album Name</th>
            <th>Options</th>
        </tr>

        <?php
            require 'config/conn.php';
            $users = $_SESSION['user_id'];
            $query = "SELECT * FROM albums
                      JOIN users ON albums.users_id = users.id
                      WHERE albums.users_id = $users";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
        ?>
                    <tr>
                        <td><?php echo $row['album_name']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit Data</button>                            
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalView">View Data</button>
                        </td>
                    </tr>
                    
                <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="modalViewLabel">View Data</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="Album" class="form-label">Album Name</label>
                                    <p class="form-control-plaintext"><?php echo $row['album_name']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="Album" class="form-label">Album Description</label>
                                    <p class="form-control-plaintext"><?php echo $row['album_desc']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label for="Album" class="form-label">User</label>
                                    <p class="form-control-plaintext"><?php echo $row['user_name']; ?></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada albums yang ditemukan</td></tr>";
            }
        ?>
    </table>
    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">            
                <form method="POST" action="app/galeri/albums/tambah.php">
                    <div class="modal-header">
                        <div class="modal-title">Tambah Album</div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label"  for="album_name">Album name</label>
                                <input class="form-control" type="text" name="album_name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="album_desc">Album desc</label>
                                <textarea class="form-control" name="album_desc" id="albumDesc"></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary">Close</button>
                                <button class="btn btn-primary">Tambah</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
