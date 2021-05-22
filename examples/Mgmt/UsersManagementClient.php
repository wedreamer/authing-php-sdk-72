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

$userManageClient = $management->users();
// $usersManagementClient->create // 创建用户
// $usersManagementClient->update   // 修改用户资料
// $usersManagementClient->detail // 获取用户详情


$res = $userManageClient->listUserActions();
echo json_encode($res);
// 创建用户
// UsersManagementClient->create(CreateUserInput $userInfo)

use Authing\Types\CreateUserInput;

$email = "test@example.com";
$password = '123456';
$res = $userManageClient->create(
    (new CreateUserInput())
        ->withEmail($email)
        ->withPassword($password)
);

// {"id":"60a81fe4fa72b8bf2b25f659","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60a81fe4fa72b8bf2b25f659","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"test@example.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cf3f3cbe3cb001aed90f92c3f3d68696","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-05-21T21:02:28+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-05-21T21:02:28+00:00","updatedAt":"2021-05-21T21:02:28+00:00","externalId":null}


// 修改用户资料
// UsersManagementClient->update(string $id, UpdateUserInput $updates)

use Authing\Types\UpdateUserInput;

$email = 'new email';
$name = 'new name';

$updates = (new UpdateUserInput())->withEmail($email)->withUsername($name);
$res = $userManageClient->update(
    '60a81fe4fa72b8bf2b25f659',
    $updates
);

// {"id":"60a81fe4fa72b8bf2b25f659","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60a81fe4fa72b8bf2b25f659","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"new name","email":"new email","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cf3f3cbe3cb001aed90f92c3f3d68696","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-05-21T21:02:28+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-05-21T21:02:28+00:00","updatedAt":"2021-05-21T21:11:09+00:00","externalId":null}

// 获取用户详情
// UsersManagementClient->detail(string $userId)
// $res = $userManageClient->detail("60a81fe4fa72b8bf2b25f659");

// {"id":"60a81fe4fa72b8bf2b25f659","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60a81fe4fa72b8bf2b25f659","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"new name","email":"new email","emailVerified":false,"phone":null,"phoneVerified":false,"identities":[],"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cf3f3cbe3cb001aed90f92c3f3d68696","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-05-21T21:02:28+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-05-21T21:02:28+00:00","updatedAt":"2021-05-21T21:11:09+00:00","externalId":null}

// 获取自定义数据
// UsersManagementClient->listUdv(string $userId)
// TODO: 没有这个函数
// $res = $userManageClient->getUdfValue("60a81fe4fa72b8bf2b25f659");

// [{"key":"school","dataType":"STRING","value":"\u534e\u4e2d\u79d1\u6280\u5927\u5b66","label":"\u5b66\u6821"}]

// 批量获取自定义数据
// UsersManagementClient->getUdfValueBatch(array $userIds)
$res = $userManageClient->getUdfValueBatch(
    ["60a81fe4fa72b8bf2b25f659", "608bd543d56f1f0def27c228"]
);

// [{"targetId":"60a81fe4fa72b8bf2b25f659","data":[{"key":"school","dataType":"STRING","value":"\u534e\u4e2d\u79d1\u6280\u5927\u5b66","label":"\u5b66\u6821"}]},{"targetId":"608bd543d56f1f0def27c228","data":[{"key":"school","dataType":"STRING","value":"\u534e\u4e2d\u79d1\u6280\u5927\u5b66","label":"\u5b66\u6821"}]}]

// 设置自定义数据
// UsersManagementClient->setUdfValue(string $userId, array $data)
$res = $userManageClient->setUdfValue("608bd543d56f1f0def27c228", [
    'school' => '华中科技大学',
    'age' => 20,
]);

// [{"key":"school","dataType":"STRING","value":"\u534e\u4e2d\u79d1\u6280\u5927\u5b66","label":"\u5b66\u6821"}]

// 批量设置自定义数据
// UsersManagementClient->setUdfValueBatch(array $input)
$res = $userManageClient->setUdfValueBatch([
    [
        'userId' => '608bd543d56f1f0def27c228',
        'data' => (object)[
            'school' => 'new 华中科技大学',
        ],
    ],
    [
        'userId' => '60a81fe4fa72b8bf2b25f659',
        'data' => (object)[
            'school' => 'new 清华大学',
            'age' => 100,
        ],
    ],
]);

