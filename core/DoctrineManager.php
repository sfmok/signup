<?php

namespace Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Core\Config\DB;

class DoctrineManager
{

    public static function entityManager()
    {
        $isDevMode  = true;
        $paths      = [ __DIR__ . "/src/Entity/" ];
        $config     = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);


        $conn = [
            'driver'    => DB::DB_DRIVER,
            'dbname'    => DB::DB_NAME,
            'user'      => DB::DB_USER,
            'password'  => DB::DB_PASSWORD,
            'host'      => DB::DB_HOST,
        ];

        return EntityManager::create($conn, $config);
    }
}
