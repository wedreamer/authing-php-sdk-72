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

    public function list(array $params = [])
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

    public function create(array $options)
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

    public function listResources(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        // $args = func_get_args();
        return $this->acl->getResources($options);
    }

    public function createResource(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        // $args = func_get_args();
        return $this->acl->createResource($options);
    }

    /**
     * @param string $code
     */
    public function updateResource(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        // $args = func_get_args();
        return $this->acl->updateResource($options['code'], $options);
    }

    /**
     * @param string $code
     * @param string $namespaceCode
     */
    public function deleteResource(string $appId, string $code)
    {
        // $args = func_get_args();
        return $this->acl->deleteResource($code, $appId);
    }

    public function getAccessPolicies(string $appId, array $options = [])
    {
        $options['appId'] = $appId;
        return $this->acl->getAccessPolicies($options);
    }

    public function enableAccessPolicy(string $appId, array $options = [])
    {
        // $args = func_get_args();
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->enableAccessPolicy($options);
    }

    public function disableAccessPolicy(string $appId,array $options = [])
    {
        // $args = func_get_args();
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->disableAccessPolicy($options);
    }

    public function deleteAccessPolicy(string $appId, array $options = [])
    {
        // $args = func_get_args();
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->deleteAccessPolicy($options);
    }

    public function allowAccess(string $appId, array $options = [])
    {
        // $args = func_get_args();
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->allowAccess($options);
    }

    public function denyAccess(string $appId, array $options = [])
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->denyAccess($options);
    }

    public function updateDefaultAccessPolicy(string $appId, string $defaultStrategy)
    {
        // $args = func_get_args();
        return $this->acl->updateDefaultAccessPolicy([
            'appId' => $appId,
            'defaultStrategy' => $defaultStrategy
        ]);
    }

    public function createRole(string $appId, array $options = [])
    {
        // $args = func_get_args();
        return $this->roles->create($options['code'], $options['description'], $appId);
    }

    public function findRole($code)
    {
        $args = func_get_args();
        return $this->roles->detail(...$args);
    }

    public function updateRole(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        $code = $options['code'];
        return $this->roles->update($code, $options);
    }

    public function deleteRole($code)
    {
        $args = func_get_args();
        return $this->roles->delete(...$args);
    }

    public function getRoles($page = 1, $limit = 10)
    {
        $args = func_get_args();
        return $this->roles->paginate(...$args);
    }

    public function getUsersByRoleCode($code)
    {
        $args = func_get_args();
        return $this->roles->listUsers(...$args);
    }

    public function addUsersToRole($code, $userIds)
    {
        $args = func_get_args();
        return $this->roles->addUsers(...$args);
    }

    public function removeUsersFromRole($code, $userIds)
    {
        $args = func_get_args();
        return $this->roles->removeUsers(...$args);
    }

    public function listAuthorizedResourcesByRole($roleCode, $namespace, $opts = [])
    {
        $args = func_get_args();
        return $this->roles->listAuthorizedResources(...$args);
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
    public function createAgreement($appId, array $agreement)
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
    public function modifyAgreement($appId, $agreementId, array $updates)
    {
        $args = func_get_args();
        return $this->agreements->modify(...$args);
    }

    /**
     * @param string $appId
     */
    public function sortAgreement($appId, array $order)
    {
         $args = func_get_args();
        return $this->agreements->sort(...$args);
    }
}