// {"code":200,"message":"\u8bbe\u7f6e\u6210\u529f\uff01"}

// 删除自定义数据
// UsersManagementClient->removeUdfValue(string $userId, string $key)
// $res = $userManageClient->removeUdfValue('60a81fe4fa72b8bf2b25f659', 'school');

// true

// 删除用户
// UsersManagementClient->delete(string $userId)
// $res = $userManageClient->delete("608bd3d7899082f00fd607a3");

// {"message":"\u5220\u9664\u6210\u529f\uff01","code":200}

// 批量删除用户
// UsersManagementClient->deleteMany(array $userIds)
$res = $userManageClient->deleteMany(
    ["608bd47619cd9a128575042f", "608bd474d3d9047bb917f884"]
);

// {"message":"\u5220\u9664\u6210\u529f\uff01","code":200}

// 批量获取用户
// UsersManagementClient->batch(array $identifiers, array $options = [])
// TODO: 参数说明有问题
// 通过手机号、用户池、邮箱、ExternalId 批量查找用户 PHP SDK
$res = $userManageClient->batch(
    [
        '608bd3d684d0637251c4b519',
        '608a1c21e99c6eb1c8ec3e2f'
        // id, username, email, phone -> queryField
    ],
    [
        // 'queryField' => 'id',
        // 'queryField' => 'username',
        // 'queryField' => 'email',
        // 'queryField' => 'phone',
        'queryField' => 'id',
    ]
);

// [{"thirdPartyIdentity":{"provider":null,"refreshToken":null,"accessToken":null,"scope":null,"expiresIn":null,"updatedAt":null},"id":"608a1c21e99c6eb1c8ec3e2f","createdAt":"2021-04-29T02:38:25.461Z","updatedAt":"2021-04-29T02:38:25.485Z","userPoolId":"5f819ffdaaf252c4df2c9266","isRoot":false,"status":"Activated","oauth":null,"email":null,"phone":null,"username":"shubuzuo-test1","unionid":null,"openid":null,"nickname":null,"company":null,"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","browser":null,"device":null,"password":"cb0d73539a120af3aa4bb387743e67dc","salt":"ipo5phkmd14","token":null,"tokenExpiredAt":null,"loginsCount":0,"lastIp":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"registerSource":["basic:username-password"],"secretInfo":null,"emailVerified":false,"phoneVerified":false,"lastLogin":null,"blocked":false,"isDeleted":false,"sendSmsCount":0,"sendSmsLimitCount":1000,"dataVersion":null,"encryptedPassword":"gmS4blFvIDX+CNbpkOxvp5pF05zDFDCr6N0EHxjbOqlGi3TvvJ5fK1sQ9NYCau\/X66v5gPZyR7Dh3OyDTHvCE83B+goK6njExm677pm0dywucSMJIJkIqVjTYbVu9cySetEbNEEqnpEIIRn90Nu7\/2egiZSQ12QXNXKWUoNw2dU=","signedUp":"2021-04-29T02:38:25.461Z","externalId":null,"mainDepartmentId":null,"mainDepartmentCode":null,"lastMfaTime":null,"passwordSecurityLevel":1,"resetPasswordOnFirstLogin":false,"source":null},{"thirdPartyIdentity":{"provider":null,"refreshToken":null,"accessToken":null,"scope":null,"expiresIn":null,"updatedAt":null},"id":"608bd3d684d0637251c4b519","createdAt":"2021-04-30T09:54:30.154Z","updatedAt":"2021-04-30T09:54:30.179Z","userPoolId":"5f819ffdaaf252c4df2c9266","isRoot":false,"status":"Activated","oauth":null,"email":"shubuzuo2@qq.com","phone":null,"username":null,"unionid":null,"openid":null,"nickname":null,"company":null,"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","browser":null,"device":null,"password":"dd6b444a43482c9a82141555e1c57508","salt":"82ip50e227h","token":null,"tokenExpiredAt":null,"loginsCount":0,"lastIp":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"registerSource":["basic:email"],"secretInfo":null,"emailVerified":false,"phoneVerified":false,"lastLogin":null,"blocked":false,"isDeleted":false,"sendSmsCount":0,"sendSmsLimitCount":1000,"dataVersion":null,"encryptedPassword":"m2at6rvtAcimjusxLoNrfWQJ1\/6HeLoHRrhOr52w6bfP9DOpj\/x+lH3zDUkCthY9d2XCReH\/eTjIa0Q2sAl6MnL2PHij1lS\/IFEcQ0A\/1eibyPDGolSyatfjaqb\/0XEScyMDvpWXOd9jW4Jq3DsYcOpJG+sUu22IaRXBf4hLoQM=","signedUp":"2021-04-30T09:54:30.154Z","externalId":null,"mainDepartmentId":null,"mainDepartmentCode":null,"lastMfaTime":null,"passwordSecurityLevel":1,"resetPasswordOnFirstLogin":false,"source":null}]

