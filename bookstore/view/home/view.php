<div class="row">
    <div class="col-md-4">
        <?php $bookImage = ($bookDetail['image']) ? BOOK_DIR . $bookDetail['image'] : BOOK_DIR . "default.jpg"; ?>
        <img src="<?php echo BASE_URL . "{$bookImage}"; ?>" class="img-thumbnail img-thumbnail-book-lage img-responsive">
    </div>
    <div class="col-md-8">
        <h3><?php echo $bookDetail['title']; ?></h3>
        <h4><?php echo $bookDetail['price']; ?> VNĐ</h4>
        <p><?php echo $bookDetail['description']; ?></p>
    </div>
</div>

<!--comment-->
<div class="row">
    <div class="col-md-12">
        <div class="tabs tabs-product">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#productReviews" data-toggle="tab">Nhận xét</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <!--list comment-->
                    <ul class="comments" id="lstComment"> 
                    </ul>

                    <hr class="tall">
                    <h4>Thêm nhận xét</h4>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea maxlength="5000" rows=5" class="form-control" id="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="Submit" class="btn btn-primary" id="submitView" data-loading-text="Loading...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>assets/vendor/jquery.js"></script>
<script>
    getListComment();
    $("#submitView").click(function() {
        var cmt = $("#comment").val();
        $.ajax({
            type: "POST",
            data: {cmt: cmt},
            url: "<?php echo BASE_URL . "index.php?comment={$bookDetail['bookid']}&add"; ?>",
            success: function(response) {
                var res = $.parseJSON(response);
                if (res['status'] == false)
                    alert(res['msg'])
                else {
                    $("#comment").val('');
                    getListComment();
                }
            }
        });
    });
    function getListComment() {
        $.ajax({
            type: "GET",
            url: "<?php echo BASE_URL . "index.php?comment={$bookDetail['bookid']}" ?>",
            success: function(response) {
                $("#lstComment").html(response);
            }
        });
    }
    
</script>
