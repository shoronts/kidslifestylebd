<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-5">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title mb-4">
            <?php
            $comment_count = get_comments_number();
            if ($comment_count === 1) {
                echo '1 Comment';
            } else {
                echo $comment_count . ' Comments';
            }
            ?>
        </h3>

        <ul class="comment-list list-unstyled">
            <?php
            wp_list_comments([
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size'=> 50,
                'callback'   => 'healthy_eats_comment_template',
            ]);
            ?>
        </ul>

        <?php
        the_comments_navigation([
            'prev_text' => '&larr; Older Comments',
            'next_text' => 'Newer Comments &rarr;',
        ]);
        ?>

    <?php endif; ?>

    <?php
    if (!comments_open()) :
        echo '<p class="no-comments">Comments are closed.</p>';
    endif;
    ?>

    <div class="comment-form-wrap mt-5">
        <?php
        comment_form([
            'class_form'         => 'comment-form',
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h3>',
            'label_submit'       => 'Submit Comment',
            'class_submit'         => 'btn comments-btn my-3',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'fields'             => [
                'author' =>
                    '<div class="form-group mb-3">
                        <label for="author">Name *</label>
                        <input id="author" name="author" type="text" class="form-control" required />
                    </div>',
                'email' =>
                    '<div class="form-group mb-3">
                        <label for="email">Email *</label>
                        <input id="email" name="email" type="email" class="form-control" required />
                    </div>',
            ],
            'comment_field' =>
                '<div class="form-group mb-3">
                    <label for="comment">Comment *</label>
                    <textarea id="comment" name="comment" class="form-control" rows="5" required></textarea>
                </div>',
        ]);
        ?>
    </div>
</div>

<?php
// Custom callback to style individual comments
function healthy_eats_comment_template($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class('mb-4 d-flex'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="me-3">
            <?php echo get_avatar($comment, 50); ?>
        </div>
        <div class="comment-body w-100">
            <div class="d-flex justify-content-between">
                <h5 class="comment-author m-0"><?php comment_author(); ?></h5>
                <span class="comment-date small text-muted">
                    <?php comment_date(); ?> at <?php comment_time(); ?>
                </span>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <p class="text-muted"><em>Your comment is awaiting moderation.</em></p>
            <?php endif; ?>
            <div class="comment-text mt-2">
                <?php comment_text(); ?>
            </div>
            <div class="reply mt-2">
                <?php
                comment_reply_link(array_merge($args, [
                    'reply_text' => 'Reply',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                ]));
                ?>
            </div>
        </div>
    </li>
<?php }
?>
