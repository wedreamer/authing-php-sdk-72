<?php

declare(strict_types=1);

require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;


// 初始化资源与权限客户端
// 通过用户池 id 与 用户池密码进行初始化
// $management = new ManagementClient("5f819ffdaaf252c4df2c9266", "06eca4ed85c807db9fc6a9d5483a4dc7");
// 通过回调函数进行初始化
$management = new ManagementClient(function ($options) {
    $options->userPoolId = '5f819ffdaaf252c4df2c9266';
    $options->secret = '06eca4ed85c807db9fc6a9d5483a4dc7';
});

$rolesManagementClient = $management->roles();
// $rolesManagementClient->paginate // 获取角色列表
// $rolesManagementClient->create   // 创建角色
// $rolesManagementClient->delete // 删除角色


$res = $rolesManagementClient->getUdfValue('6076a2f503bbc684184a7ed9');

// 创建角色
// RolesManagementClient->create(string $code, string $description = null, string $namespace = null)
$res = $rolesManagementClient->create("test-code");

// {"namespace":"default","code":"test-code","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:60a83b129a1bfb6ecc32a7c0","description":null,"createdAt":"2021-05-21T22:58:26+00:00","updatedAt":"2021-05-21T22:58:26+00:00","parent":null}

// 删除角色
// RolesManagementClient->delete(string $code, string $namespace = null)
$res = $rolesManagementClient->delete("code");

// 批量删除角色
// RolesManagementClient->deleteMany(array $codeList, string $namespace = null)
$res = $rolesManagementClient->deleteMany(
    [
        "code"
    ]
);

// 修改角色
// RolesManagementClient->update(string $code, array $input)
$res = $rolesManagementClient->update("juese_code", [
  'description' => '新加的相关说明'
]);

// "{"namespace":"default","code":"test_role_code","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:6076a2f503bbc684184a7ed9","description":"\u65b0\u52a0\u7684\u76f8\u5173\u8bf4\u660e","createdAt":"2021-04-14T08:08:21+00:00","updatedAt":"2021-05-22T07:18:44+00:00","parent":null}"

// 获取角色详情
// RolesManagementClient->detail(string $code, string $namespace = null)
$res = $rolesManagementClient->detail("test_role_code", 'default');

// {"namespace":"default","code":"test_role_code","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:6076a2f503bbc684184a7ed9","description":"\u6d4b\u8bd5\u4f7f\u7528\u7684 test_role_code","createdAt":"2021-04-14T08:08:21+00:00","updatedAt":"2021-04-14T08:08:21+00:00","parent":null}

// 获取角色列表
// RolesManagementClient->paginate(array $options = [])
$res = $rolesManagementClient->paginate();

// {"totalCount":2,"list":[{"namespace":"default","code":"test-code","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:60a83b129a1bfb6ecc32a7c0","description":"\u65b0\u52a0\u7684\u76f8\u5173\u8bf4\u660e","createdAt":"2021-05-21T22:58:26+00:00","updatedAt":"2021-05-21T23:10:47+00:00"},{"namespace":"default","code":"test_role_code","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:6076a2f503bbc684184a7ed9","description":"\u6d4b\u8bd5\u4f7f\u7528\u7684 test_role_code","createdAt":"2021-04-14T08:08:21+00:00","updatedAt":"2021-04-14T08:08:21+00:00"}]}

// 获取用户列表
// RolesManagementClient->listUsers(string $code, array $options = [])
$res = $rolesManagementClient->listUsers("test_role_code");

