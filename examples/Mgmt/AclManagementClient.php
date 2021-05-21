<?php
declare(strict_types=1);

use Authing\Mgmt\ManagementClient;


// 初始化资源与权限客户端
// 通过用户池 id 与 用户池密码进行初始化
// $management = new ManagementClient("5f819ffdaaf252c4df2c9266", "06eca4ed85c807db9fc6a9d5483a4dc7");
// 通过回调函数进行初始化
$management = new ManagementClient(function ($options) {
    $options->userPoolId = '5f819ffdaaf252c4df2c9266';
    $options->secret = '06eca4ed85c807db9fc6a9d5483a4dc7';
});

$aclManagement = $management->acls();

// 创建权限分组
// AclManagementClient->createNamespace(string $code, string $name, string $description = null)
// $aclManagement->createNamespace();

// 获取权限分组列表
// AclManagementClient->listNamespaces(int $page = 1, int $limit = 10)
// $aclManagement->listNamespace(1, 10);

// 更新权限分组
// AclManagementClient->updateNamespace(string $code, array $updates)
// $aclManagement->updateNamespace('testNamesapce', [
//     'name' => 'A New Name',
// ]);

// 删除权限分组
// AclManagementClient->deleteNamespace(string $code)
// $aclManagement->deleteNamespace('testNamesapce');

// 获取资源列表
// AclManagementClient->getResources(array $options = [])
// $res = $aclManageClient->getResources([
//     'namespaceCode' => 'namespace',
//     'type' => 'DATA',
// ]);

// 创建资源
// AclManagementClient->createResource(array $options)
// $res = $aclManageClient->createResource([
//     'code' => 'code',
//     'actions' => [
//         (object)[
//             'name' => 'name',
//             'description' => 'description'
//         ]
//     ],
//     'namespace' => 'namespace'
// ]);

// 更新资源
// AclManagementClient->updateResource(string $code, array $options)
// $res = $aclManageClient->updateResource('code', [
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
//     'namespace' => 'namespace'
// ]);

// 删除资源
// AclManagementClient->deleteResource(string $code, string $namespace)
// $res = $aclManageClient->deleteResource('code1', '5f88506c705dc7fa80e5f39e');

// 允许某个用户对某个资源进行某个操作
// AclManagementClient->allow(string $userId, string $resource, string $action)
// $managementClient->acl()->allow("resource", "action", "user id");

// 判断某个用户是否对某个资源有某个操作权限
// AclManagementClient->isAllowed(string $userId, string $resource, string $action, array $options = [])
// $managementClient->acl()->isAllowed("user id", "action", "resource");

// 获取用户被授权的所有资源列表
// UsersManagementClient->listAuthorizedResources(string $userId, string $namespace, string $resourceType = null)
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\UsersManagementClient;
// use Authing\Types\ResourceType;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $userManagementClient = $managementClient->users;

// $data = $userManagementClient->listAuthorizedResources('userId', ResourceType::DATA);

// 获取角色被授权的所有资源列表
// RolesManagementClient->listAuthorizedResources(string $roleCode, string $namespace, string $resourceType = null)
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\ManagementClient;
// use Authing\Types\ResourceType;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $rolesManagementClient = new RolesManagementClient($managementClient);

// $data = $rolesManagementClient->listAuthorizedResources('roleCode', ResourceType::DATA);

// 获取分组被授权的所有资源列表
// GroupsManagementClient->listAuthorizedResources(string $groupCode, string $namespace, string $resourceType = null)
// use Authing\Mgmt\GroupsManagementClient;
// use Authing\Mgmt\ManagementClient;
// use Authing\Types\ResourceType;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $groupsManagementClient = $managementClient->groups();
// $data = $groupsManagementClient->listAuthorizedResources('groupCode', 'namespace', ResourceType::MENU);

// 获取部门被授权的所有资源列表
// OrgManagementClient->listAuthorizedResourcesByNodeId(string $nodeId, string $namespace, string $resourceType = null)
// use Authing\Types\ResourceType;

// $managementClient->orgs()->listAuthorizedResourcesByNodeId(
//     'NODE_ID',
//     'NAMESPACE_CODE',
//     ResourceType::MENU
// );

// 获取具备某些资源操作权限的主体
// AclManagementClient->getAuthorizedTargets(array $options)
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\AclManagementClient;
// use Authing\Types\PolicyAssignmentTargetType;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $aclManagementClient = $managementClient->acls();

// $data = $aclManagementClient->getAuthorizedTargets(
//     [
//         'namespace' => '6063f88dabb536e9a23a6c80',
//         'resource' => 'book',
//         'resourceType' => 'DATA',
//         'actions' => (object)[
//             'op' => 'OR',
//             'list' => ['write', 'read']
//         ],
//         'targetType' => 'USER'
//     ]
// );
