<?php

namespace App\vendor;

use Stancl\Tenancy\Concerns\CreatesDatabaseUsers;
use Stancl\Tenancy\Contracts\ManagesDatabaseUsers;
use Stancl\Tenancy\DatabaseConfig;

class PermissionControlledSQLServerDatabaseManager extends SqlServerDatabaseManager implements ManagesDatabaseUsers
{
    use CreatesDatabaseUsers;



    public function createUser(DatabaseConfig $databaseConfig): bool
    {
        $database = $databaseConfig->getName();
        $username = $databaseConfig->getUsername();
        $hostname = $databaseConfig->connection()['host'];
        $password = $databaseConfig->getPassword();

        $GrantPermissions = "Use {$database}
        CREATE LOGIN {$username} WITH PASSWORD = '{$password}'
        CREATE USER {$username} FOR LOGIN {$username}
        ALTER ROLE db_owner ADD MEMBER {$username}  Use landlord";

        return $this->database()->statement($GrantPermissions);

    }

    public function deleteUser(DatabaseConfig $databaseConfig): bool
    {
        return $this->database()->statement("Use'{$databaseConfig->getName()}'
        DROP USER IF EXISTS '{$databaseConfig->getUsername()}'
        DROP LOGIN '{$databaseConfig->getUsername()}'
        Use landlord");
    }
    public function userExists(string $username): bool
    {
        return (bool) $this->database()->select("SELECT sp.name as username FROM sys.server_principals sp WHERE sp.name = '{$username}'");
    }

    public function makeConnectionConfig(array $baseConfig, string $databaseName): array
    {
        $baseConfig['database'] = $databaseName;

        return $baseConfig;
    }
}
