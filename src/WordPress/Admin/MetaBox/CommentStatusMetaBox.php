<?php

/*
 * This file is part of Disable All Comments.
 *
 * (c) Pressware, LLC <support@pressware.co>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BloggingPlugins\WordPress\Admin\MetaBox;

class CommentStatusMetaBox extends AbstractMetaBox
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        add_meta_box(
            'blogging-plugins-comment-status',
            'Comment Status',
            [$this, 'display'],
            $this->postType,
            'side',
            'default'
        );
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function display()
    {
        include plugin_dir_path(__FILE__).'Views/comment-status.php';
    }
}
