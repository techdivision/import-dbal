<?php

/**
 * TechDivision\Import\Dbal\Actions\ProcessorAwareActionInterface
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2021 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-dbal
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Dbal\Actions;

/**
 * The interface for all processor aware action implementations.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2021 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-dbal
 * @link      http://www.techdivision.com
 */
interface ProcessorAwareActionInterface extends ActionInterface
{

    /**
     * Return's the create processor instance.
     *
     * @return \TechDivision\Import\Dbal\Actions\Processors\ProcessorInterface The create processor instance
     */
    public function getCreateProcessor();

    /**
     * Return's the delete processor instance.
     *
     * @return \TechDivision\Import\Dbal\Actions\Processors\ProcessorInterface The delete processor instance
     */
    public function getDeleteProcessor();

    /**
     * Return's the update processor instance.
     *
     * @return \TechDivision\Import\Dbal\Actions\Processors\ProcessorInterface The update processor instance
     */
    public function getUpdateProcessor();
}
