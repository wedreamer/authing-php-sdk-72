<?php
declare(strict_types=1);

require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;


// 初始化资源与权限客户端
// 通过用户池 id 与 用户池密码进行初始化
// 通过回调函数进行初始化
// $management = new ManagementClient("5f819ffdaaf252c4df2c9266", "06eca4ed85c807db9fc6a9d5483a4dc7");
$management = new ManagementClient(function ($options) {
    $options->userPoolId = '5f819ffdaaf252c4df2c9266';
    $options->secret = '06eca4ed85c807db9fc6a9d5483a4dc7';
});

$aclManagement = $management->acls();

// 创建权限分组
// AclManagementClient->createNamespace(string $code, string $name, string $description = null)
// $res = $aclManagement->createNamespace('mycode', 'codename', 'ok');

// "{"userPoolId":"5f819ffdaaf252c4df2c9266","name":"codename","code":"mycode","description":"ok","status":1,"applicationId":null,"id":32638}"

// 获取权限分组列表
// AclManagementClient->listNamespaces(int $page = 1, int $limit = 10)
// $res = $aclManagement->listNamespaces(1, 10);

// {"total":0,"list":[]}


// 更新权限分组
// AclManagementClient->updateNamespace(string $code, array $updates)
// $res = $aclManagement->updateNamespace('mycode', [
//     'name' => 'new codename',
// ]);

// 删除权限分组
// AclManagementClient->deleteNamespace(string $code)
// $res = $aclManagement->deleteNamespace('mycode');

// 获取资源列表
// AclManagementClient->getResources(array $options = [])
// $res = $aclManagement->getResources([
//     'namespace' => 'mycode',
//     'type' => 'DATA',
// ]);

// {"list":[{"id":"60a80d980ad35323242fcd8b","createdAt":"2021-05-21T19:44:24.272Z","updatedAt":"2021-05-21T19:44:24.272Z","userPoolId":"5f819ffdaaf252c4df2c9266","code":"5584","actions":[],"type":"DATA","description":"\u8fd9\u662f\u6839\u7ec4\u7ec7","namespaceId":32638,"apiIdentifier":null,"namespace":"mycode"}],"totalCount":1}

// 创建资源
// AclManagementClient->createResource(array $options)
// $res = $aclManagement->createResource([
//     'code' => 'createResource',
//     'actions' => [
//         (object)[
//             'name' => 'this is name',
//             'description' => 'this is description'
//         ]
//     ],
//     'namespace' => 'mycode'
// ]);

// {"userPoolId":"5f819ffdaaf252c4df2c9266","code":"createResource","actions":[{"name":"this is name","description":"this is description"}],"namespaceId":32638,"createdAt":"2021-05-21T19:51:19.395Z","updatedAt":"2021-05-21T19:51:19.395Z","id":"60a80f37f4d83bc683c7f932","type":null,"description":null,"apiIdentifier":null}

// 更新资源
// AclManagementClient->updateResource(string $code, array $options)
// $res = $aclManagement->updateResource('createResource', [
//     'description' => '新的描述',
//     'type' => 'DATA',
//     'actions' => [
//         (object)[
//             'name' => 'write',
//             'description' => 'new description'
//         ],
//         (object)[
//             'name' => 'read',
//             'description' => 'new description1'
//         ],
//     ],
//     'namespace' => 'mycode'
// ]);

// {"id":"60a80f37f4d83bc683c7f932","createdAt":"2021-05-21T19:51:19.395Z","updatedAt":"2021-05-21T19:53:14.921Z","userPoolId":"5f819ffdaaf252c4df2c9266","code":"createResource","actions":[{"name":"write","description":"new description"},{"name":"read","description":"new description1"}],"type":"DATA","description":"\u65b0\u7684\u63cf\u8ff0","namespaceId":32638,"apiIdentifier":null}

// 删除资源
// AclManagementClient->deleteResource(string $code, string $namespace)
// $res = $aclManagement->deleteResource('createResource', 'mycode');

// true

// 允许某个用户对某个资源进行某个操作
// AclManagementClient->allow(string $userId, string $resource, string $action)
// $res = $aclManagement->allow("608bd543d56f1f0def27c228", "DATA:60a80d980ad35323242fcd8b", "5584:read");

// {"message":"\u6388\u6743\u6210\u529f\uff01","code":200}

// 判断某个用户是否对某个资源有某个操作权限
// AclManagementClient->isAllowed(string $userId, string $resource, string $action, array $options = [])
// $res = $aclManagement->isAllowed("608bd543d56f1f0def27c228", "DATA:60a80d980ad35323242fcd8b", "5584:read", [
//     'namespace' => 'mycode'
// ]);

// null


// 获取用户被授权的所有资源列表
// UsersManagementClient->listAuthorizedResources(string $userId, string $namespace, string $resourceType = null)
// use Authing\Types\ResourceType;

// $userManagementClient = $management->users();

// $res = $userManagementClient->listAuthorizedResources('60754ba9ab2e824c8e47f08c', 'mycode',ResourceType::DATA);

// {"list":[{"code":"5584:*","type":"DATA","actions":["*"]}],"totalCount":1}



// 获取角色被授权的所有资源列表
// RolesManagementClient->listAuthorizedResources(string $roleCode, string $namespace, string $resourceType = null)
// use Authing\Types\ResourceType;

// $rolesManagementClient = $management->roles();

// $res = $rolesManagementClient->listAuthorizedResources('juese_code', 'mycode', ResourceType::DATA);

// {"list":[{"code":"5584:*","type":"DATA","actions":["*"]}],"totalCount":1}

// 获取分组被授权的所有资源列表
// GroupsManagementClient->listAuthorizedResources(string $groupCode, string $namespace, string $resourceType = null)
// use Authing\Types\ResourceType;

// $groupsManagementClient = $management->groups();
// $res = $groupsManagementClient->listAuthorizedResources('group_code', 'mycode', ResourceType::MENU);

// {"list":[{"code":"5584","type":"MENU","actions":null}],"totalCount":1}

// 获取部门被授权的所有资源列表
// OrgManagementClient->listAuthorizedResourcesByNodeId(string $nodeId, string $namespace, string $resourceType = null)
// use Authing\Types\ResourceType;

// $orgsManagementClient = $management->orgs();
// $res = $management->orgs()->listAuthorizedResourcesByNodeId(
//     '604ef025b441024739f5ce58',
//     'mycode',
//     ResourceType::MENU
// );

// {"list":{"list":[{"code":"5584","type":"MENU","actions":null}],"totalCount":1},"totalCount":1}

// 获取具备某些资源操作权限的主体
// AclManagementClient->getAuthorizedTargets(array $options)
use Authing\Types\ResourceType;
use Authing\Types\AuthorizedTargetsActionsInput;
use Authing\Types\Operator;
use Authing\Types\PolicyAssignmentTargetType;

$res = $aclManagement->getAuthorizedTargets(
    [
        'namespace' => 'mycode',
        'resource' => '5584',
        'resourceType' => ResourceType::MENU,
        'actions' => new AuthorizedTargetsActionsInput(Operator::OR, ['read']),
        'targetType' => PolicyAssignmentTargetType::USER
    ]
);

// {"totalCount":0,"list":[]}

echo json_encode($res);


echo '';