// {"totalCount":2,"list":[{"id":"6082607a3d19e39ae3b8ea7e","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:6082607a3d19e39ae3b8ea7e","status":"Activated","userPoolId":"5f819ffdaaf252c4df2c9266","username":null,"email":null,"emailVerified":false,"phone":"17630802710","phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"9d9a74dd7c61547ef047ebb3d2592cc2","oauth":null,"token":"eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IkRzU3hTSjJXZkRmc2QySTNhSDl2OHZrTU5QZzhpNnBOcDQ0UHNmNFF3bzAifQ.eyJzdWIiOiI2MDgyNjA3YTNkMTllMzlhZTNiOGVhN2UiLCJiaXJ0aGRhdGUiOm51bGwsImZhbWlseV9uYW1lIjpudWxsLCJnZW5kZXIiOiJVIiwiZ2l2ZW5fbmFtZSI6bnVsbCwibG9jYWxlIjpudWxsLCJtaWRkbGVfbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsInBpY3R1cmUiOiJodHRwczovL2ZpbGVzLmF1dGhpbmcuY28vYXV0aGluZy1jb25zb2xlL2RlZmF1bHQtdXNlci1hdmF0YXIucG5nIiwicHJlZmVycmVkX3VzZXJuYW1lIjpudWxsLCJwcm9maWxlIjpudWxsLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNC0zMFQwOTo1OToyNS4wNTZaIiwid2Vic2l0ZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImFkZHJlc3MiOnsiY291bnRyeSI6bnVsbCwicG9zdGFsX2NvZGUiOm51bGwsInJlZ2lvbiI6bnVsbCwiZm9ybWF0dGVkIjpudWxsfSwicGhvbmVfbnVtYmVyIjoiMTc2MzA4MDI3MTAiLCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJlbWFpbCI6bnVsbCwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJleHRlcm5hbF9pZCI6bnVsbCwidW5pb25pZCI6bnVsbCwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI1ZjgxOWZmZGFhZjI1MmM0ZGYyYzkyNjYiLCJhcHBJZCI6IjVmODFhMDQ4MTg4NjBhY2E3MmFhYzAyMSIsImlkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwidXNlcklkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwiX2lkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwicGhvbmUiOiIxNzYzMDgwMjcxMCIsImVtYWlsIjpudWxsLCJ1c2VybmFtZSI6bnVsbCwidW5pb25pZCI6bnVsbCwib3BlbmlkIjpudWxsLCJjbGllbnRJZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiJ9LCJ1c2VycG9vbF9pZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiIsImF1ZCI6IjVmODFhMDQ4MTg4NjBhY2E3MmFhYzAyMSIsImV4cCI6MTYxOTc4MDQzMywiaWF0IjoxNjE5Nzc2ODMzLCJpc3MiOiJodHRwczovL3NodWJ1enVvLW9pZGMuYXV0aGluZy5jbi9vaWRjIn0.rhR2yNyapRUIEEOiCIHpHtRSLqsj2_F2iZBwiqI_QuoI3MJu5lTQwuSh78PjQmmfbmlsxIFFPiULGeLCRTNkCaZFsXWmgaoNEerepUbk1I7vG8DgTyrv9l63vxaKzHY5mk8s6QRmXKd28ck23OoDUYozRC24mfvI-qgMwaC4ryXy8waotFmU0qkgrS4hBA3yjS0i9Wd208sr24UsWQst7RC5_atNDSSLRS-tkT5VkoQfa2QB0LpKcQaeWjamjyhKpZaSSVpjWwGO4RrqAB5v6HEuGHJMvgap6jW2yAWbxs2DV39n3_8c-FAZnEPAK3q0L_6LvK1HAneBLXZoxsdmxA","tokenExpiredAt":"2021-05-21T22:26:01+00:00","loginsCount":14,"lastLogin":"2021-04-30T10:00:33+00:00","lastIP":null,"signedUp":"2021-04-23T05:51:54+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T05:51:54+00:00","updatedAt":"2021-05-21T22:26:01+00:00","externalId":null},{"id":"60754ba9ab2e824c8e47f08c","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60754ba9ab2e824c8e47f08c","status":"Activated","userPoolId":"5f819ffdaaf252c4df2c9266","username":"shubuzuo","email":"1409458062@qq.com","emailVerified":true,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"597f2d99043847bc8efa9ef857b47bcc","oauth":null,"token":"eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IkRzU3hTSjJXZkRmc2QySTNhSDl2OHZrTU5QZzhpNnBOcDQ0UHNmNFF3bzAifQ.eyJzdWIiOiI2MDc1NGJhOWFiMmU4MjRjOGU0N2YwOGMiLCJiaXJ0aGRhdGUiOm51bGwsImZhbWlseV9uYW1lIjpudWxsLCJnZW5kZXIiOiJVIiwiZ2l2ZW5fbmFtZSI6bnVsbCwibG9jYWxlIjpudWxsLCJtaWRkbGVfbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsInBpY3R1cmUiOiJodHRwczovL2ZpbGVzLmF1dGhpbmcuY28vYXV0aGluZy1jb25zb2xlL2RlZmF1bHQtdXNlci1hdmF0YXIucG5nIiwicHJlZmVycmVkX3VzZXJuYW1lIjpudWxsLCJwcm9maWxlIjpudWxsLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNC0zMFQwOTo1OToyNC4xMTNaIiwid2Vic2l0ZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImFkZHJlc3MiOnsiY291bnRyeSI6bnVsbCwicG9zdGFsX2NvZGUiOm51bGwsInJlZ2lvbiI6bnVsbCwiZm9ybWF0dGVkIjpudWxsfSwicGhvbmVfbnVtYmVyIjpudWxsLCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJlbWFpbCI6IjE0MDk0NTgwNjJAcXEuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImV4dGVybmFsX2lkIjpudWxsLCJ1bmlvbmlkIjpudWxsLCJkYXRhIjp7InR5cGUiOiJ1c2VyIiwidXNlclBvb2xJZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiIsImFwcElkIjoiNWY4MWEwNDgxODg2MGFjYTcyYWFjMDIxIiwiaWQiOiI2MDc1NGJhOWFiMmU4MjRjOGU0N2YwOGMiLCJ1c2VySWQiOiI2MDc1NGJhOWFiMmU4MjRjOGU0N2YwOGMiLCJfaWQiOiI2MDc1NGJhOWFiMmU4MjRjOGU0N2YwOGMiLCJwaG9uZSI6bnVsbCwiZW1haWwiOiIxNDA5NDU4MDYyQHFxLmNvbSIsInVzZXJuYW1lIjoic2h1YnV6dW8iLCJ1bmlvbmlkIjpudWxsLCJvcGVuaWQiOm51bGwsImNsaWVudElkIjoiNWY4MTlmZmRhYWYyNTJjNGRmMmM5MjY2In0sInVzZXJwb29sX2lkIjoiNWY4MTlmZmRhYWYyNTJjNGRmMmM5MjY2IiwiYXVkIjoiNWY4MWEwNDgxODg2MGFjYTcyYWFjMDIxIiwiZXhwIjoxNjE5NzgwNDMyLCJpYXQiOjE2MTk3NzY4MzIsImlzcyI6Imh0dHBzOi8vc2h1YnV6dW8tb2lkYy5hdXRoaW5nLmNuL29pZGMifQ.FETjv98-EcGCEg9IPz1wnHrlUU9YQJuHqVL9gD0YS4Lu15uieEz7kpk032DU7NRNMPSvNc1ibu58suQMz_UT2MFuMP29krkAPhtRNpyQkUY6fzHvLjglwF6deRdFGPYLJQWMUFxYytINVIJG5RRSC0XKkFLsbX98zAxZQH8LZeWL5Sxyajs-_Kzxvjt6Vvl7NSomHUbZUXF2W1sqyWc153QcDo5-jkSzro5oDUgThuC9wMnXFTS9fJ-h7NSDfr7O0OblteGkLLC3kV_3lPjBVeZ-TtIng6ur0zrz6iDGvwcDdbY0HX65hXFjq8k0yoGkRy15sagbaSKmKTKfNNEcsw","tokenExpiredAt":"2021-04-30T11:00:32+00:00","loginsCount":656,"lastLogin":"2021-04-30T10:00:32+00:00","lastIP":null,"signedUp":"2021-04-13T07:43:37+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":"aa","formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":"bb","province":null,"country":null,"createdAt":"2021-04-13T07:43:37+00:00","updatedAt":"2021-04-30T10:00:32+00:00","externalId":null}]}

