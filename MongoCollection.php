<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @copyright Copyright Webiny LTD
 */

namespace Webiny\Component\Mongo;

/**
 * MongoCollection wraps native \MongoCollection
 *
 * @package Webiny\Component\Mongo
 */
class MongoCollection
{
    /**
     * @var \MongoCollection
     */
    private $_collection;

    /**
     * Base constructor.
     *
     * @param \MongoCollection $collection
     */
    public function __construct(\MongoCollection $collection)
    {
        $this->_collection = $collection;
    }

    public function __call($name, $arguments)
    {
        return call_user_func([
                                  $this->_collection,
                                  $name
                              ], $arguments
        );
    }

    public function __get($name)
    {
        return $this->_collection->$name;
    }

    public function __set($name, $value)
    {
        $this->_collection->$name = $value;
    }


}