<!--Search-->
<div class="row">
    <div class="col-md-6">
        <h4><?php echo $keyword ?></h4>
    </div>
    <div class="col-md-6">
        <form method="POST">
            <div class="input-group">
                <input class="form-control" placeholder="Search Products..." name="search" type="text">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon icon-search"></i></button>
                </span>
            </div>
        </form>
    </div>
</div>

<br/>
<!--list books-->
<div class="row">
    <ul class="products product-thumb-info-list">
        <?php
        foreach ($listBooks as $value) {
            $bookImage = ($value['image']) ? BOOK_DIR . $value['image'] : BOOK_DIR . "default.jpg";
            ?>
            <li class="col-md-3 product">   
                <span class="product-thumb-info">
                    <a href="<?php echo BASE_URL . "index.php?book={$value['bookid']}"; ?>">
                        <span class="product-thumb-info-image">
                            <span class="product-thumb-info-act">
                                <span class="product-thumb-info-act-right"><em></i>Xem Chi tiết</em></span>
                            </span>
                            <img alt="" class="img-responsive book-list-thumb" src="<?php echo BASE_URL . "{$bookImage}" ?>">
                        </span>
                    </a>
                    <span class="product-thumb-info-content">

                        <h4><?php echo $value['title']; ?></h4>
                        <span class="price">
                            <ins><span class="amount text-danger"><?php echo $value['price'] ?> VNĐ</span></ins>
                        </span>

                    </span>
                </span>
            </li>
            <?php
        }
        ?>
    </ul>
</div>