// 添加用户
// RolesManagementClient->addUsers(string $code, array $userIds, string $namespace = null)
$res = $rolesManagementClient->addUsers(
    "test_role_code",
    [
        "608a1c21e99c6eb1c8ec3e2f",
        "608266fdce2e54ccb0a20be7"
    ]
);

// {"message":"\u6388\u6743\u89d2\u8272\u6210\u529f","code":200}

// 移除用户
// RolesManagementClient->removeUsers(string $code, array $userIds, string $namespace = null)
$res = $rolesManagementClient->removeUsers(
    "test_role_code",
    [
        "608a1c21e99c6eb1c8ec3e2f",
        "608266fdce2e54ccb0a20be7"
    ]
);

// {"message":"\u64a4\u9500\u89d2\u8272\u6210\u529f","code":200}

// 获取角色被授权的所有资源列表
// RolesManagementClient->listAuthorizedResources(string $roleCode, string $namespace, string $resourceType = null)
use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\ManagementClient;

// $rolesManagementClient = $managementClient->roles();

$res = $rolesManagementClient->listAuthorizedResources(
    'test_role_code',
    'default'
);

// {"list":[{"code":"test_resource:*","type":"DATA","actions":["*"]}],"totalCount":1}


// 获取某个角色扩展字段列表
// RolesManagementClient->getUdfValue(string $roleId)
$res = $rolesManagementClient->getUdfValue('6076a2f503bbc684184a7ed9');

