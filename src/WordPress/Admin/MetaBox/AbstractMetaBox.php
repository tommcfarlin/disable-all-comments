<?php

/*
 * This file is part of Disable All Comments.
 * (c) Pressware, LLC <support@pressware.co>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BloggingPlugins\WordPress\Admin\MetaBox;

/**
 * Defines the functionality necessary to build and render a custom meta box
 * on the posts screen.
 */
abstract class AbstractMetaBox
{
    /**
     * @var string the post type to which this meta box is associated
     */
    protected $postType;

    /**
     * Initializes the instance data.
     */
    public function __construct()
    {
        $this->postType = 'post';
    }

    /**
     * Registers the meta box with WordPress.
     */
    abstract public function render();

    /**
     * Renders the view for this particular metabox.
     */
    abstract public function display();
}
