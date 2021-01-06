<?php

/**
 * TechDivision\Import\Dbal\Configuration\ConfigurationInterface
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

namespace TechDivision\Import\Dbal\Configuration;

/**
 * Interface for a configuration implementation of the DBAL implementation.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2021 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-dbal
 * @link      http://www.techdivision.com
 */
interface ConfigurationInterface
{

    /**
     * Set's the array with the finder mappings.
     *
     * @param array $finderMappings The finder mappings
     *
     * @return void
     */
    public function setFinderMappings(array $finderMappings);

    /**
     * Return's the array with the finder mappings.
     *
     * @return array The finder mappings
     */
    public function getFinderMappings();

    /**
     * Return's the mapped finder for the passed key.
     *
     * @param string $key The key of the finder to map
     *
     * @return string The mapped finder name
     * @throws \InvalidArgumentException Is thrown if the mapping with passed key can not be resolved
     */
    public function getFinderMappingByKey($key);
}