// null

// 获取某个角色某个扩展字段
// RolesManagementClient->getSpecificUdfValue(string $roleId, string $udfKey)
$res = $rolesManagementClient->getSpecificUdfValue('60a815b2e32c6ef56f8fd8ff', 'test_role_code');

// {"test_role_code":"ok"}

// 获取多个角色扩展字段列表
// RolesManagementClient->getUdfValueBatch(array $roleIds)
// TODO: 需要继续处理, 已经处理
$res = $rolesManagementClient->getUdfValueBatch(
  [
        '60a815b2e32c6ef56f8fd8ff',
        '6076a2f503bbc684184a7ed9'
  ]
);

// "{"60a815b2e32c6ef56f8fd8ff":{"test_role_code":"ok"},"6076a2f503bbc684184a7ed9":{}}"

// 设置某个角色扩展字段列表
// RolesManagementClient->setUdfValue(string $roleId, array $data)
$res = $rolesManagementClient->setUdfValue(
    '6076a2f503bbc684184a7ed9',
    [
        'shcool' => 'henandaxue',
        'age' => '24'
    ]
);

// [{"key":"test_role_code","dataType":"STRING","value":"test","label":"\u6d4b\u8bd5\u7528\u7684 test_role_code"}]

// 设置多个角色扩展字段列表
// RolesManagementClient->setUdfValueBatch(array $input)
// TODO: 有问题， 已经处理
$res = $rolesManagementClient->setUdfValueBatch([
    (object)[
        'roleId' => '6076a2f503bbc684184a7ed9',
        'data' => [
            'shcool' => 'henandaxue',
            'age' => '25'
        ]
    ]
]);

// "{"code":200,"message":"\u8bbe\u7f6e\u6210\u529f\uff01"}"

// 删除用户的扩展字段
// RolesManagementClient->removeUdfValue(string $roleId, string $key)
$res = $rolesManagementClient->removeUdfValue('6076a2f503bbc684184a7ed9', 'test_role_code');

// true
echo json_encode($res);


echo '';
