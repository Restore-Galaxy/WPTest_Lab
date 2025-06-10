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
                    <div class="col-md-5 col-md-offset-4">
                        <div class="featured-box featured-box-secundary default">
                            <div class="box-content">
                                <h4>Đăng nhập</h4>
                                <form action="index.php?action=login" id="" method="POST">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="pull-left">Tài khoản</label>
                                                <input type="text" value="" class="form-control" name="username">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label class="pull-left">Mật khẩu</label>
                                                <input type="password" value="" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span class="remember-box checkbox">
                                                <label for="rememberme">
                                                    <?php $checked = (isRemember()) ? "checked" : ""; ?>
                                                    <input type="checkbox" name="rememberme" <?php echo $checked ?>>Remember Me
                                                </label>
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" name="login" value="Đăng nhập" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($msg)) {
                                    if ($msg['status'])
                                        $alertClass = "alert-success";
                                    else
                                        $alertClass = "alert-danger";
                                    echo "<div class='alert {$alertClass}'>{$msg['txt']}</div>";
                                }
                                ?>
                            </div>
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