// 获取用户列表
// UsersManagementClient->paginate(int $page = 1, int $limit = 10)
$res = $userManageClient->paginate();

// {"totalCount":13,"list":[{"id":"60a81fe4fa72b8bf2b25f659","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60a81fe4fa72b8bf2b25f659","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"new name","email":"new email","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cf3f3cbe3cb001aed90f92c3f3d68696","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-05-21T21:02:28+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-05-21T21:02:28+00:00","updatedAt":"2021-05-21T21:11:09+00:00","externalId":null},{"id":"608bd543d56f1f0def27c228","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608bd543d56f1f0def27c228","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"shubuzuo-test4","email":null,"emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:username-password"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"aa27f7dde078335e6e7975678ad5dcd7","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-30T10:00:35+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-30T10:00:35+00:00","updatedAt":"2021-04-30T10:00:35+00:00","externalId":null},{"id":"608bd54264a34da2c3dac97d","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608bd54264a34da2c3dac97d","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"shubuzuo4@qq.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:email"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"1e13eb2a4230586817732dd4cc5f2385","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-30T10:00:34+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-30T10:00:34+00:00","updatedAt":"2021-04-30T10:00:34+00:00","externalId":null},{"id":"608bd3d684d0637251c4b519","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608bd3d684d0637251c4b519","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"shubuzuo2@qq.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:email"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"dd6b444a43482c9a82141555e1c57508","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-30T09:54:30+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-30T09:54:30+00:00","updatedAt":"2021-04-30T09:54:30+00:00","externalId":null},{"id":"608a1c21e99c6eb1c8ec3e2f","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608a1c21e99c6eb1c8ec3e2f","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"shubuzuo-test1","email":null,"emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:username-password"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cb0d73539a120af3aa4bb387743e67dc","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-29T02:38:25+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-29T02:38:25+00:00","updatedAt":"2021-04-29T02:38:25+00:00","externalId":null},{"id":"608a1c1b0866627f9ce69b3a","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608a1c1b0866627f9ce69b3a","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"shubuzuo1@qq.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:email"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"5eadd1872b9cd45ea3a388bfe42cb560","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-29T02:38:19+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-29T02:38:19+00:00","updatedAt":"2021-04-29T02:38:19+00:00","externalId":null},{"id":"60829164cc89d2c6353b0619","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60829164cc89d2c6353b0619","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"test1username","email":null,"emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"a6ae18b4df66d17fc1a0f4634ac8f134","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-23T09:20:36+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T09:20:36+00:00","updatedAt":"2021-04-23T09:24:03+00:00","externalId":null},{"id":"608266fdce2e54ccb0a20be7","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608266fdce2e54ccb0a20be7","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"test-username","email":null,"emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:username-password"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"a2ada7e7d3593bf6bc13b3de014bc338","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-23T06:19:41+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T06:19:41+00:00","updatedAt":"2021-04-23T06:19:41+00:00","externalId":null},{"id":"608266fc3e314f39c174029f","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608266fc3e314f39c174029f","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"test@qq.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:email"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"f1d08e901748f439ff73ca3a79e53488","oauth":null,"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2MDgyNjZmYzNlMzE0ZjM5YzE3NDAyOWYiLCJiaXJ0aGRhdGUiOm51bGwsImZhbWlseV9uYW1lIjpudWxsLCJnZW5kZXIiOiJVIiwiZ2l2ZW5fbmFtZSI6bnVsbCwibG9jYWxlIjpudWxsLCJtaWRkbGVfbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsInBpY3R1cmUiOiJodHRwczovL2ZpbGVzLmF1dGhpbmcuY28vYXV0aGluZy1jb25zb2xlL2RlZmF1bHQtdXNlci1hdmF0YXIucG5nIiwicHJlZmVycmVkX3VzZXJuYW1lIjpudWxsLCJwcm9maWxlIjpudWxsLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNC0yM1QwNjoxOTo0MC4wNzBaIiwid2Vic2l0ZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImFkZHJlc3MiOnsiY291bnRyeSI6bnVsbCwicG9zdGFsX2NvZGUiOm51bGwsInJlZ2lvbiI6bnVsbCwiZm9ybWF0dGVkIjpudWxsfSwicGhvbmVfbnVtYmVyIjpudWxsLCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJlbWFpbCI6InRlc3RAcXEuY29tIiwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJleHRlcm5hbF9pZCI6bnVsbCwidW5pb25pZCI6bnVsbCwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI1ZjgxOWZmZGFhZjI1MmM0ZGYyYzkyNjYiLCJhcHBJZCI6IjVmODJiOWI5YzIzOWI3OWQ0ZjBkOTNiZSIsImlkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwidXNlcklkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwiX2lkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwicGhvbmUiOm51bGwsImVtYWlsIjoidGVzdEBxcS5jb20iLCJ1c2VybmFtZSI6bnVsbCwidW5pb25pZCI6bnVsbCwib3BlbmlkIjpudWxsLCJjbGllbnRJZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiJ9LCJ1c2VycG9vbF9pZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiIsImF1ZCI6IjVmODJiOWI5YzIzOWI3OWQ0ZjBkOTNiZSIsImV4cCI6MTYxOTE2MjM4NCwiaWF0IjoxNjE5MTU4Nzg0LCJpc3MiOiJodHRwczovL3NodWJ1enVvLW9hdXRoLmF1dGhpbmcuY24vb2lkYyJ9.FVkibq_Y5LjLapt_7mUJhVc3bZOA_g-uIOZ7KRdqZ-M","tokenExpiredAt":"2021-04-23T07:19:44+00:00","loginsCount":1,"lastLogin":"2021-04-23T06:19:44+00:00","lastIP":null,"signedUp":"2021-04-23T06:19:40+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T06:19:40+00:00","updatedAt":"2021-04-23T06:19:44+00:00","externalId":null},{"id":"6082607a3d19e39ae3b8ea7e","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:6082607a3d19e39ae3b8ea7e","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":null,"emailVerified":false,"phone":"17630802710","phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"9d9a74dd7c61547ef047ebb3d2592cc2","oauth":null,"token":"eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IkRzU3hTSjJXZkRmc2QySTNhSDl2OHZrTU5QZzhpNnBOcDQ0UHNmNFF3bzAifQ.eyJzdWIiOiI2MDgyNjA3YTNkMTllMzlhZTNiOGVhN2UiLCJiaXJ0aGRhdGUiOm51bGwsImZhbWlseV9uYW1lIjpudWxsLCJnZW5kZXIiOiJVIiwiZ2l2ZW5fbmFtZSI6bnVsbCwibG9jYWxlIjpudWxsLCJtaWRkbGVfbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsInBpY3R1cmUiOiJodHRwczovL2ZpbGVzLmF1dGhpbmcuY28vYXV0aGluZy1jb25zb2xlL2RlZmF1bHQtdXNlci1hdmF0YXIucG5nIiwicHJlZmVycmVkX3VzZXJuYW1lIjpudWxsLCJwcm9maWxlIjpudWxsLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNC0zMFQwOTo1OToyNS4wNTZaIiwid2Vic2l0ZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImFkZHJlc3MiOnsiY291bnRyeSI6bnVsbCwicG9zdGFsX2NvZGUiOm51bGwsInJlZ2lvbiI6bnVsbCwiZm9ybWF0dGVkIjpudWxsfSwicGhvbmVfbnVtYmVyIjoiMTc2MzA4MDI3MTAiLCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJlbWFpbCI6bnVsbCwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJleHRlcm5hbF9pZCI6bnVsbCwidW5pb25pZCI6bnVsbCwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI1ZjgxOWZmZGFhZjI1MmM0ZGYyYzkyNjYiLCJhcHBJZCI6IjVmODFhMDQ4MTg4NjBhY2E3MmFhYzAyMSIsImlkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwidXNlcklkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwiX2lkIjoiNjA4MjYwN2EzZDE5ZTM5YWUzYjhlYTdlIiwicGhvbmUiOiIxNzYzMDgwMjcxMCIsImVtYWlsIjpudWxsLCJ1c2VybmFtZSI6bnVsbCwidW5pb25pZCI6bnVsbCwib3BlbmlkIjpudWxsLCJjbGllbnRJZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiJ9LCJ1c2VycG9vbF9pZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiIsImF1ZCI6IjVmODFhMDQ4MTg4NjBhY2E3MmFhYzAyMSIsImV4cCI6MTYxOTc4MDQzMywiaWF0IjoxNjE5Nzc2ODMzLCJpc3MiOiJodHRwczovL3NodWJ1enVvLW9pZGMuYXV0aGluZy5jbi9vaWRjIn0.rhR2yNyapRUIEEOiCIHpHtRSLqsj2_F2iZBwiqI_QuoI3MJu5lTQwuSh78PjQmmfbmlsxIFFPiULGeLCRTNkCaZFsXWmgaoNEerepUbk1I7vG8DgTyrv9l63vxaKzHY5mk8s6QRmXKd28ck23OoDUYozRC24mfvI-qgMwaC4ryXy8waotFmU0qkgrS4hBA3yjS0i9Wd208sr24UsWQst7RC5_atNDSSLRS-tkT5VkoQfa2QB0LpKcQaeWjamjyhKpZaSSVpjWwGO4RrqAB5v6HEuGHJMvgap6jW2yAWbxs2DV39n3_8c-FAZnEPAK3q0L_6LvK1HAneBLXZoxsdmxA","tokenExpiredAt":"2021-04-30T11:00:33+00:00","loginsCount":14,"lastLogin":"2021-04-30T10:00:33+00:00","lastIP":null,"signedUp":"2021-04-23T05:51:54+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T05:51:54+00:00","updatedAt":"2021-04-30T10:00:33+00:00","externalId":null}]}

