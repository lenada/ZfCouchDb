<?php
return array(
    'di' => array(
        'definition' => array(
            'class' => array(
                'ZfCouchDb\Factory\DocumentManager' => array(
                    'instantiator' => array('ZfCouchDb\Factory\DocumentManager', 'get'),
                    'methods' => array(
                        'get' => array(
                            //@todo make this work with di
                            //'dbClient' => array('type' => 'doctrine_couch_db_client','required' => true),
                            //'config' => array('type' => 'Doctrine\ODM\CouchDB\Configuration','required' => true)
                        )
                    )
                ),
            ),
        ),
        'instance' => array(
            'alias' => array(
               	'doctrine_couch_http_client' => 'Doctrine\CouchDB\HTTP\SocketClient',
           		'doctrine_couch_db_client' => 'Doctrine\CouchDB\CouchDBClient',
                'doctrine_couch_config' => 'Doctrine\ODM\CouchDB\Configuration',
                'doctrine_dm'           => 'ZfCouchDb\Factory\DocumentManager',
        
        
            ),
            /*'doctrine_couch_config' => array(
            	'designDocuments' => array(
            		'doctrine_associations' => array(    
                	'className' => 'Doctrine\ODM\CouchDB\View\DoctrineAssociations',
                	'options' => array(),
            	),
            	'doctrine_repositories' => array(
                'className' => 'Doctrine\ODM\CouchDB\View\DoctrineRepository',
                'options' => array(),
		            ),
		        ),
		        'writeDoctrineMetadata' => true,
		        'validateDoctrineMetadata' => true,
		        'UUIDGenerationBufferSize' => 20,
		        'proxyNamespace' => 'MyCouchDBProxyNS',
		        'allOrNothingFlush' => true,
		        'luceneHandlerName' => false,
		        'metadataResolver' => null
            ),*/

            'doctrine_couch_db_client' => array(
            	'parameters' => array(
            		'httpClient' => 'Doctrine\CouchDB\HTTP\SocketClient',
            		'dbname'=>'buggy'
            	)
            )
        )
    )
);