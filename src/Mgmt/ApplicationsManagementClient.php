<?php

declare(strict_types=1);
namespace Authing\Mgmt;

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\AclManagementClient;
use Authing\Mgmt\AgreementManagementClient;
use Authing\Mgmt\RolesManagementClient;
use Authing\Types\ResourceType;

class ApplicationsManagementClient
{
    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * @var AclManagementClient
     */
    private $acl;

    /**
     * @var RolesManagementClient
     */
    private $roles;

    /**
     * @var AgreementManagementClient
     */
    private $agreements;

    /**
     * @param \Authing\Mgmt\ManagementClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->acl = new AclManagementClient($client);
        $this->roles = new RolesManagementClient($client);
        $this->agreements = new AgreementManagementClient($client);
    }

    public function list(array $params = [
        'page' => 1,
        'limit' => 10
    ])
    {
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $data = $this->client->httpGet("/api/v2/applications?page=$page&limit=$limit");
        return $data;
    }

    public function create(array $params)
    {
        $res = $this->client->httpPost('/api/v2/applications', (object)$params);
        return $res;
    }

    public function delete(string $appId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId");
        return true;
    }

    public function findById(string $id)
    {
        $data = $this->client->httpGet("/api/v2/applications/$id");
        return $data;
    }

    public function listResources(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        return $this->acl->getResources($options);
    }

    public function createResource(string $appId, array $options)
    {
        $options['namespace'] = $appId;
        return $this->acl->createResource($options);
    }

    public function createResourceBatch(string $appId, array $resources)
    {
        foreach ($resources as $resource) {
            $resource['namespace'] = $appId;
        }
        return $this->acl->createResourceBatch($resources);
    }

    public function updateResource(string $appId, array $options)
    {
        $options['namespace'] = $appId;
        return $this->acl->updateResource($options['code'], $options);
    }

    /**
     * @param string $namespaceCode
     */
    public function deleteResource(string $appId, string $code)
    {
        return $this->acl->deleteResource($code, $appId);
    }

    public function getAccessPolicies(string $appId, array $options = [])
    {
        $options['appId'] = $appId;
        return $this->acl->getAccessPolicies($options);
    }

    public function enableAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->enableAccessPolicy($options);
    }

    public function disableAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->disableAccessPolicy($options);
    }

    public function deleteAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->deleteAccessPolicy($options);
    }

    public function allowAccess(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->allowAccess($options);
    }

    public function denyAccess(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->denyAccess($options);
    }

    public function updateDefaultAccessPolicy(string $appId, string $defaultStrategy)
    {
        $options = [
            'appId' => $appId,
            'defaultStrategy' => $defaultStrategy
        ];
        return $this->acl->updateDefaultAccessPolicy($options);
    }

    public function createRole(string $appId, array $options)
    {
        return $this->roles->create($options['code'], $options['description'], $appId);
    }

    public function deleteRole(string $appId, string $code)
    {
        return $this->roles->delete($code, $appId);
    }

    public function deleteRoles(string $appId, array $codes)
    {
        return $this->roles->deleteMany($codes, $appId);
    }


    public function updateRole(string $appId, array $options)
    {
        $options['namespace'] = $appId;
        return $this->roles->update($options['code'], $options);
    }

    public function findRole(string $appId, string $code)
    {
        return $this->roles->detail($code, $appId);
    }

    public function getRoles(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        return $this->roles->paginate($options);
    }

    public function getUsersByRoleCode(string $appId, string $code)
    {
        return $this->roles->listUsers($code, [
            'namespace' => $appId
        ]);
    }

    public function addUsersToRole(string $appId, string $code, array $userIds)
    {
        return $this->roles->addUsers($code, $userIds, $appId);
    }

    public function removeUsersFromRole(string $appId, string $code, array $userIds)
    {
        return $this->roles->removeUsers($code, $userIds, $appId);
    }

    public function listAuthorizedResourcesByRole(string $appId, string $code, string $resourceType = '')
    {
        return $this->roles->listAuthorizedResources($code, $appId, $resourceType);
    }

    public function createAgreement(string $appId, array $agreement)
    {
        $args = func_get_args();
        return $this->agreements->create(...$args);
    }

    public function deleteAgreement(string $appId, string $agreementId)
    {
        $args = func_get_args();
        return $this->agreements->delete(...$args);
    }

    public function modifyAgreement(string $appId, string $agreementId, array $updates)
    {
        $args = func_get_args();
        return $this->agreements->modify(...$args);
    }

    public function listAgreement(string $appId)
    {
        $args = func_get_args();
        return $this->agreements->list(...$args);
    }

    public function sortAgreement(string $appId, array $order)
    {
        $args = func_get_args();
        return $this->agreements->sort(...$args);
    }

    public function activeUsers(string $appId, int $page = 1, int $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/active-users?page=$page&limit=$limit");
        return $res;
    }

    public function refreshApplicationSecret(string $appId)
    {
        $res = $this->client->httpPatch("/api/v2/application/$appId/refresh-secret");
        return $res;
    }
}
