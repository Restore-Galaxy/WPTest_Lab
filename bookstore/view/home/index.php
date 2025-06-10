<!DOCTYPE html>
<html>
    <?php require_once 'view/template/headercss.php'; ?>
    <body>
        <div class="body">
            <header>
                <?php require_once 'view/template/header.php'; ?>
            </header>
            <div role="main" class="main shop">
                <hr class="tall">
                <div class="container">
                    <?php
                    if ($action == "list")
                        require_once 'view/home/list.php';
                    elseif ($action == "view")
                        require_once 'view/home/view.php';
                    ?>
                </div>
            </div>
            <!--foter-->
            <?php require_once 'view/template/footer.php'; ?>
        </div>
        <?php require_once 'view/template/footerjs.php'; ?>
    </body>
</html>
