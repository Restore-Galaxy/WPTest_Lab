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
                    <h4>Quản lý người dùng</h4>
                    <?php
                    if ($action == 'add') {
                        require_once 'view/users/add.php';
                    } elseif ($action == "edit") {
                        require_once 'view/users/edit.php';
                    } else {
                        require_once 'view/users/list.php';
                    }
                    ?>
                </div>
            </div>
            <!--foter-->
            <?php require_once 'view/template/footer.php'; ?>
        </div>
        <?php require_once 'view/template/footerjs.php'; ?>
        <script>
            $(".delUser").click(function() {
                var row = $(this);
                var username = row.attr('username');
                if (confirm("Bạn có muốn xóa không!")) {
                    $.ajax({
                        type: "POST",
                        data: {username: username},
                        url: "<?php echo BASE_URL . "index.php?admin=users&del" ?>",
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
