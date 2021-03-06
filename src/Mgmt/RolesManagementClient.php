<?php

declare(strict_types=1);
namespace Authing\Mgmt;

use Error;
use stdClass;
use Exception;
use Authing\Types\Role;
use Authing\Types\UdvParam;
use Authing\Types\RoleParam;
use Authing\Types\RolesParam;
use Authing\Types\UDFDataType;
use Authing\Types\CommonMessage;
use Authing\Types\UDFTargetType;
use Authing\Types\PaginatedRoles;
use Authing\Types\PaginatedUsers;
use Authing\Types\RemoveUdvParam;
use Authing\Types\AssignRoleParam;
use Authing\Types\CreateRoleParam;
use Authing\Types\DeleteRoleParam;
use Authing\Types\RevokeRoleParam;
use Authing\Types\UpdateRoleParam;
use Authing\Types\DeleteRolesParam;
use Authing\Types\SetUdvBatchParam;
use Authing\Types\RoleWithUsersParam;
use Authing\Types\UdfValueBatchParam;
use Authing\Types\SetUdfValueBatchInput;
use Authing\Types\SetUdfValueBatchParam;
use Authing\Types\PolicyAssignmentsParam;
use Authing\Types\AddPolicyAssignmentsParam;
use Authing\Types\PaginatedPolicyAssignments;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\RemovePolicyAssignmentsParam;
use Authing\Types\ListRoleAuthorizedResourcesParam;
use Authing\Types\UserDefinedDataInput;


use function PHPUnit\Framework\isEmpty;

function convertUdv(array $data)
{
    foreach ($data as $item) {
        $dataType = $item->dataType;
        $value = $item->value;
        if ($dataType === UDFDataType::NUMBER) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::BOOLEAN) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::DATETIME) {
            // set data time
            // $item->value = intval($value);
        } else if ($dataType === UDFDataType::OBJECT) {
            $item->value = json_encode($value);
        }
    }
    return $data;
}

function convertUdvToKeyValuePair(array $data)
{
    foreach ($data as $item) {
        $item = (object)$item;
        $dataType = $item->dataType;
        $value = $item->value;
        if ($dataType === UDFDataType::NUMBER) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::BOOLEAN) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::DATETIME) {
            // set data time
            // $item->value = intval($value);
        } else if ($dataType === UDFDataType::OBJECT) {
            $item->value = json_encode($value);
        }
    }

    $ret = new stdClass();
    foreach ($data as $item) {
        $item = (object)$item;
        $key = $item->key;
        $ret->$key = $item->value;
    }
    return $ret;
}

class RolesManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * RolesManagementClient constructor.
     * @param ManagementClient $client
     */
    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
    }

    /**
     * ????????????
     *
     * @param $code string ??????????????????
     * @param $description string ????????????
     * @param $parentCode string ?????????????????????
     * @return Role
     * @throws Exception
     */
    public function create(string $code, string $description = '', string $namespace = '')
    {
        $param = (new CreateRoleParam($code));
        $description && $param->withDescription($description);
        $namespace && $param->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ????????????
     *
     * @param $code string ???????????? ID
     * @return CommonMessage
     * @throws Exception
     */
    public function delete(string $code, string $namespace = null)
    {
        $param = new DeleteRoleParam($code);
        $namespace && $param->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $codeList string[] ???????????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany(array $codeList, string $namespace = null)
    {
        $param = (new DeleteRolesParam($codeList));
        $namespace && $param->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $code string ???????????? ID
     * @param $description string ????????????
     * @param $newCode string ?????????????????? ID
     * @return Role
     * @throws Exception
     */
    public function update(string $code, array $input)
    {
        $param = (new UpdateRoleParam($code));
        isset($input['description']) && $param->withDescription($input['description']);
        isset($input['newCode']) && $param->withNewCode($input['newCode']);
        isset($input['namespace']) && $param->withNamespace($input['namespace']);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $code string ??????????????????
     * @return Role
     * @throws Exception
     */
    public function detail(string $code, string $namespace = null)
    {
        $param = new RoleParam($code);
        $namespace && $param->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param string $namespace
     */
    public function findByCode(string $code, string $namespace = null)
    {
        $param = (new RoleParam($code))->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $page int ????????????
     * @param $limit int ????????????
     * @return PaginatedRoles
     * @throws Exception
     */
    public function paginate(array $options = [])
    {
        $page = $options['page'] ?? 1;
        $limit = $options['limit'] ?? 10;
        $namespace = $options['namespace'] ?? null;
        $param = (new RolesParam())->withPage($page)->withLimit($limit);
        $namespace && $param->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $code string ??????????????????
     * @return PaginatedUsers
     * @throws Exception
     */
    public function listUsers(string $code, array $options = [])
    {
        extract($options);
        $param = (new RoleWithUsersParam($code))->withNamespace($namespace ?? '');
        $users = ($this->client->request($param->createRequest()))->users;
        return $users;
    }

    /**
     * ??????????????????
     *
     * @param $code string ???????????? ID
     * @param $userIds string[] ?????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function addUsers(string $code, array $userIds, string $namespace = '')
    {
        $param = (new AssignRoleParam())->withUserIds($userIds)->withRoleCodes([$code])->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $code string ???????????? ID
     * @param $userIds string[] ?????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function removeUsers(string $code, array $userIds, string $namespace = '')
    {
        $param = (new RevokeRoleParam())->withNamespace($namespace)->withUserIds($userIds)->withRoleCodes([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $code string ???????????? ID
     * @param $page int ????????????
     * @param $limit int ????????????
     * @return PaginatedPolicyAssignments
     * @throws Exception
     */
    public function listPolicies(string $code, int $page = 1, int $limit = 10)
    {
        $param = (new PolicyAssignmentsParam())
            ->withPage($page)
            ->withLimit($limit)
            ->withTargetIdentifier($code)
            ->withTargetType(PolicyAssignmentTargetType::ROLE);
        return $this->client->request($param->createRequest());
    }

    /**
     * ????????????
     *
     * @param $code string ???????????? ID
     * @param $policies string[] ?????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function addPolicies(string $code, array $policies)
    {
        $param = (new AddPolicyAssignmentsParam($policies, PolicyAssignmentTargetType::ROLE))
            ->withTargetIdentifiers([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * ????????????
     *
     * @param $code string ???????????? ID
     * @param $policies string[] ?????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function removePolicies(string $code, array $policies)
    {
        $param = (new RemovePolicyAssignmentsParam($policies, PolicyAssignmentTargetType::ROLE))
            ->withTargetIdentifiers([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????????????????????????????
     * @param $roleCode
     * @param null $resourceType
     * @return stdClass
     * @throws Exception
     */
    public function listAuthorizedResources(string $roleCode, string $namespace, string $resourceType = '')
    {
        $param = (new ListRoleAuthorizedResourcesParam($roleCode))->withNamespace($namespace);

        if ($resourceType !== null) {
            $param->withResourceType($resourceType);
        }

        $data = $this->client->request($param->createRequest());

        return Utils::formatAuthorizedResources($data->authorizedResources);
    }

    public function getUdfValue(string $roleId)
    {
        $param = (new UdvParam('ROLE', $roleId));
        $data = $this->client->request($param->createRequest());
        $list = $data ? $data->udv: $data;
        if (empty($list)) {
            return $list;
        } else {
            return convertUdvToKeyValuePair($list);
        }
    }

    
    public function getSpecificUdfValue(string $roleId, string $udfKey)
    {
        $param = new UdvParam(UDFTargetType::ROLE, $roleId);
        $data = $this->client->request($param->createRequest());

        $udfMap = convertUdvToKeyValuePair($data);
        $udfValue = new stdClass();

        foreach ($udfMap as $key => $value) {
            if ($udfKey === $key) {
                $udfValue->$key = $value;
            }
        }

        return $udfValue;
    }

    public function getUdfValueBatch(array $roleIds)
    {
        if (count($roleIds) === 0) {
            throw new Error('empty user id list');
        }

        $param = new UdfValueBatchParam(UDFTargetType::ROLE, $roleIds);
        $data = $this->client->request($param->createRequest());

        $ret = (object)[];
        foreach ($data as $value) {
            $targetId = $value->targetId;
            $_data = $value->data;
            $ret->$targetId = Utils::convertUdvToKeyValuePair($_data);
        }

        return $ret;
    }

    public function setUdfValue(string $roleId, array $data)
    {
        if (count($data) === 0) {
            throw new Error('empty udf value list');
        }

        $input = [];

        foreach ($data as $key => $value) {
            $input [] = (new UserDefinedDataInput($key))->withValue($value);
        }

        $param = (new SetUdvBatchParam(UDFTargetType::ROLE, $roleId))->withUdvList($input);
        return $this->client->request($param->createRequest());
    }

    public function setUdfValueBatch(array $input)
    {
        if (count($input) === 0) {
            throw new Error('empty input list');
        }
        $params = [];
        foreach ($input as $item) {
            $userId = $item->roleId;
            $data = $item->data;
            foreach ($data as $key => $value) {
                $param = new SetUdfValueBatchInput($userId, $key, json_encode($value));
                $params[] = $param;
            }
        }
        $param = new SetUdfValueBatchParam(UDFTargetType::ROLE, $params);
        return $this->client->request($param->createRequest());
    }

    public function removeUdfValue(string $roleId, string $key)
    {
        $param = new RemoveUdvParam(UDFTargetType::ROLE, $roleId, $key);
        $this->client->request($param->createRequest());
        return true;
    }
}