// 获取已归档用户列表
// UsersManagementClient->listArchivedUsers(int $page = 1, int $limit = 10)
$res = $userManageClient->listArchivedUsers();

// {"totalCount":1,"list":[{"id":"60829164cc89d2c6353b0619","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60829164cc89d2c6353b0619","status":"Archived","userPoolId":"5f819ffdaaf252c4df2c9266","username":"test1username","email":null,"emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"a6ae18b4df66d17fc1a0f4634ac8f134","oauth":null,"token":null,"tokenExpiredAt":"2021-05-21T21:53:17+00:00","loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-04-23T09:20:36+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T09:20:36+00:00","updatedAt":"2021-05-21T21:53:18+00:00","externalId":null}]}

// 检查用户是否存在
// UsersManagementClient->exists(IsUserExistsParam $options)
use Authing\Types\IsUserExistsParam;

$param = (new IsUserExistsParam())->withUsername('叶祖威');
$res = $userManageClient->exists($param);

// true

// 查找用户
// UsersManagementClient->find(array $options)
// $client = new ManagementClient('USERPOOL_ID', 'USERPOOL_SERCET');

// $userManageClient = $client->users();

// 通过 ExternalID 查用户信息 PHP
$res = $userManageClient->find(
    [
        // 'username' => 'username',
        'email' => 'test@qq.com',
        // 'phone' => 'phone',
        // 'externalId' => 'find externalId',
    ]
);

