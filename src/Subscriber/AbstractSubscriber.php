<?php

/*
 * This file is part of Disable All Comments.
 * (c) Pressware, LLC <support@pressware.co>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BloggingPlugins\Subscriber;

use BloggingPlugins\Utilities\Registry;

/**
 * An abstract implementation of a subscriber that requires a hook and the ability to
 * start the class.
 */
abstract class AbstractSubscriber
{
    /**
     * @var string a reference to the hook to which the subscriber should be registered
     */
    protected $hook;

    /**
     * @var Registry a reference to the simple container used to maintain plugin objects
     */
    protected $registry;

    /**
     * @var string a reference to the directory from where to pull the JavaScript sources
     */
    protected $jsDir;

    /**
     * @param string $hook the hook to which the subscriber is registered
     */
    public function __construct(string $hook)
    {
        $this->hook = $hook;
        $this->registry = apply_filters('bpRegistry', null);
    }

    /**
     * @return string the hook to which the subscriber is registered
     */
    public function getHook(): string
    {
        return $this->hook;
    }

    abstract public function load();
}
