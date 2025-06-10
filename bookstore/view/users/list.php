<p><a class="btn btn-primary" href="<?php echo BASE_URL . "index.php?admin=users&add" ?>">Thêm</a></p>
<table class="table table-bordered">
    <thead>
    <th>Tài khoản</th>
    <th>Email</th>
    <th>Họ tên</th>
    <th width="10%" class="text-center">Quản trị</th>
    <th width="5%" class='text-center'>Avatar</th>
    <th width="5%" class='text-center'>Sửa/Xóa</th>
</thead>
<tbody>
    <?php
    foreach ($listUser as $u) {
        echo "<tr>";
        echo "<td>{$u['username']}</td>";
        echo "<td>{$u['email']}</td>";
        echo "<td>{$u['fullname']}</td>";
        $isadmin = ($u['isadmin']) ? "Yes" : "No";
        echo "<td class='text-center'>{$isadmin}</td>";
        $avatar = ($u['avatar']) ? AVATAR_DIR . $u['avatar'] : AVATAR_DIR . "default.jpg";
        echo "<td class='text-center'><img src='" . BASE_URL . "{$avatar}' class='img-thumbnail img-thumbnail-small img-responsive'></td>";
        echo "<td class='text-center'><a href='" . BASE_URL . "index.php?admin=users&edit=" . $u['username'] . "' class='icon icon-edit'></a>&nbsp;&nbsp
            <a href='javascript:void(0)' class='delUser icon icon-trash-o' username='{$u['username']}'></a>
            </td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
    