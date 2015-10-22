<?php

namespace LocDVD\APIBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LocDVDAPIBundle extends Bundle
{
	/**
	 * Boots the Bundle.
	 */
	public function boot()
	{
		// Add my PostgreSQL oid custom type to the list of available	column types
		// You only need this line if you have not added the equivalent to config.yml
		//Type::addType('oid', 'YourCompany\YourBundle\Types\OID');
	
		// Grab the Entity Manager and register my PostgreSQL oid 		custom type with Doctrine
		$em = $this->container->get('doctrine.orm.default_entity_manager');
	
		$conn = $em->getConnection();
		$conn->getDatabasePlatform()->registerDoctrineTypeMapping('video_type', 'string');
	}
}
