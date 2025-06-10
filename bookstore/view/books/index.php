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
                    <h4>Quản lý sách</h4>
                    <?php
                    if ($action == 'add') {
                        require_once 'view/books/add.php';
                    } elseif ($action == "edit") {
                        require_once 'view/books/edit.php';
                    } else {
                        require_once 'view/books/list.php';
                    }
                    ?>
                </div>
            </div>
            <!--foter-->
            <?php require_once 'view/template/footer.php'; ?>
        </div>
        <?php require_once 'view/template/footerjs.php'; ?>
        <script>
            $(".delBook").click(function() {
                var row = $(this);
                var bookId = row.attr('bookId');
                if (confirm("Bạn có muốn xóa không!")) {
                    $.ajax({
                        type: "POST",
                        data: {bookId: bookId},
                        url: "<?php echo BASE_URL . "index.php?admin=books&del" ?>",
                        success: function(response) {
                            var res = $.parseJSON(response);
                            if (res['status'] == false)
                                alert(res['msg'])
                            else {
                                row.closest("tr").remove();
                            }
                        }
                    });
                }
                return false;

            });
        </script>
    </body>
</html>