// {"id":"608266fc3e314f39c174029f","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:608266fc3e314f39c174029f","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":null,"email":"test@qq.com","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["basic:email"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"f1d08e901748f439ff73ca3a79e53488","oauth":null,"token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2MDgyNjZmYzNlMzE0ZjM5YzE3NDAyOWYiLCJiaXJ0aGRhdGUiOm51bGwsImZhbWlseV9uYW1lIjpudWxsLCJnZW5kZXIiOiJVIiwiZ2l2ZW5fbmFtZSI6bnVsbCwibG9jYWxlIjpudWxsLCJtaWRkbGVfbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsInBpY3R1cmUiOiJodHRwczovL2ZpbGVzLmF1dGhpbmcuY28vYXV0aGluZy1jb25zb2xlL2RlZmF1bHQtdXNlci1hdmF0YXIucG5nIiwicHJlZmVycmVkX3VzZXJuYW1lIjpudWxsLCJwcm9maWxlIjpudWxsLCJ1cGRhdGVkX2F0IjoiMjAyMS0wNC0yM1QwNjoxOTo0MC4wNzBaIiwid2Vic2l0ZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImFkZHJlc3MiOnsiY291bnRyeSI6bnVsbCwicG9zdGFsX2NvZGUiOm51bGwsInJlZ2lvbiI6bnVsbCwiZm9ybWF0dGVkIjpudWxsfSwicGhvbmVfbnVtYmVyIjpudWxsLCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJlbWFpbCI6InRlc3RAcXEuY29tIiwiZW1haWxfdmVyaWZpZWQiOmZhbHNlLCJleHRlcm5hbF9pZCI6bnVsbCwidW5pb25pZCI6bnVsbCwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI1ZjgxOWZmZGFhZjI1MmM0ZGYyYzkyNjYiLCJhcHBJZCI6IjVmODJiOWI5YzIzOWI3OWQ0ZjBkOTNiZSIsImlkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwidXNlcklkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwiX2lkIjoiNjA4MjY2ZmMzZTMxNGYzOWMxNzQwMjlmIiwicGhvbmUiOm51bGwsImVtYWlsIjoidGVzdEBxcS5jb20iLCJ1c2VybmFtZSI6bnVsbCwidW5pb25pZCI6bnVsbCwib3BlbmlkIjpudWxsLCJjbGllbnRJZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiJ9LCJ1c2VycG9vbF9pZCI6IjVmODE5ZmZkYWFmMjUyYzRkZjJjOTI2NiIsImF1ZCI6IjVmODJiOWI5YzIzOWI3OWQ0ZjBkOTNiZSIsImV4cCI6MTYxOTE2MjM4NCwiaWF0IjoxNjE5MTU4Nzg0LCJpc3MiOiJodHRwczovL3NodWJ1enVvLW9hdXRoLmF1dGhpbmcuY24vb2lkYyJ9.FVkibq_Y5LjLapt_7mUJhVc3bZOA_g-uIOZ7KRdqZ-M","tokenExpiredAt":"2021-04-23T07:19:44+00:00","loginsCount":1,"lastLogin":"2021-04-23T06:19:44+00:00","lastIP":null,"signedUp":"2021-04-23T06:19:40+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-04-23T06:19:40+00:00","updatedAt":"2021-04-23T06:19:44+00:00","externalId":null}

