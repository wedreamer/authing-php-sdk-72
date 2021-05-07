<?php

namespace Authing\Mgmt;

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\AclManagementClient;
use Authing\Mgmt\AgreementManagementClient;
use Authing\Mgmt\RolesManagementClient;

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

    public function list($params = [])
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $data = $this->client->httpGet("/api/v2/applications?page=$page&limit=$limit");
        return $data;
    }

    /**
     * @param string $id
     */
    public function findById($id)
    {
        $data = $this->client->httpGet("/api/v2/applications/$id");
        return $data;
    }

    public function create($options)
    {
        $res = $this->client->httpPost('/api/v2/applications', (object)$options);
        return $res;
    }

    /**
     * @param string $appId
     */
    public function delete($appId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId");
        return true;
    }

    /**
     * @param string $appId
     * @param int $page
     * @param int $limit
     */
    public function activeUsers($appId, $page = 1, $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/active-users?page=$page&limit=$limit");
        return $res;
    }

    /**
     * @param string $appId
     */
    public function refreshApplicationSecret($appId)
    {
        $res = $this->client->httpPatch("/api/v2/application/$appId/refresh-secret");
        return $res;
    }

    public function listResources($appId, $options = [])
    {
        return $this->acl->getResources($options, $appId);
    }

    public function createResource($appId, $options = [])
    {
        return $this->acl->createResource($options, $appId);
    }

    /**
     * @param string $code
     */
    public function updateResource($appId, $code, $options = [])
    {
        $options['namespace'] = $appId;
        return $this->acl->updateResource($code, $options);
    }

    /**
     * @param string $code
     * @param string $namespaceCode
     */
    public function deleteResource($appId, $code)
    {
        return $this->acl->deleteResource($code, $appId);
    }

    public function getAccessPolicies($appId, $options = [])
    {
        $options['appId'] = $appId;
        return $this->acl->getAccessPolicies($options);
    }

    public function enableAccessPolicy($appId, $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->enableAccessPolicy($options);
    }

    public function disableAccessPolicy($appId, $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->disableAccessPolicy($options);
    }

    public function deleteAccessPolicy($appId, $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->deleteAccessPolicy($options);
    }

    public function allowAccess($appId, $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->allowAccess($options);
    }

    public function denyAccess($appId, $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->denyAccess($options);
    }

    public function updateDefaultAccessPolicy($appId, $defaultStrategy)
    {
        $options = [
            'appId' => $appId,
            'defaultStrategy' => $defaultStrategy
        ];
        return $this->acl->updateDefaultAccessPolicy($options);
    }

    public function createRole($appId, $options = [])
    {
        return $this->roles->create($options['code'], $options['description'], $appId);
    }

    public function findRole($appId, $code)
    {
        return $this->roles->detail($code, $appId);
    }

    public function updateRole($appId, $options = [])
    {
        $options['namespace'] = $appId;
        return $this->roles->update($options['code'], $options);
    }

    public function deleteRole($appId, $code)
    {
        return $this->roles->delete($code, $appId);
    }

    public function getRoles($appId, $options = [])
    {
        return $this->roles->paginate($options, $appId);
    }

    public function getUsersByRoleCode($appId, $code)
    {
        return $this->roles->listUsers($code, $appId);
    }

    public function addUsersToRole($appId, $code, $userIds)
    {
        return $this->roles->addUsers($code, $userIds, $appId);
    }

    public function removeUsersFromRole($appId, $code, $userIds)
    {
        return $this->roles->removeUsers($code, $userIds, $appId);
    }

    public function listAuthorizedResourcesByRole($appId, $code, $resourceType = null)
    {
        return $this->roles->listAuthorizedResources($code, $resourceType, $appId);
    }

    /**
     * @param string $appId
     */
    public function listAgreement($appId)
    {
        $args = func_get_args();
        return $this->agreements->list(...$args);
    }

    /**
     * @param string $appId
     */
    public function createAgreement($appId, $options)
    {
        $args = func_get_args();
        return $this->agreements->create(...$args);
    }

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function deleteAgreement($appId, $agreementId)
    {
        $args = func_get_args();
        return $this->agreements->delete(...$args);
    }

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function modifyAgreement($appId, $agreementId, $updates)
    {
        $args = func_get_args();
        return $this->agreements->modify(...$args);
    }

    /**
     * @param string $appId
     */
    public function sortAgreement($appId, $order)
    {
        $args = func_get_args();
        return $this->agreements->sort(...$args);
    }
}
