<?php
/**
 * Elasticsearch PHP client
 *
 * @link      https://github.com/elastic/elasticsearch-php/
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license   https://www.gnu.org/licenses/lgpl-2.1.html GNU Lesser General Public License, Version 2.1
 *
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the Apache 2.0 License or
 * the GNU Lesser General Public License, Version 2.1, at your option.
 * See the LICENSE file in the project root for more information.
 */

/**
 * File required for aliasing old classname used by elasticsearch-php 6.7
 * Used by elasticsearch-php 6.8.0+
 * @see https://github.com/elastic/elasticsearch-php/issues/967
 */

$aliasToClass = [
    '\Digistorm\Endpoints\Cluster\Nodes\HotThreads'           => '\Digistorm\Endpoints\Nodes\HotThreads',
    '\Digistorm\Endpoints\Cluster\Nodes\Info'                 => '\Digistorm\Endpoints\Nodes\Info' ,
    '\Digistorm\Endpoints\Cluster\Nodes\ReloadSecureSettings' => '\Digistorm\Endpoints\Nodes\ReloadSecureSettings',
    '\Digistorm\Endpoints\Cluster\Nodes\Stats'                => '\Digistorm\Endpoints\Nodes\Stats',
    '\Digistorm\Endpoints\Cluster\Settings\Get'               => '\Digistorm\Endpoints\Cluster\GetSettings',
    '\Digistorm\Endpoints\Cluster\Settings\Put'               => '\Digistorm\Endpoints\Cluster\PutSettings',
    '\Digistorm\Endpoints\Indices\Alias\Delete'               => '\Digistorm\Endpoints\Indices\DeleteAlias',
    '\Digistorm\Endpoints\Indices\Alias\Exists'               => '\Digistorm\Endpoints\Indices\ExistsAlias',
    '\Digistorm\Endpoints\Indices\Alias\Get'                  => '\Digistorm\Endpoints\Indices\GetAlias',
    '\Digistorm\Endpoints\Indices\Alias\Put'                  => '\Digistorm\Endpoints\Indices\PutAlias',
    '\Digistorm\Endpoints\Indices\Aliases\Update'             => '\Digistorm\Endpoints\Indices\UpdateAliases',
    '\Digistorm\Endpoints\Indices\Cache\Clear'                => '\Digistorm\Endpoints\Indices\ClearCache',
    '\Digistorm\Endpoints\Indices\Exists\Types'               => '\Digistorm\Endpoints\Indices\ExistsType',
    '\Digistorm\Endpoints\Indices\Type\Exists'                => '\Digistorm\Endpoints\Indices\ExistsType',
    '\Digistorm\Endpoints\Indices\Field\Get'                  => '\Digistorm\Endpoints\Indices\GetFieldMapping',
    '\Digistorm\Endpoints\Indices\Mapping\GetField'           => '\Digistorm\Endpoints\Indices\GetFieldMapping',
    '\Digistorm\Endpoints\Indices\Mapping\Get'                => '\Digistorm\Endpoints\Indices\GetMapping',
    '\Digistorm\Endpoints\Indices\Mapping\Put'                => '\Digistorm\Endpoints\Indices\PutMapping',
    '\Digistorm\Endpoints\Indices\Settings\Get'               => '\Digistorm\Endpoints\Indices\GetSettings',
    '\Digistorm\Endpoints\Indices\Settings\Put'               => '\Digistorm\Endpoints\Indices\PutSettings',
    '\Digistorm\Endpoints\Indices\Template\Get'               => '\Digistorm\Endpoints\Indices\GetTemplate',
    '\Digistorm\Endpoints\Indices\Template\Put'               => '\Digistorm\Endpoints\Indices\PutTemplate',
    '\Digistorm\Endpoints\Indices\Template\Exists'            => '\Digistorm\Endpoints\Indices\ExistsTemplate',
    '\Digistorm\Endpoints\Indices\Template\Delete'            => '\Digistorm\Endpoints\Indices\DeleteTemplate',
    '\Digistorm\Endpoints\Indices\Upgrade\Get'                => '\Digistorm\Endpoints\Indices\GetUpgrade',
    '\Digistorm\Endpoints\Indices\Upgrade\Post'               => '\Digistorm\Endpoints\Indices\Upgrade',
    '\Digistorm\Endpoints\Indices\Validate\Query'             => '\Digistorm\Endpoints\Indices\ValidateQuery',
    '\Digistorm\Endpoints\Ingest\Pipeline\Delete'             => '\Digistorm\Endpoints\Ingest\DeletePipeline',
    '\Digistorm\Endpoints\Ingest\Pipeline\Get'                => '\Digistorm\Endpoints\Ingest\GetPipeline',
    '\Digistorm\Endpoints\Ingest\Pipeline\Put'                => '\Digistorm\Endpoints\Ingest\PutPipeline',
    '\Digistorm\Endpoints\Ingest\Pipeline\ProcessorGrok'      => '\Digistorm\Endpoints\Ingest\ProcessorGrok',
    '\Digistorm\Endpoints\Script\Get'                         => '\Digistorm\Endpoints\GetScript',
    '\Digistorm\Endpoints\Script\Put'                         => '\Digistorm\Endpoints\PutScript',
    '\Digistorm\Endpoints\Script\Delete'                      => '\Digistorm\Endpoints\DeleteScript',
    '\Digistorm\Endpoints\Snapshot\Repository\Create'         => '\Digistorm\Endpoints\Snapshot\CreateRepository',
    '\Digistorm\Endpoints\Snapshot\Repository\Delete'         => '\Digistorm\Endpoints\Snapshot\DeleteRepository',
    '\Digistorm\Endpoints\Snapshot\Repository\Get'            => '\Digistorm\Endpoints\Snapshot\GetRepository',
    '\Digistorm\Endpoints\Snapshot\Repository\Verify'         => '\Digistorm\Endpoints\Snapshot\VerifyRepository',
    '\Digistorm\Endpoints\Source\Get'                         => '\Digistorm\Endpoints\GetSource',
    '\Digistorm\Endpoints\Tasks\TasksList'                    => '\Digistorm\Endpoints\Tasks\ListTasks'
];

foreach ($aliasToClass as $alias => $original) {
    if (!class_exists($alias, false)) {
        class_alias($original, $alias);
    }
}
