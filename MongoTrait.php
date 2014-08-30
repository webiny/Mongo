<?php
/**
 * Webiny Framework (http://www.webiny.com/framework)
 *
 * @copyright Copyright Webiny LTD
 */

namespace Webiny\Component\Mongo;

use Webiny\Component\ServiceManager\ServiceManager;
use Webiny\Component\ServiceManager\ServiceManagerException;

/**
 * Trait for Mongo component.
 *
 * @package         Webiny\Component\Mongo
 */
trait MongoTrait
{
    /**
     * @param string $database Mongo service name (Default: Webiny)
     *
     * @return Mongo
     * @throws \Webiny\Component\ServiceManager\ServiceManagerException
     */
    protected static function mongo($database = 'Webiny')
    {
        try {
            return ServiceManager::getInstance()->getService('Mongo.' . $database);
        } catch (ServiceManagerException $e) {
            throw $e;
        }
    }
}