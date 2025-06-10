<p><a class="btn btn-primary" href="<?php echo BASE_URL . "index.php?admin=books&add" ?>">Thêm</a></p>
<table class="table table-bordered">
    <thead>
    <th>Tên sách</th>
    <th>Mô tả</th>
    <th width="10%" class="text-center">Giá (VNĐ)</th>
    <th width="10%" class="text-center">Ảnh</th>
    <th width="5%" class='text-center'>Sửa/Xóa</th>
</thead>
<tbody>
    <?php
    foreach ($listBooks as $b) {
        echo "<tr>";
        echo "<td>{$b['title']}</td>";
        $description = getSubstring($b['description'],200);
        echo "<td>{$description}</td>";
        echo "<td class='text-center'>{$b['price']}</td>";
        $bookImage = ($b['image']) ? BOOK_DIR . $b['image'] : BOOK_DIR . "default.jpg";
        echo "<td class='text-center'><img src='" . BASE_URL . "{$bookImage}' class='img-thumbnail img-thumbnail-book-small img-responsive'></td>";
        echo "<td class='text-center'><a href='" . BASE_URL . "index.php?admin=books&edit=" . $b['bookid'] . "' class='icon icon-edit'></a>&nbsp;&nbsp
            <a href='javascript:void(0)' class='delBook icon icon-trash-o' bookId='{$b['bookid']}'></a>
            </td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
    