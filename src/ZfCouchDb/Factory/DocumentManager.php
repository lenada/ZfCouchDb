<?php
namespace ZfCouchDb\Factory;
use Doctrine\ODM\CouchDB\DocumentManager as DoctrineDocumentManager,
	Doctrine\ODM\CouchDB\Configuration,
	Doctrine\CouchDB\CouchDBClient,
	Doctrine\CouchDB\HTTP\SocketClient;

class DocumentManager
{

	/*function __construct(){
		
		$couchConfig = new Configuration();
		$documentDirectories = array('/');
		$driverImpl = $couchConfig->newDefaultAnnotationDriver($documentDirectories);

		$couchConfig->setMetadataDriverImpl($driverImpl);
        $couchConfig->setLuceneHandlerName('_fti');

        		$httpClient = new \Doctrine\CouchDB\HTTP\SocketClient();
                $dbClient = new \Doctrine\CouchDB\CouchDBClient($httpClient, 'buggy');
        		
        return $dm = new DoctrineDocumentManager($dbClient, $couchConfig);
			
	}*/
	
	public static function get($databaseName = "buggy")
	{

                $couchConfig = new Configuration();
                //$databaseName = "buggy";
                $documentPaths = array('Buggy\Document');
                $httpClient = new \Doctrine\CouchDB\HTTP\SocketClient();
                $dbClient = new \Doctrine\CouchDB\CouchDBClient($httpClient, $databaseName);

                $driverImpl = $couchConfig->newDefaultAnnotationDriver($documentPaths);
                $couchConfig->setMetadataDriverImpl($driverImpl);
                $couchConfig->setProxyDir(\sys_get_temp_dir());
                $couchConfig->setLuceneHandlerName('_fti');

                $dm = \Doctrine\ODM\CouchDB\DocumentManager::create($dbClient, $couchConfig);

                return $dm;
	}
}