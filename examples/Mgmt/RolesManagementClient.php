<?php

declare(strict_types=1);

use Authing\Mgmt\ManagementClient;

$manageClient = new ManagementClient('YOUR_USERPOOL_ID', 'YOUR_USERPOOL_SECRET');

$rolesManagementClient = $managementClient->roles();
// $rolesManagementClient->paginate // 获取角色列表
// $rolesManagementClient->create   // 创建角色
// $rolesManagementClient->delete // 删除角色

// 创建角色
// RolesManagementClient->create(string $code, string $description = null, string $namespace = null)
// $role = $managementClient->roles()->create("code");

// 删除角色
// RolesManagementClient->delete(string $code, string $namespace = null)
// $message = $managementClient->roles()->delete("code");

// 批量删除角色
// RolesManagementClient->deleteMany(array $codeList, string $namespace = null)
// $message = $managementClient->roles()->deleteMany(
//     [
//         "code"
//     ]
// );

// 修改角色
// RolesManagementClient->update(string $code, array $input)
// $role = $managementClient->roles()->update("code", [
//   'description' => 'desc'
// ]);


// 获取角色详情
// RolesManagementClient->detail(string $code, string $namespace = null)
// $role = $managementClient->roles()->detail("code");

// 获取角色列表
// RolesManagementClient->paginate(array $options = [])
// $roles = $managementClient->roles()->paginate();

// 获取用户列表
// RolesManagementClient->listUsers(string $code, array $options = [])
// $users = $managementClient->roles()->listUsers("code");

// 添加用户
// RolesManagementClient->addUsers(string $code, array $userIds, string $namespace = null)
// $message = $managementClient->roles()->addUsers(
//   "code", 
//   [
//     "userId"
//   ]
// );


// 移除用户
// RolesManagementClient->removeUsers(string $code, array $userIds, string $namespace = null)
// $message = $managementClient->roles()->removeUsers(
//   "code", 
//   [
//     "userId"
//   ]
// );

// 获取角色被授权的所有资源列表
// RolesManagementClient->listAuthorizedResources(string $roleCode, string $namespace, string $resourceType = null)
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\ManagementClient;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $rolesManagementClient = $managementClient->roles();

// $data = $rolesManagementClient->listAuthorizedResources(
//     'roleCode',
//     'default'
// );


// 获取某个角色扩展字段列表
// RolesManagementClient->getUdfValue(string $roleId)
// $rolesManagementClient->getUdfValue('roleId')

// 获取某个角色某个扩展字段
// RolesManagementClient->getSpecificUdfValue(string $roleId, string $udfKey)
// $rolesManagementClient->getSpecificUdfValue('roleId', 'udfKey');

// 获取多个角色扩展字段列表
// RolesManagementClient->getUdfValueBatch(array $roleIds)
// $rolesManagementClient->getUdfValueBatch(
//   [
//     'roleId1', 
//     'roleId2'
//   ]
// );

// 设置某个角色扩展字段列表
// RolesManagementClient->setUdfValue(string $roleId, array $data)
// $rolesManagementClient->setUdfValue(
//   'roleId1', 
//   [
//     'key1' => 'value1',
//     'key2' => 'value2'
//   ]
// )

// 设置多个角色扩展字段列表
// RolesManagementClient->setUdfValueBatch(array $input)
// $rolesManagementClient->setUdfValueBatch([
//   'roleId' => 'role id',
//   'data' => [
//               'key1' => 'value1',
//               'key2' => 'value2'
//             ]
// ]);


// 删除用户的扩展字段
// RolesManagementClient->removeUdfValue(string $roleId, string $key)
// $rolesManagementClient->removeUdfValue('roleId1', 'key1');


