<?php

declare(strict_types=1);
use Authing\Mgmt\ManagementClient;

$managementClient = new ManagementClient('userPoolId', 'secret');
$applicationsClient = $managementClient->applications();
$list = $applicationsClient->list(['page' => 2, 'limit' => 10]); // 获取应用列表

$app = $applicationsClient->findById('5f97fb40d352ecf69ffe6d98'); // 通过 id 查找应用

// 创建应用
// ApplicationsManagementClient->create(array $params)
// $res = $appManageClient->create([
//     'name' => 'testname',
//     'identifier' =>  ' only one ',
//     'redirectUris' => 'http://authing.cn',
//     'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
// ]);

// 删除应用
// ApplicationsManagementClient->delete(string $appId)
// $res = $appManageClient->delete('606dd67c164539e1c90f4d83');

// 获取应用列表
// ApplicationsManagementClient->list(array $params = [ 'page' => 1, 'limit' => 10 ]) 
// $managementClient = new ManagementClient('userPoolId', 'secret');

// // 获取应用管理器
// $applications = $managementClient->applications();

// $list = $applications->list(['page' => 2, 'limit' => 10]);


// 获取应用详情
// ApplicationsManagementClient->findById(string $id)
// // 获取应用管理器
// $_client = new ManagementClient('userPoolId', 'secret');
// $_client->requestToken();

// $applications = $_client->applications();

// $app = $applications->findById('5f97fb40d352ecf69ffe6d98');
// // 通过 code 是否为 200 判断操作是否成功


// 获取资源列表
// ApplicationsManagementClient->listResources(string $appId, array $options = [])
// $client = new ManagementClient('userPoolId', 'userPoolSecret');
// $client->requestToken();
// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->listResources(APP_ID, [
//     'type' => 'DATA',
//     'page' => 1,
//     'type' => 10,
// ]);

// 创建资源
// ApplicationsManagementClient->createResource(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');
// $client->requestToken();
// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->createResource(APP_ID, [
//     'code' => 'codeNames',
//     'type' => 'API',
//     'actions' => [
//         (object)[
//             'name' => 'codeNames:actionName',
//             'description' => 'actionDescription'
//         ]
//     ],
//     'description' => 'description',
//     'apiIdentifier' => 'http://xxx.com'
// ]);

// 更新资源
// ApplicationsManagementClient->updateResource(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->updateResource(APP_ID, [
//     'type' => 'API',
//     'code' => 'RESOURCE_CODE',
//     'actions' => [
//         (object)[
//             'name' => 'codeNames:actionName',
//             'description' => 'actionDescription'
//         ],
//         (object)[
//             'name' => 'codeNames:actionName',
//             'description' => 'actionDescription'
//         ]
//     ],
//     'description' => '新的描述',
//     'apiIdentifier' => 'http://xxx.com'
// ]);

// 删除资源
// ApplicationsManagementClient->deleteResource(string $appId, string $code)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->deleteResource(APP_ID, 'code');