// 搜索用户
// UsersManagementClient().search(query, options)
// TODO: 需要改善
$res = $userManageClient->search("new name", [
    'withCustomData' => true
]);

// string(1136) "{"totalCount":3,"list":[{"id":"60a81fe4fa72b8bf2b25f659","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:user:60a81fe4fa72b8bf2b25f659","userPoolId":"5f819ffdaaf252c4df2c9266","status":"Activated","username":"new name","email":"new email","emailVerified":false,"phone":null,"phoneVerified":false,"unionid":null,"openid":null,"nickname":null,"registerSource":["import:manual"],"photo":"https:\/\/files.authing.co\/authing-console\/default-user-avatar.png","password":"cf3f3cbe3cb001aed90f92c3f3d68696","oauth":null,"token":null,"tokenExpiredAt":null,"loginsCount":0,"lastLogin":null,"lastIP":null,"signedUp":"2021-05-21T21:02:28+00:00","blocked":false,"isDeleted":false,"device":null,"browser":null,"company":null,"name":null,"givenName":null,"familyName":null,"middleName":null,"profile":null,"preferredUsername":null,"website":null,"gender":"U","birthdate":null,"zoneinfo":null,"locale":null,"address":null,"formatted":null,"streetAddress":null,"locality":null,"region":null,"postalCode":null,"city":null,"province":null,"country":null,"createdAt":"2021-05-21T21:02:28+00:00","updatedAt":"2021-05-21T21:11:09+00:00","externalId":null}]}"



