<div class="col-md-6">
    <form method="post" action="<?php echo BASE_URL . "index.php?admin=users&add"; ?>">
        <div class="row">
            <div class="form-group">
                <label>Tài khoản:</label>
                <input type="text" name="username" class="form-control">
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
                <label>Nhập lại mật khẩu:</label>
                <input type="password" name="repassword" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input type="radio" name="isadmin"  value="0" checked>
                        Người dùng
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="isadmin"  value="1">
                        Quản trị
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="submit" data-loading-text="Loading..." class="btn btn-primary" value="Submit" name="submit">
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
    </form>

</div>
