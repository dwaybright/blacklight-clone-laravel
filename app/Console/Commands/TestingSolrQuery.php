<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Solarium\Client as SolrClient;
use Solarium\Core\Client\Adapter\Curl as SolrClientAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TestingSolrQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes test solr query';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Using Solarium version: ' . SolrClient::VERSION);

        // define and open solr client
        $adapter = new SolrClientAdapter();
        $eventDispatcher = new EventDispatcher();
        $config = config('solrEndpoints.testing');
        $solrClient = new SolrClient($adapter, $eventDispatcher, $config);

        // solr select query
        $query = $solrClient->createSelect();

        // load facet fields into query
        foreach(config('solrEndpoints.testing.facetFields') as $facetField) {
            $query->getFacetSet()->createFacetField($facetField)->setField($facetField);
        }

        // execute query
        $results = $solrClient->select($query);

        // print num documents returned
        $this->info('num docs in results: ' . count($results));

        // print num records found
        $this->info('total results: ' . $results->getNumFound());

        // list facet returns and counts
        foreach(config('solrEndpoints.testing.facetFields') as $facetField) {
            $facet = $results->getFacetSet()->getFacet($facetField);

            $this->info($facetField);
            foreach($facet as $value => $count) {
                $this->info("\t{$value}: {$count}");
            }
        }

        return 0;
    }
}