// 强制下线一批用户
// UsersManagementClient->kick(array $userIds)
$res = $userManageClient->kick(
    ['6082607a3d19e39ae3b8ea7e']
);

// {"code":200,"message":"\u5f3a\u5236\u4e0b\u7ebf\u6210\u529f"}

// 通过用户 ID 查找用户所在分组
// UsersManagementClient->listGroups(string $userId)
$res = $userManageClient->listGroups("6082607a3d19e39ae3b8ea7e");

// {"groups":{"totalCount":1,"list":[{"code":"5584","name":"Users","description":"\u8fd9\u662f\u6839\u7ec4\u7ec7","createdAt":"2021-04-23T06:40:54+00:00","updatedAt":"2021-04-23T06:40:54+00:00"}]}}

// 加入分组
// UsersManagementClient->addGroup(string $userId, string $group)
$res = $userManageClient->addGroup("608bd543d56f1f0def27c228", "5584");

// {"message":"\u6dfb\u52a0\u6210\u529f\uff01","code":200}

// 退出分组
// UsersManagementClient->removeGroup(string $userId, string $group)
$res = $userManageClient->removeGroup("608bd543d56f1f0def27c228", "5584");

// {"message":"\u6dfb\u52a0\u6210\u529f\uff01","code":200}

// 获取用户角色列表
// UsersManagementClient->listRoles(string $userId)
$res = $userManageClient->listRoles("6082607a3d19e39ae3b8ea7e");

// {"totalCount":1,"list":[{"code":"test_role_code","namespace":"default","arn":"arn:cn:authing:5f819ffdaaf252c4df2c9266:role:6076a2f503bbc684184a7ed9","description":"\u6d4b\u8bd5\u4f7f\u7528\u7684 test_role_code","createdAt":"2021-04-14T08:08:21+00:00","updatedAt":"2021-04-14T08:08:21+00:00","parent":null}]}

// 添加角色
// UsersManagementClient->addRoles(string $userId, array $roles)
$res = $userManageClient->addRoles(
    "608bd543d56f1f0def27c228",
    ["test_role_code"]
);

// {"message":"\u6388\u6743\u89d2\u8272\u6210\u529f","code":200}


// 移除角色
// UsersManagementClient->removeRoles(string $userId, array $roles)
$res = $userManageClient->removeRoles(
    "608bd543d56f1f0def27c228",
    ["test_role_code"]
);

// {"message":"\u64a4\u9500\u89d2\u8272\u6210\u529f","code":200}


// 判断用户是否有某个角色
// UsersManagementClient->hasRole(string $userId, string $roleCode, string $namespace)
// $namespace = 'code';
// $roleCode = 'roleCode';
// $res = $userManageClient->hasRole('608bd543d56f1f0def27c228', 'test_role_code', 'default');

// false

// 获取用户被授权的所有资源列表
// UsersManagementClient->listAuthorizedResources(string $userId, string $namespace, array options = [])
// use Authing\Mgmt\RolesManagementClient;
// use Authing\Mgmt\UsersManagementClient;

// $managementClient = new ManagementClient('USERPOOL_ID', 'SECRET');

// $userManagementClient = $managementClient->users();

$res = $userManageClient->listAuthorizedResources('6082607a3d19e39ae3b8ea7e', "default");

// {"list":[{"code":"test_resource:*","type":"DATA","actions":["*"]}],"totalCount":1}


// 获取审计日志列表
// UsersManagementClient->listArchivedUsers(int $page = 1, int $limit = 10)
// $usersManagementClient->listArchivedUsers();

echo json_encode($res);


echo '';