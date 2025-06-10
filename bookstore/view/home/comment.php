<?php
if (count($output) == 0)
    echo "<p>Không có nhận xét nào!</p>";
?>
<?php foreach ($output as $value) { ?>
    <li>
        <div class="comment">
            <div class="img-thumbnail">
                <img class="avatar img-thumbnail-small" alt="" src="<?php echo $value['avatar']; ?>">
            </div>
            <div class="comment-block">
                <div class="comment-arrow"></div>
                <span class="comment-by">
                    <strong><?php echo $value['username']; ?></strong>
                    <?php if ($value['isDel']) { ?>
                        <span class="pull-right">
                            <a href='javascript:void(0)' class='delComment icon icon-trash-o' id='<?php echo $value['commentID']; ?>'></a>
                        </span>
                    <?php } ?>
                </span>
                <p><?php echo $value['comment']; ?></p>
            </div>
        </div>
    </li>
<?php } 
?>
<script>
    $('.delComment').click(function() {
        var row = $(this);
        var commentId = row.attr('id');
        if (confirm("Bạn có muốn xóa không!")) {
            $.ajax({
                type: "POST",
                data: {commentId: commentId},
                url: "<?php echo BASE_URL . "index.php?comment={$bookId}&del" ?>",
                success: function(response) {
                    var res = $.parseJSON(response);
                    if (res['status'] == false)
                        alert(res['msg'])
                    else {
                        row.closest("li").remove();
                    }
                }
            });
        }
        return false;
    });
</script>

