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

declare(strict_types = 1);

namespace Digistorm\Tests;

use Digistorm\Namespaces\IndicesNamespace;

/**
 * Class BackwardCompatibleTest
 *
 * @subpackage Tests
 */
class BackwardCompatibleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * List of endpoints in elasticsearch-php 6.7
     */
    public function getClasses()
    {
        return [
            ['Digistorm\Endpoints\Delete'],
            ['Digistorm\Endpoints\ScriptsPainlessExecute'],
            ['Digistorm\Endpoints\Create'],
            ['Digistorm\Endpoints\Exists'],
            ['Digistorm\Endpoints\Get'],
            ['Digistorm\Endpoints\Explain'],
            ['Digistorm\Endpoints\Search'],
            ['Digistorm\Endpoints\FieldCaps'],
            ['Digistorm\Endpoints\Msearch'],
            ['Digistorm\Endpoints\Mget'],
            ['Digistorm\Endpoints\DeleteByQuery'],
            ['Digistorm\Endpoints\Info'],
            ['Digistorm\Endpoints\AbstractEndpoint'],
            ['Digistorm\Endpoints\RankEval'],
            ['Digistorm\Endpoints\Bulk'],
            ['Digistorm\Endpoints\Index'],
            ['Digistorm\Endpoints\SearchShards'],
            ['Digistorm\Endpoints\Scroll'],
            ['Digistorm\Endpoints\RenderSearchTemplate'],
            ['Digistorm\Endpoints\MsearchTemplate'],
            ['Digistorm\Endpoints\Reindex'],
            ['Digistorm\Endpoints\UpdateByQuery'],
            ['Digistorm\Endpoints\Update'],
            ['Digistorm\Endpoints\Ping'],
            ['Digistorm\Endpoints\SearchTemplate'],
            ['Digistorm\Endpoints\Count'],
            ['Digistorm\Endpoints\ClearScroll'],
            ['Digistorm\Endpoints\Tasks\Get'],
            ['Digistorm\Endpoints\Tasks\Cancel'],
            ['Digistorm\Endpoints\Tasks\TasksList'],
            ['Digistorm\Endpoints\Indices\ValidateQuery'],
            ['Digistorm\Endpoints\Indices\Delete'],
            ['Digistorm\Endpoints\Indices\Create'],
            ['Digistorm\Endpoints\Indices\Exists'],
            ['Digistorm\Endpoints\Indices\Stats'],
            ['Digistorm\Endpoints\Indices\Shrink'],
            ['Digistorm\Endpoints\Indices\Get'],
            ['Digistorm\Endpoints\Indices\Analyze'],
            ['Digistorm\Endpoints\Indices\ClearCache'],
            ['Digistorm\Endpoints\Indices\ShardStores'],
            ['Digistorm\Endpoints\Indices\Segments'],
            ['Digistorm\Endpoints\Indices\Split'],
            ['Digistorm\Endpoints\Indices\Close'],
            ['Digistorm\Endpoints\Indices\Open'],
            ['Digistorm\Endpoints\Indices\Rollover'],
            ['Digistorm\Endpoints\Indices\Flush'],
            ['Digistorm\Endpoints\Indices\Refresh'],
            ['Digistorm\Endpoints\Indices\Recovery'],
            ['Digistorm\Endpoints\Indices\Validate\Query'],
            ['Digistorm\Endpoints\Indices\Mapping\Get'],
            ['Digistorm\Endpoints\Indices\Mapping\Put'],
            ['Digistorm\Endpoints\Indices\Type\Exists'],
            ['Digistorm\Endpoints\Indices\Template\Exists'],
            ['Digistorm\Endpoints\Indices\Template\Put'],
            ['Digistorm\Endpoints\Indices\Alias\Delete'],
            ['Digistorm\Endpoints\Indices\Alias\Exists'],
            ['Digistorm\Endpoints\Indices\Alias\Get'],
            ['Digistorm\Endpoints\Indices\Alias\Put'],
            ['Digistorm\Endpoints\Indices\Aliases\Update'],
            ['Digistorm\Endpoints\Indices\Exists\Types'],
            ['Digistorm\Endpoints\Indices\Field\Get'],
            ['Digistorm\Endpoints\Indices\Settings\Get'],
            ['Digistorm\Endpoints\Indices\Settings\Put'],
            ['Digistorm\Endpoints\Indices\Upgrade\Get'],
            ['Digistorm\Endpoints\Indices\Upgrade\Post'],
            ['Digistorm\Endpoints\Indices\Cache\Clear'],
            ['Digistorm\Endpoints\Snapshot\Delete'],
            ['Digistorm\Endpoints\Snapshot\Create'],
            ['Digistorm\Endpoints\Snapshot\Get'],
            ['Digistorm\Endpoints\Snapshot\Status'],
            ['Digistorm\Endpoints\Snapshot\Restore'],
            ['Digistorm\Endpoints\Snapshot\Repository\Delete'],
            ['Digistorm\Endpoints\Snapshot\Repository\Create'],
            ['Digistorm\Endpoints\Snapshot\Repository\Verify'],
            ['Digistorm\Endpoints\Snapshot\Repository\Get'],
            ['Digistorm\Endpoints\Ingest\Simulate'],
            ['Digistorm\Endpoints\Ingest\Pipeline\Delete'],
            ['Digistorm\Endpoints\Ingest\Pipeline\Get'],
            ['Digistorm\Endpoints\Ingest\Pipeline\ProcessorGrok'],
            ['Digistorm\Endpoints\Ingest\Pipeline\Put'],
            ['Digistorm\Endpoints\Cat\Fielddata'],
            ['Digistorm\Endpoints\Cat\PendingTasks'],
            ['Digistorm\Endpoints\Cat\ThreadPool'],
            ['Digistorm\Endpoints\Cat\Allocation'],
            ['Digistorm\Endpoints\Cat\Indices'],
            ['Digistorm\Endpoints\Cat\Snapshots'],
            ['Digistorm\Endpoints\Cat\Repositories'],
            ['Digistorm\Endpoints\Cat\Segments'],
            ['Digistorm\Endpoints\Cat\Health'],
            ['Digistorm\Endpoints\Cat\Help'],
            ['Digistorm\Endpoints\Cat\Aliases'],
            ['Digistorm\Endpoints\Cat\Plugins'],
            ['Digistorm\Endpoints\Cat\Shards'],
            ['Digistorm\Endpoints\Cat\Tasks'],
            ['Digistorm\Endpoints\Cat\Recovery'],
            ['Digistorm\Endpoints\Cat\Nodes'],
            ['Digistorm\Endpoints\Cat\Count'],
            ['Digistorm\Endpoints\Cat\Master'],
            ['Digistorm\Endpoints\Cat\Templates'],
            ['Digistorm\Endpoints\Cluster\PendingTasks'],
            ['Digistorm\Endpoints\Cluster\Stats'],
            ['Digistorm\Endpoints\Cluster\Reroute'],
            ['Digistorm\Endpoints\Cluster\RemoteInfo'],
            ['Digistorm\Endpoints\Cluster\Health'],
            ['Digistorm\Endpoints\Cluster\State'],
            ['Digistorm\Endpoints\Cluster\AllocationExplain'],
            ['Digistorm\Endpoints\Cluster\Settings\Get'],
            ['Digistorm\Endpoints\Cluster\Settings\Put'],
            ['Digistorm\Endpoints\Cluster\Nodes\Stats'],
            ['Digistorm\Endpoints\Cluster\Nodes\ReloadSecureSettings'],
            ['Digistorm\Endpoints\Cluster\Nodes\Info'],
            ['Digistorm\Endpoints\Cluster\Nodes\HotThreads'],
            ['Digistorm\Endpoints\Source\Get'],
            ['Digistorm\Endpoints\Script\Delete'],
            ['Digistorm\Endpoints\Script\Get'],
            ['Digistorm\Endpoints\Script\Put'],
        ];
    }

    /**
     * @dataProvider getClasses
     */
    public function testOldClassNamespacesPreviousTo67($class)
    {
        $this->assertTrue(class_exists($class, true), sprintf("Class %s does not exist", $class));
    }

    /**
     * @see https://github.com/elastic/elasticsearch-php/issues/1112
     */
    public function testGetAliasesExistsInIndicesNamespace()
    {
        $this->assertTrue(method_exists(IndicesNamespace::class, 'getAliases'));
    }
}
