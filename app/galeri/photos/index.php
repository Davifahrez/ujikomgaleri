<div class="container">
    <h1>Photos</h1>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Photos</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Album</th>
                <th scope="col">User</th>
                <th scope="col">Created At</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'config/conn.php';
            $query = "SELECT photos.*, users.user_name, albums.album_name 
                      FROM photos 
                      JOIN users ON photos.users_id = users.id 
                      JOIN albums ON photos.albums_id = albums.id";
            $result = $conn->query($query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['photo_file']; ?></td>
                    <td><?php echo $row['photo_title']; ?></td>
                    <td><?php echo $row['photo_desc']; ?></td>
                    <td><?php echo $row['album_name']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="edit_photo.php">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="photoFile<?php echo $row['id']; ?>" class="form-label">Photo File</label>
                                        <input type="text" class="form-control" id="photoFile<?php echo $row['id']; ?>" name="photoFile" value="<?php echo htmlspecialchars($row['photo_file']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photoTitle<?php echo $row['id']; ?>" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="photoTitle<?php echo $row['id']; ?>" name="photoTitle" value="<?php echo htmlspecialchars($row['photo_title']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photoDesc<?php echo $row['id']; ?>" class="form-label">Description</label>
                                        <textarea class="form-control" id="photoDesc<?php echo $row['id']; ?>" name="photoDesc" required><?php echo htmlspecialchars($row['photo_desc']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="albumId<?php echo $row['id']; ?>" class="form-label">Album</label>
                                        <select name="albumId" class="form-select">
                                            <option value="<?php echo $row['albums_id']; ?>"><?php echo $row['album_name']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete "<?php echo $row['photo_title']; ?>"?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirm Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="app/galeri/read/tambah.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="photoFile" class="form-label">Photo File</label>
                            <input type="text" class="form-control" id="photoFile" name="photoFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="photoTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="photoTitle" name="photoTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="photoDesc" class="form-label">Description</label>
                            <textarea class="form-control" id="photoDesc" name="photoDesc" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="albumId" class="form-label">Album</label>
                            <select class="form-select" id="albumId" name="albumId" required>
                            </select>
                            <a href="?page=albums" class="btn btn-primary mt-3">Add Album</a>
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
