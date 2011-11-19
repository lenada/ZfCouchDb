<?php
namespace ZfCouchDb;

use Zend\EventManager\Event,
    Zend\Module\Consumer\AutoloaderProvider,
    Zend\Module\Manager,
    Zend\Di\Display\Console,
    Doctrine\Common\Annotations\SimpleAnnotationReader,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\ODM\CouchDB\Configuration;

class Module implements AutoloaderProvider
{
    
    public function init(Manager $moduleManager)
    {
		$config = $moduleManager->getMergedConfig(false);
    	$this->initCouchDbAnnotations($config);
    }

    public function initCouchDbAnnotations($config)
    {
        $annotationDirectory = __DIR__ . '/../../vendor/doctrine/couchdb-odm/lib/Doctrine/ODM/CouchDB/Mapping/Annotations/';

        if(isset($config['zfcouchdb-annotations'])){
            $annotationDirectory = $config['zfcouchdb-annotations'];
        }
 
        if (is_dir($annotationDirectory)) {
           $files = scandir($annotationDirectory);
           foreach($files as $key => $annotation){
               if(file_exists($annotationDirectory.$annotation) && !is_dir($annotationDirectory.$annotation)){
                   AnnotationRegistry::registerFile($annotationDirectory.$annotation);
               }
           }
        } else {

                throw new \Exception('Failed to register annotations. Ensure Doctrine is on your include path.');
        }
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/configs/module.config.php';
    }
}
