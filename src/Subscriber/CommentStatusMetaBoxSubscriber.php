<?php

/*
 * This file is part of the YMconnect WordPress Plugin
 *
 * (c) Pressware, LLC <support@pressware.co>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BloggingPlugins\Subscriber;

use BloggingPlugins\WordPress\Admin\MetaBox\CommentStatusMetaBox;

class CommentStatusMetaBoxSubscriber extends AbstractSubscriber
{
    /**
     * @param string $hook the hook to which this class is registered with WordPress
     */
    public function __construct(string $hook)
    {
        parent::__construct($hook);
    }

    /**
     * Initializes all of the meta boxes that we need to render for each Product.
     */
    public function load()
    {
        (new CommentStatusMetaBox())->render();
    }
}
