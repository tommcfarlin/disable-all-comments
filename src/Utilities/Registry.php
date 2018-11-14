<?php

/*
 * This file is part of Disable All Comments.
 * (c) Pressware, LLC <support@pressware.co>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace BloggingPlugins\Utilities;

use BloggingPlugins\Subscriber\AbstractSubscriber;
use Exception;

/**
 * This class services as a simple container that can be used to pass objects
 * around the plugin.
 *
 * To use this class you'd make a call to the registry by saying Registry->get(),
 * then making a class to `register()` and `retrieve()` on an instance of the object.
 */
class Registry
{
    /**
     * @var array an array used to maintain the objects registered with the plugin
     */
    private $registry;

    /**
     * Initializes the class by setting up the registry.
     */
    public function __construct()
    {
        $this->registry = [];
    }

    /**
     * Registers an object with the registry with the specified ID; however, will throw an
     * exception if the ID is already referencing an object.
     *
     * @param string $id  an ID by which the specified object will be referenced
     * @param mixed  $obj an instance of an object to store in the registry
     *
     * @throws Exception if an object already exists for the specified key
     */
    public function add(string $id, $obj)
    {
        if (isset($this->registry[$id])) {
            throw new Exception('An object already exists for this given key.');
        }
        $this->registry[$id] = $obj;
    }

    /**
     * @param string $id the ID for the object that we wish to retrieve
     *
     * @throws Exception if no object exists for the specified key
     *
     * @return mixed a reference to the object or null
     */
    public function get($id)
    {
        if (!isset($this->registry[$id])) {
            throw new Exception('No object exists for the specified key.');
        }

        return $this->registry[$id] ?? null;
    }

    /**
     * @return array all of the the Subscribers that should be registered with WordPress
     */
    public function getRegisteredSubscribers()
    {
        $subscribers = [];
        foreach ($this->registry as $object) {
            if ($object instanceof AbstractSubscriber) {
                $subscribers[] = $object;
            }
        }

        return array_filter($subscribers);
    }
}
