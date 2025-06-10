<!DOCTYPE html>
<html>
    <?php require_once 'view/template/headercss.php'; ?>
    <body>
        <div class="body">
            <header>
                <?php require_once 'view/template/header.php'; ?>
            </header>
            <div role="main" class="main">
                <hr class="tall">
                <div class="container">
                    <?php
                    if (isset($errmsg)) {
                        echo "<div class='alert alert-danger'>{$errmsg}</div>";
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <form action="<?php echo BASE_URL . "index.php?action=account"; ?>" method="POST" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ảnh đại diện:</label>
                                        <input type="file" name="file">
                                    </div>
                                    <?php $avatar = ($u['avatar']) ? AVATAR_DIR . $u['avatar'] : AVATAR_DIR . "default.jpg"; ?>
                                    <img src="<?php echo BASE_URL . $avatar; ?>" class='img-thumbnail img-thumbnail-medium img-responsive'>
                                </div>
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
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!--foter-->
            <?php require_once 'view/template/footer.php'; ?>
        </div>
        <?php require_once 'view/template/footerjs.php'; ?>
    </body>
</html>
