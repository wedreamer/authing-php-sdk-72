<?php

declare(strict_types=1);
namespace Authing\Mgmt;

use Error;
use stdClass;
use Exception;
use Authing\Types\User;
use Authing\Types\UdvParam;
use Authing\Types\UserParam;
use Authing\Types\UsersParam;
use Authing\Types\SetUdvParam;
use Authing\Types\UDFDataType;
use Authing\Types\RefreshToken;
use Authing\Types\ResourceType;
use Authing\Types\CommonMessage;
use Authing\Types\FindUserParam;
use Authing\Types\UDFTargetType;
use Authing\Types\JWTTokenStatus;
use Authing\Types\PaginatedRoles;
use Authing\Types\PaginatedUsers;
use Authing\Types\RemoveUdvParam;
use Authing\Types\AssignRoleParam;
use Authing\Types\CreateUserInput;
use Authing\Types\CreateUserParam;
use Authing\Types\DeleteUserParam;
use Authing\Types\PaginatedGroups;
use Authing\Types\RevokeRoleParam;
use Authing\Types\SearchUserParam;
use Authing\Types\UpdateUserInput;
use Authing\Types\UpdateUserParam;
use Authing\Types\UserDefinedData;
use Authing\Types\DeleteUsersParam;
use Authing\Types\SetUdvBatchParam;
use Authing\Types\GetUserRolesParam;
use Authing\Types\IsUserExistsParam;
use Authing\Types\RefreshTokenParam;
use Authing\Types\ArchivedUsersParam;
use Authing\Types\GetUserGroupsParam;
use Authing\Types\UdfValueBatchParam;
use Authing\Types\AddUserToGroupParam;
use Authing\Types\CheckLoginStatusParam;
use Authing\Types\SetUdfValueBatchParam;
use Authing\Types\PolicyAssignmentsParam;
use Authing\Types\GetUserDepartmentsParam;
use Authing\Types\RemoveUserFromGroupParam;
use Authing\Types\AddPolicyAssignmentsParam;
use Authing\Types\PaginatedPolicyAssignments;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\RemovePolicyAssignmentsParam;
use Authing\Types\ListUserAuthorizedResourcesParam;
use Authing\Types\UserDefinedDataInput;
use Authing\Types\SetUdfValueBatchInput;


class UsersManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * UsersManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * ????????????
     *
     * @param $input CreateUserInput
     * @return User
     * @throws Exception
     */
    public function create(CreateUserInput $input, array $options = [])
    {
        $keepPassword = $options['keepPassword'] ?? false;
        $input->password = $this->client->encrypt($input->password);
        $param = (new CreateUserParam($input))->withKeepPassword($keepPassword);
        return $this->client->request($param->createRequest());
    }


    /**
     * ??????????????????
     *
     * @param $userId string ?????? ID
     * @param $input UpdateUserInput
     * @return User
     * @throws Exception
     */
    public function update(string $userId, UpdateUserInput $updates)
    {
        if(isset($updates->password)) {
            $updates->password = $this->client->encrypt($updates->password);
        }
        $param = (new UpdateUserParam($updates))->withId($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * ??????????????????
     *
     * @param $userId string ?????? ID
     * @return User
     * @throws Exception
     */
    public function detail(string $userId)
    {
        $res = $this->client->httpGet("/api/v2/users/$userId");
        return $res;
    }

    /**
     * ????????????
     *
     * @param $userId string ?????? ID
     * @return CommonMessage
     * @throws Exception
     */
    public function delete(string $userId)
    {
        $param = new DeleteUserParam($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userIds string[] ?????? ID ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany(array $userIds)
    {
        $param = new DeleteUsersParam($userIds);
        return $this->client->request($param->createRequest());
    }

    /**
     * ?????? id???username???email???phone???email???externalId ????????????????????????
     *
     * @param $identifiers string[] ?????? ID ??????
     * @return User[]
     * @throws Exception
     */
    public function batch(array $identifiers, array $options = [])
    {
        $queryField = $options['queryField'] ?? 'id';
        $data = [
            'ids' => $identifiers,
            'type' => $queryField
        ];
        $users = $this->client->httpPost('/api/v2/users/batch', $data);
        return $users;
    }

    

    // /**
    //  * ???????????? ID ????????????????????????
    //  *
    //  * @param $userIds string[] ?????? ID ??????
    //  * @return User[]
    //  * @throws Exception
    //  */
    // public function batch($userIds)
    // {
    //     $param = new UserBatchParam($userIds);
    //     return $this->client->request($param->createRequest());
    // }

    

    /**
     * ??????????????????
     *
     * @param $page int ????????????
     * @param $limit int ????????????
     * @return PaginatedUsers
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10)
    {
        $param = (new UsersParam())->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }


    public function listArchivedUsers(int $page = 1, int $limit = 10)
    {
        $param = (new ArchivedUsersParam())->withLimit($limit)->withPage($page);
        $res = $this->client->request($param->createRequest());
        return $res;
    }
    

    /**
     * ???????????????????????????????????????????????????????????????????????????????????????
     *
     * @param $param IsUserExistsParam
     * @return boolean
     * @throws Exception
     */
    public function exists(IsUserExistsParam $options)
    {
        $param = $options;
        return $this->client->request($param->createRequest());
    }

    public function find(array $options)
    {
        $email = null;
        $phone = null;
        $username = null;
        $externalId = null;
        // $username, $email, $phone, $externalId
        extract($options, EXTR_OVERWRITE);
        $userParam = (new FindUserParam())->withEmail($email ?? "")->withPhone($phone ?? "")->withUsername($username ?? "")->withExternalId($externalId ?? "");
        $res = $this->client->request($userParam->createRequest());
        return $res;
    }

    /**
     * ????????????????????????
     *
     * @param $query string ?????????
     * @param $page int ????????????
     * @param $limit int ????????????
     * @return PaginatedUsers
     * @throws Exception
     */
    public function search(string $query, array $opts = [
        'page' => 1,
        'limit' => 10
    ])
    {
        $opts = (object)$opts;
        $limit = $opts->ilmit ?? 10;
        $page = $opts->page ?? 1;
        $param = (new SearchUserParam($query))->withPage($page)->withLimit($limit);
        isset($opts->departmentOpts) && $param->withDepartmentOpts($opts->departmentOpts);
        isset($opts->fields) && $param->withFields($opts->fields);
        isset($opts->groupOpts) && $param->withGroupOpts($opts->groupOpts);
        isset($opts->roleOpts) && $param->withRoleOpts($opts->roleOpts);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string ?????? ID
     * @return RefreshToken
     * @throws Exception
     */
    public function refreshToken(string $userId)
    {
        $param = (new RefreshTokenParam())->withId($userId);
        return $this->client->request($param->createRequest());
    }

    // /**
    //  * @param $token string ????????? access token
    //  * @return JWTTokenStatus
    //  * @throws Exception
    //  */
    // public function checkLoginStatus($token)
    // {
    //     $param = (new CheckLoginStatusParam())->withToken($token);
    //     return $this->client->request($param->createRequest());
    // }

    /**
     * ????????????????????????
     *
     * @param $userId string ?????? ID
     * @return PaginatedGroups
     * @throws Exception
     */
    public function listGroups(string $userId)
    {
        $param = new GetUserGroupsParam($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * ?????????????????????
     *
     * @param $userId string ?????? ID
     * @param $group string ?????? ID
     * @return CommonMessage
     * @throws Exception
     */
    public function addGroup(string $userId, string $group)
    {
        $param = (new AddUserToGroupParam([$userId]))->withCode($group);
        return $this->client->request($param->createRequest());
    }

    /**
     * ????????????
     *
     * @param $userId string ?????? ID
     * @param $group string ?????? ID
     * @return CommonMessage
     * @throws Exception
     */
    public function removeGroup(string $userId, string $group)
    {
        $param = (new RemoveUserFromGroupParam([$userId]))->withCode($group);
        return $this->client->request($param->createRequest());
    }

    /**
     * ???????????????????????????
     *
     * @param $userId
     * @return PaginatedRoles
     * @throws Exception
     */
    public function listRoles(string $userId, string $namespace = '')
    {
        $param = (new GetUserRolesParam($userId))->withNamespace($namespace);
        return $this->client->request($param->createRequest())->roles;
    }

    /**
     * @param $userId string ?????? ID
     * @param $roles string[] ?????? code ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function addRoles(string $userId, array $roles,string $namespace = '')
    {
        $param = (new AssignRoleParam())->withUserIds([$userId])->withRoleCodes($roles)->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string ?????? ID
     * @param $roles string[] ?????? code ??????
     * @return CommonMessage
     * @throws Exception
     */
    public function removeRoles(string $userId, array $roles, string $namespace = '')
    {
        $param = (new RevokeRoleParam())->withUserIds([$userId])->withRoleCodes($roles)->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    public function listOrgs(string $userId)
    {
        $res = $this->client->httpGet('/api/v2/users/' . $userId . '/orgs');
        return $res;
    }

    public function listDepartment(string $userId)
    {
        $param = (new GetUserDepartmentsParam($userId));
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function listAuthorizedResources(string $userId, string $namespace, string $resourceType = '')
    {
        $param = (new ListUserAuthorizedResourcesParam($userId))->withNamespace($namespace);
        $resourceType && $param->withResourceType($resourceType);
        $resUser = $this->client->request($param->createRequest());
        if ($resUser) {
            $res = Utils::formatAuthorizedResources($resUser->authorizedResources);
            return $res;
        } else {
            throw new Exception("???????????????");
        }
    }

    public function getUdfValue(string $userId)
    {
        $param = new UdvParam('USER', $userId);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function getUdfValueBatch(array $userIds)
    {
        if (!isset($userIds) && !is_array($userIds)) {
            throw new Error("userId ????????? ????????????");
        }
        $param = new UdfValueBatchParam(UDFTargetType::USER, $userIds);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function setUdfValue(string $userId, array $data)
    {
        if (count($data) === 0) {
            throw new Error('empty udf value list');
        }
        $input = [];
        foreach ($data as $key => $value) {
            $input [] = (object)[
                'key' => $key,
                'value' => json_encode($value)
            ];
        }
        array_map(function ($item) {
            return (new UserDefinedDataInput($item->key))->withValue($item->value);
        }, $input);
        $param = (new SetUdvBatchParam(UDFTargetType::USER, $userId))->withUdvList($input);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function setUdfValueBatch(array $input)
    {
        if (!isset($input) && !is_array($input)) {
            throw new Error("userId ????????? ????????????");
        }
        $att = [];
        foreach ($input as $index => $val) {
            foreach ($val['data'] as $_key => $_val) {
                $_ = new SetUdfValueBatchInput($val['userId'], $_key, json_encode($_val));
                $att [] = $_;
            }
        }
        $param = new SetUdfValueBatchParam(UdfTargetType::USER, $att);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function removeUdfValue(string $userId, string $key)
    {
        $param = new RemoveUdvParam(UdfTargetType::USER, $userId, $key);
        $res = $this->client->request($param->createRequest());
        return true;
    }

    public function hasRole(string $userId, string $roleCode, string $namespace = '')
    {
        $roleList = $this->listRoles($userId, $namespace);
        if ($roleList->totalCount < 1) {
            return false;
        }
        $hasRole = false;
        $list = $roleList->list;
        foreach ($list as $val) {
            if ($val->code === $roleCode) {
                $hasRole = true;
            }
        }
        return $hasRole;
    }


    public function kick(array $userIds)
    {
        $data = [
            'userIds' => $userIds
        ];
        $this->client->httpPost('/api/v2/users/kick', $data);
        $_ = new stdClass();
        $_->code = 200;
        $_->message = '??????????????????';
        return $_;
    }

    public function listUserActions(array $options = [
        'page' =>  1,
        'limit' =>  10,
    ])
    {
        $api = '/api/v2/analysis/user-action';
        $param = http_build_query([
            'page' => $options['page'] ?? 1,
            'limit' => $options['limit'] ?? 10,
            'clientip' => $options['clientip'] ?? null,
            'operation_name' => $options['operationName'] ?? null,
            'operator_arn' => $options['operatoArn'] ?? null,
        ]);
        $data = $this->client->httpGet($api . '?'.$param);
        return $data;
    }

    // node js ????????????????????????
    // /**
    //  * @param $userId string  ?????? ID
    //  * @param $page int ????????????
    //  * @param $limit int ????????????
    //  * @return PaginatedPolicyAssignments
    //  * @throws Exception
    //  */
    // public function listPolicies($userId, $page = 1, $limit = 10)
    // {
    //     $param = (new PolicyAssignmentsParam())
    //         ->withPage($page)
    //         ->withLimit($limit)
    //         ->withTargetIdentifier($userId)
    //         // php don't have enum
    //         ->withTargetType(PolicyAssignmentTargetType::USER);
    //     return $this->client->request($param->createRequest());
    // }

    // /**
    //  * @param $userId string ?????? ID
    //  * @param $policies string[] ?????? code ??????
    //  * @return CommonMessage
    //  * @throws Exception
    //  */
    // public function addPolicies($userId, $policies)
    // {
    //     $param = (new AddPolicyAssignmentsParam($policies, PolicyAssignmentTargetType::USER))->withTargetIdentifiers([$userId]);
    //     return $this->client->request($param->createRequest());
    // }

    // /**
    //  * @param $userId string ?????? ID
    //  * @param $policies string[] ?????? code ??????
    //  * @return CommonMessage
    //  * @throws Exception
    //  */
    // public function removePolicies($userId, $policies)
    // {
    //     $param = (new RemovePolicyAssignmentsParam($policies, PolicyAssignmentTargetType::USER))->withTargetIdentifiers([$userId]);
    //     return $this->client->request($param->createRequest());
    // }

    // /**
    //  * ???????????????????????????????????????
    //  *
    //  * @param $userId
    //  * @return UserDefinedData[]
    //  * @throws Exception
    //  */
    // public function listUdv($userId)
    // {
    //     $param = new UdvParam(UDFTargetType::USER, $userId);
    //     return $this->client->request($param->createRequest());
    // }

    // /**
    //  * ???????????????????????????
    //  *
    //  * @param $userId string ?????? ID
    //  * @param $key string ?????? key
    //  * @param $value string ?????? value
    //  * @return UserDefinedData
    //  * @throws Exception
    //  */
    // public function setUdv($userId, $key, $value)
    // {
    //     $param = new SetUdvParam(UDFTargetType::USER, $userId, $key, $value);
    //     return $this->client->request($param->createRequest());
    // }

    // /**
    //  * ???????????????????????????
    //  *
    //  * @param $userId string ?????? ID
    //  * @param $key string ?????? key
    //  * @return UserDefinedData
    //  * @throws Exception
    //  */
    // public function removeUdv($userId, $key)
    // {
    //     $param = new RemoveUdvParam(UDFTargetType::USER, $userId, $key);
    //     return $this->client->request($param->createRequest());
    // }

}
