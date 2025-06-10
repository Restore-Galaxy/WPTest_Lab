<div class="navbar-collapse nav-main-collapse collapse">
    <div class="container">
        <nav class="nav-main mega-menu">
            <ul class="nav nav-pills nav-main" id="mainMenu">
                <li>
                    <a href="index.php">Trang chủ</a>
                </li>

                <li>
                    <a href="index.php?action=help">Trợ giúp</a>
                </li>
                <li>
                    <a href="index.php?action=about">About us</a>
                </li>
                <li class="dropdown" id="headerAccount">
                    <a class="dropdown-toggle" href="#">
                        Danh mục
                        <i class="icon icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?admin=users">Người dùng</a></li>
                        <li><a href="index.php?admin=books">Sách</a></li>
                        <li><a href="index.php?admin=phpinfo">Thông tin hệ thống</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="headerAccount">
                    <a class="dropdown-toggle" href="#">
                        <i class="icon icon-user"></i> <?php echo getUsername(); ?>
                        <i class="icon icon-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?action=account">Tài khoản</a></li>
                        <li><a href="index.php?action=logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>