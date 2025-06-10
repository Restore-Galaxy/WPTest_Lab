<div>
    <div class="col-md-12">
        <div class="row">
            <form method="post" action="<?php echo BASE_URL . "index.php?admin=users&edit"; ?>" enctype="multipart/form-data">
                <div class="col-md-6">

                    <div class="row">
                        <div class="form-group">
                            <label>Tài khoản:</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $u['username'] ?>" readonly="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Mật khẩu:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $u['email'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Họ tên:</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $u['fullname'] ?>">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group">
                            <?php
                            if ($u['isadmin']) {
                                $checkedUser = "";
                                $checkedAdmin = "checked";
                            } else {
                                $checkedUser = "checked";
                                $checkedAdmin = "";
                            }
                            ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="isadmin"  value="0" <?php echo $checkedUser; ?>>
                                    Người dùng
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="isadmin"  value="1" <?php echo $checkedAdmin; ?>>
                                    Quản trị
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" data-loading-text="Loading..." class="btn btn-primary" value="Lưu" name="submit">
                    </div>
                    <div class="row">
                        <p>
                            <?php
                            if (isset($msg)) {
                                if ($msg['status'])
                                    $alertClass = "alert-success";
                                else
                                    $alertClass = "alert-danger";
                                echo "<div class='alert {$alertClass}'>{$msg['txt']}</div>";
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ảnh đại diện:</label>
                        <input type="file" name="file">
                    </div>
                    <?php
                    $avatar = ($u['avatar']) ? AVATAR_DIR . $u['avatar'] : AVATAR_DIR . "default.jpg";
                    echo "<img src='" . BASE_URL . "{$avatar}' class='img-thumbnail img-thumbnail-medium img-responsive'>";
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