// 获取应用访问控制策略
// ApplicationsManagementClient->getAccessPolicies(string $appId, array $options = [])
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->getAccessPolicies(APP_ID, [
//     'page' => 1,
//     'limit' => 10
// ]);

// 启用应用访问控制策略
// ApplicationsManagementClient->enableAccessPolicy(string $appId, array $options = [])
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->enableAccessPolicy(APP_ID, [
//     'targetType' => 'ROLE',
//     'targetIdentifiers' => [ROLE_ID],
//     'inheritByChildren' => null
// ]);

// 停用应用访问控制策略
// ApplicationsManagementClient->disableAccessPolicy(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->disableAccessPolicy(APP_ID, [
//     'targetType' => 'ROLE',
//     'targetIdentifiers' => [ROLE_ID],
//     'inheritByChildren' => null
// ]);


// 删除应用访问控制策略
// ApplicationsManagementClient->deleteAccessPolicy(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->deleteAccessPolicy(APP_ID, [
//     'targetType' => 'ROLE',
//     'targetIdentifiers' => [ROLE_ID],
//     'inheritByChildren' => null
// ]);


// 配置「允许主体（用户、角色、分组、组织机构节点）访问应用」的控制策略
// ApplicationsManagementClient->allowAccess(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->allowAccess(APP_ID, [
//     'targetType' => 'ROLE',
//     'targetIdentifiers' => [ROLE_ID],
//     'inheritByChildren' => null
// ]);

// 配置「拒绝主体（用户、角色、分组、组织机构节点）访问应用」的控制策略
// ApplicationsManagementClient->denyAccess(string $appId, array $options)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->denyAccess(APP_ID, [
//     'targetType' => 'ROLE',
//     'targetIdentifiers' => [ROLE_ID],
//     'inheritByChildren' => null
// ]);

// 更改默认应用访问策略（默认拒绝所有用户访问应用、默认允许所有用户访问应用）
// ApplicationsManagementClient->updateDefaultAccessPolicy(string $appId, string $defaultStrategy)
// $client = new ManagementClient('userPoolId', 'userPoolSecret');

// $applicationsManagementClient = $client->applications();
// $res = $applicationsManagementClient->updateDefaultAccessPolicy(APP_ID, 'DENY_ALL');


// 在应用下创建角色
// ApplicationsManagementClient->createRole(string $appId, array $options)
// $appManageClient->createRole(APP_ID, [
//   'code' => 'CODE',
//   'description' => 'DESCRIPTION',
// ]);

// 删除应用下的角色
// ApplicationsManagementClient->deleteRole(string $appId, string $code)
// $appManageClient->deleteRole(APP_ID, 'rolea');

// 修改应用下的角色
// ApplicationsManagementClient->updateRole(string $appId, array $options = [])
// $appManageClient->updateRole(APP_ID, ['newCode' => 'newcode']);

// 获取应用下的角色详情
// ApplicationsManagementClient->findRole(string $appId, string $code)
// $appManageClient->findRole(APP_ID, CODE);

// 获取应用下的角色列表
// ApplicationsManagementClient->getRoles(string $appId, array $options = [])
// $appManageClient->getRoles(APP_ID, [
//   'page' => 1,
//   'limit' => 10,
// ])

// 获取应用下角色的用户列表
// ApplicationsManagementClient->getUsersByRoleCode(string $appId, string $code)
// $appManageClient->getUsersByRoleCode(APP_ID, CODE);

// 应用下的角色添加用户
// ApplicationsManagementClient->addUsersToRole(string $appId, string $code, array $userIds)
// $appManageClient->addUsersToRole(APP_ID, CODE, [
//     USER_ID_1,
//     USER_ID_2,
// ]);


// 应用下的角色移除用户
// ApplicationsManagementClient->removeUsersFromRole(string $appId, string $code, array userIds)
// $appManageClient->removeUsersFromRole(APP_ID, CODE, [
//     USER_ID_1,
//     USER_ID_2,
// ]);

// 获取应用下角色被授权的所有资源列表
// ApplicationsManagementClient->listAuthorizedResourcesByRole(string $appId, string $code, string $resourceType = null)
// use Authing\Types\ResourceType;

// $appManageClient->listAuthorizedResourcesByRole(
//     APP_ID,
//     CODE,
//     ResourceType::BUTTON
// );

// 创建注册协议
// ApplicationsManagementClient->createAgreement(string $appId, array $agreement)
// $appManageClient->createAgreement(APP_ID, [
//   'title' =>
//     'I agreement this <a href="https://example.com/policy" target="_blank">policy</a>',
//   'required' => true,
// ]);

// 修改注册协议
// ApplicationsManagementClient->modifyAgreement(string $appId, string $agreementId, array $updates)
// $appManageClient->modifyAgreement(APP_ID, AGREEMENT_ID, [
//   'required' => false,
// ]);


// 获取注册协议列表
// ApplicationsManagementClient->listAgreement(string $appId)
// $appManageClient->listAgreement(APP_ID);

// 删除注册协议
// ApplicationsManagementClient->deleteAgreement(string $appId, string $agreementId)
// $appManageClient->deleteAgreement(APP_ID, AGREEMENT_ID);

// 注册协议排序
// ApplicationsManagementClient->sortAgreement(string appId, array order)
// $appManageClient->sortAgreement(APP_ID, [
//   AGREEMENT_ID1,
//   AGREEMENT_ID2,
//   AGREEMENT_ID3,
// ]);

// 查看已登录用户
// ApplicationsManagementClient->activeUsers(string $appId, int $page = 1, int $limit = 10)
// $appManageClient->activeUsers(APP_ID, 1, 10);

// 刷新应用密钥
// ApplicationsManagementClient->refreshApplicationSecret(string $appId)
// $appManageClient->refreshApplicationSecret(APP_ID);


