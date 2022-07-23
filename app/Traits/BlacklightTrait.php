<?php

namespace App\Traits;

use Solarium\Client as SolrClient;
use Solarium\Core\Client\Adapter\Curl as SolrClientAdapter;
use Solarium\QueryType\Select\Result\Result;
use Symfony\Component\EventDispatcher\EventDispatcher;

trait BlacklightTrait {

    private function executeHomePageSelect(): Result {
        // define and open solr client
        $adapter = new SolrClientAdapter();
        $eventDispatcher = new EventDispatcher();
        $config = config('solrEndpoints.testing');
        $solrClient = new SolrClient($adapter, $eventDispatcher, $config);

        // solr select query
        $query = $solrClient->createSelect();

        // set rows to 1
        $query->setRows(0);

        // load facet fields into query
        foreach(config('solrEndpoints.testing.facetFields') as $facetField) {
            $query->getFacetSet()->createFacetField($facetField)->setField($facetField);
        }

        // execute query
        $result = $solrClient->select($query);

        return $result;
    }
}
