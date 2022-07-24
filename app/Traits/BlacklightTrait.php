<?php

namespace App\Traits;

use Solarium\Client as SolrClient;
use Solarium\Core\Client\Adapter\Curl as SolrClientAdapter;
use Solarium\QueryType\Select\Result\Result;
use Symfony\Component\EventDispatcher\EventDispatcher;

trait BlacklightTrait {

    private function buildSolrClient(): SolrClient
    {
        $adapter = new SolrClientAdapter();
        $eventDispatcher = new EventDispatcher();
        $config = config('solrEndpoints.testing');
        $solrClient = new SolrClient($adapter, $eventDispatcher, $config);

        return $solrClient;
    }

    private function executeSolrSearch(string $search, array $selectedFacets, int $numRows, int $startRow): Result {
        // define and open solr client
        $solrClient = $this->buildSolrClient();

        // solr select query
        $query = $solrClient->createSelect();

        // set rows to 1
        $query->setStart($startRow);
        $query->setRows($numRows); 

        // load facet fields into query
        foreach(config('solrEndpoints.testing.facetFields') as $facetField) {
            $query->getFacetSet()->createFacetField($facetField)->setField($facetField);
        }

        // build query string
        $solrSearchSections = [];

        // add blacklight search q
        if(!empty($search)) {
            array_push($solrSearchSections, $search);
        }

        // add selected facets
        foreach($selectedFacets as $selectedFacet => $selectedFacetValues) {
            foreach($selectedFacetValues as $facetValue) {
                array_push($solrSearchSections, "{$selectedFacet}:\"{$facetValue}\"");
            }
        }

        // set query
        if (count($solrSearchSections) > 0) {
            $query->setQuery(implode(' AND ', $solrSearchSections));
        }

        // execute query
        $result = $solrClient->select($query);

        return $result;
    }

    private function executeHomePageSelect(): Result {
        // define and open solr client
        $solrClient = $this->buildSolrClient();

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
