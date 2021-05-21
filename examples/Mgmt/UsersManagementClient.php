<?php

declare(strict_types=1);

use Authing\Mgmt\ManagementClient;

$manageClient = new ManagementClient('YOUR_USERPOOL_ID', 'YOUR_USERPOOL_SECRET');

$usersManagementClient = $managementClient->users();
// $usersManagementClient->create // 创建用户
// $usersManagementClient->update   // 修改用户资料
// $usersManagementClient->detail // 获取用户详情

// 创建用户
// UsersManagementClient->create(CreateUserInput $userInfo)

use Authing\Types\CreateUserInput;

$email = "test@example.com";
$password = '123456';
$res = $managementClient->users()->create(
    (new CreateUserInput())
        ->withEmail($email)
        ->withPassword($password)
);


// 修改用户资料
// UsersManagementClient->update(string $id, UpdateUserInput $updates)

// use Authing\Types\UpdateUserInput;

// $email = 'new email';
// $name = 'new name';

// $updates = (new UpdateUserInput())->withEmail($email)->withUsername($name);
// $user = $managementClient->users()->update(
//     'userId',
//     updates
// );


// 获取用户详情
// UsersManagementClient->detail(string $userId)
// $user = $managementClient->users()->detail("userId");

// 获取自定义数据
// UsersManagementClient->listUdv(string $userId)
// $data = $userManagementClient->listUdv("userId");

// 批量获取自定义数据
// UsersManagementClient->getUdfValueBatch(array $userIds)
// $data = $userManagementClient->getUdfValueBatch(
//     ["userId1", "userId2"]
// );

// 设置自定义数据
// UsersManagementClient->setUdfValue(string $userId, array $data)
// $userManagementClient->setUdfValue(userId, [
//     'school' => '华中科技大学',
//     'age' => 20,
// ]);

// 批量设置自定义数据
// UsersManagementClient->setUdfValueBatch(array $input)
// $userManagementClient->setUdfValueBatch([
//     [
//         'userId' => 'USER_ID1',
//         'data' => (object)[
//             'school' => '华中科技大学',
//         ],
//     ],
//     [
//         'userId' => 'USER_ID2',
//         'data' => (object)[
//             'school' => '清华大学',
//             'age' => 100,
//         ],
//     ],
// ]);

// 删除自定义数据
// UsersManagementClient->removeUdfValue(string $userId, string $key)
// $userManagementClient->removeUdfValue('USER_ID', 'school');

// 删除用户
// UsersManagementClient->delete(string $userId)
// $message = $managementClient->users()->delete("userId");

// 批量删除用户
// UsersManagementClient->deleteMany(array $userIds)
// $message = $managementClient->users()->deleteMany(
//     ["userId"]
// );


// 批量获取用户
// UsersManagementClient->batch(array $identifiers, array $options = [])
// 通过手机号、用户池、邮箱、ExternalId 批量查找用户 PHP SDK
// $users = $userManageClient->batch(
//     [
//         'externalId',
//         // id, username, email, phone -> queryField
//     ],
//     [
//         // 'queryField' => 'id',
//         // 'queryField' => 'username',
//         // 'queryField' => 'email',
//         // 'queryField' => 'phone',
//         'queryField' => 'externalId',
//     ]
// );

// 获取用户列表
// UsersManagementClient->paginate(int $page = 1, int $limit = 10)
// userManagementClient->paginate();

// 获取已归档用户列表
// UsersManagementClient->listArchivedUsers(int $page = 1, int $limit = 10)
// $userManagementClient->listArchivedUsers();

// 检查用户是否存在
// UsersManagementClient->exists(IsUserExistsParam $options)
// use Authing\Types\IsUserExistsParam;

// $param = (new IsUserExistsParam())->withUsername('bob');


// 查找用户
// UsersManagementClient->find(array $options)
// $client = new ManagementClient('USERPOOL_ID', 'USERPOOL_SERCET');

// $userManageClient = $client->users();

// 通过 ExternalID 查用户信息 PHP
// $user = $userManageClient->find(
//     [
//         // 'username' => 'username',
//         // 'email' => 'email',
//         // 'phone' => 'phone',
//         'externalId' => 'find externalId',
//     ]
// );

// 搜索用户
// UsersManagementClient->search(string $query, array $options, int page = 1, int limit = 10)
// $users = $managementClient->users()->search("query");


// 强制下线一批用户
// UsersManagementClient->kick(array $userIds)
// $userManagementClient->kick(
//     ['USER_ID1', 'USER_ID2']
// );

// 通过用户 ID 查找用户所在分组
// UsersManagementClient->listGroups(string $userId)
// $list = $managementClient->users()->listGroups("userId");


// 加入分组
// UsersManagementClient->addGroup(string $userId, string $group)
// $managementClient->users()->addGroup("userId", "group code");

// 退出分组
// UsersManagementClient->removeGroup(string $userId, string $group)
// $managementClient->users()->removeGroup("userId", "group code");

// 获取用户角色列表
// UsersManagementClient->listRoles(string $userId)
// $roles = $managementClient->users()->listRoles("userId");

// 添加角色
// UsersManagementClient->addRoles(string $userId, array $roles)
// $managementClient->users()->addRoles(
//     "userId",
//     ["role code"]
// );


// 移除角色
// UsersManagementClient->removeRoles(string $userId, array $roles)
// $message = $managementClient->users()->removeRoles(
//     "userId",
//     ["role code"]
// );


// 判断用户是否有某个角色
// UsersManagementClient->hasRole(string $userId, string $roleCode, string $namespace)
// $namespace = 'code';
// $roleCode = 'roleCode';
// $usersManagementClient->hasRole('USERID', $roleCode, $namespace);

// 获取用户被授权的所有资源列表
// UsersManagementClient->listAuthorizedResources(string $userId, string $namespace, array options = [])
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\UsersManagementClient;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $userManagementClient = $managementClient->users();

// $data = $userManagementClient->listAuthorizedResources('userId', "default");


// 获取审计日志列表
// UsersManagementClient->listArchivedUsers(int $page = 1, int $limit = 10)
// $usersManagementClient->listArchivedUsers();

echo json_encode($res);


echo '';