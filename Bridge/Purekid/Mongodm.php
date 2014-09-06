<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @copyright Copyright Webiny LTD
 */

namespace Webiny\Component\Mongo\Bridge\Purekid;

use Purekid\Mongodm\MongoDB;
use Webiny\Component\StdLib\StdLibTrait;


/**
 * Database adapter.
 *
 * @package Webiny\Component\Mongo\Bridge\Purekid
 */
class Mongodm implements MongoInterface
{
    use StdLibTrait;

    /**
     * @var MongoDB
     */
    private $_instance = null;

    /**
     * Base construct.
     * Create a connection to Mongodb database.
     *
     * @param string $host     Mongodb host.
     * @param string $database Database name.
     * @param string $user     Database username.
     * @param string $password Database password.
     * @param array  $options  Additional options.
     *
     * @internal param string $collectionPrefix Collection prefix.
     */
    public function connect($host, $database, $user = null, $password = null, array $options = [])
    {
        $config = [
            'connection' => [
                'hostnames' => $host,
                'database'  => $database,
                'options'   => $options
            ]
        ];

        if (!$this->isNull($user) && !$this->isNull($password)) {
            $config['connection']['username'] = $user;
            $config['connection']['password'] = $password;
        }

        $this->_instance = MongoDB::instance($database, $config);
        $this->_instance->connect();
    }

    /**
     * Get database collection names
     *
     * @param bool $includeSystemCollections
     *
     * @return array
     */
    public function getCollectionNames($includeSystemCollections = false)
    {
        return $this->_instance->getDB()->getCollectionNames($includeSystemCollections);
    }

    /**
     * Insert data into collection
     *
     * @param string $collectionName
     * @param array  $data
     * @param array  $options options
     *
     * @return mixed
     */
    public function insert($collectionName, array $data, $options = [])
    {
        return $this->_instance->insert($collectionName, $data, $options);
    }

    /**
     * Group
     *
     * @param string $collectionName collection name
     * @param array  $keys           keys
     * @param array  $initial        initial
     * @param array  $reduce         reduce
     * @param array  $condition      condition
     *
     * @return mixed
     */
    public function group($collectionName, $keys, array $initial, $reduce, array $condition = [])
    {
        return $this->_instance->group($collectionName, $keys, $initial, $reduce, $condition);
    }

    /**
     * Get reference
     *
     * @param array $ref ref
     *
     * @return \MongoDBRef
     */
    public function getReference(array $ref)
    {
        return $this->_instance->getRef($ref);
    }

    /**
     * Ensure index
     *
     * @param string $collectionName name
     * @param string $keys           keys
     * @param array  $options        options
     *
     * @return string|null
     */
    public function ensureIndex($collectionName, $keys, $options = [])
    {
        return $this->_instance->ensure_index($collectionName, $keys, $options);
    }

    /**
     * Execute
     *
     * @param string $code code
     * @param array  $args array
     *
     * @return string|null
     */
    public function execute($code, array $args = [])
    {
        return $this->_instance->execute($code, $args);
    }

    /**
     * Find
     *
     * @param string $collectionName collection name
     * @param array  $query          query
     * @param array  $fields         fields
     *
     * @return mixed
     */
    public function find($collectionName, array $query = [], array $fields = [])
    {
        return $this->_instance->find($collectionName, $query, $fields);
    }

    /**
     * Create collection
     *
     * @param string $name   name
     * @param bool   $capped Enables a capped collection. To create a capped collection, specify true. If you specify true, you must also set a maximum size in the size field.
     * @param int    $size   Specifies a maximum size in bytes for a capped collection. The size field is required for capped collections. If capped is false, you can use this field to preallocate space for an ordinary collection.
     * @param int    $max    The maximum number of documents allowed in the capped collection. The size limit takes precedence over this limit. If a capped collection reaches its maximum size before it reaches the maximum number of documents, MongoDB removes old documents. If you prefer to use this limit, ensure that the size limit, which is required, is sufficient to contain the documents limit.
     *
     * @return string|null
     */
    public function createCollection($name, $capped = false, $size = 0, $max = 0)
    {
        return $this->_instance->create_collection($name, $capped, $size, $max);
    }

    /**
     * Drop collection
     *
     * @param $collectionName
     *
     * @return string|null
     */
    public function dropCollection($collectionName)
    {
        return $this->_instance->drop_collection($collectionName);
    }

    /**
     * Command
     *
     * @param array $data data
     *
     * @return string|null
     */
    public function command(array $data)
    {
        return $this->_instance->command($data);
    }

    /**
     * Distinct
     *
     * @param array $data data
     *
     * @return string|null
     */
    public function distinct(array $data)
    {
        return $this->_instance->distinct($data);
    }

    /**
     * Find one
     *
     * @param string $collectionName collection name
     * @param array  $query          query
     * @param array  $fields         fields
     *
     * @return mixed
     */
    public function findOne($collectionName, array $query = [], array $fields = [])
    {
        return $this->_instance->find_one($collectionName, $query, $fields);
    }

    /**
     * Count
     *
     * @param string $collectionName collection name
     * @param array  $query          query
     *
     * @return mixed
     */
    public function count($collectionName, array $query = [])
    {
        return $this->_instance->count($collectionName, $query);
    }

    /**
     * Remove
     *
     * @param string $collectionName collection name
     * @param array  $criteria       criteria
     * @param array  $options        options
     *
     * @return mixed
     */
    public function remove($collectionName, array $criteria, $options = [])
    {
        return $this->_instance->remove($collectionName, $criteria, $options);
    }

    /**
     * Save
     *
     * @param string $collectionName collection name
     * @param array  $data           data
     * @param array  $options        options
     *
     * @internal param array $a a
     * @return mixed
     */
    public function save($collectionName, array $data, $options = [])
    {
        return $this->_instance->save($collectionName, $data, $options);
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function aggregate(array $options)
    {
        return call_user_func_array([
                                        $this->_instance,
                                        'aggregate'
                                    ], $options
        );
    }

    /**
     * update
     *
     * @param string $collectionName collection name
     * @param array  $criteria       criteria
     * @param array  $newObj         new obj
     * @param array  $options        options
     *
     * @return mixed
     */
    public function update($collectionName, array $criteria, array $newObj, $options = [])
    {
        return $this->_instance->update($collectionName, $criteria, $newObj, $options);
    }
}