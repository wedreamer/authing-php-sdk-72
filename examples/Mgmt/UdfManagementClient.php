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

$udfsManagementClient = $management->udfs();
// $udfsManagementClient->paginate // 获取自定义字段定义
// $udfsManagementClient->set   // 设置自定义字段元数据
// $udfsManagementClient->remove // 删除自定义字段

// 设置自定义字段元数据
// UdfManagementClient->set(string $targetType, string $key, string $dataType, string $label)
use Authing\Types\UDFTargetType;
use Authing\Types\UDFDataType;

$res = $udfsManagementClient->set(
    UDFTargetType::USER,
    "setkey",
    UDFDataType::STRING,
    "test set user udf"
);

// {"targetType":"USER","dataType":"STRING","key":"setkey","label":"test set user udf","options":null}

// 删除自定义字段
// UdfManagementClient->remove(string $targetType, string $key)
$res = $udfsManagementClient->remove(
    UDFTargetType::USER, 
    "setkey"
);

// {"message":null,"code":200}

// 获取自定义字段定义
// UdfManagementClient->paginate(string $targetType)
$res = $udfsManagementClient->paginate(UDFTargetType::USER);

// [{"targetType":"USER","dataType":"STRING","key":"key","label":"key","options":null},{"targetType":"USER","dataType":"STRING","key":"test","label":"test","options":null},{"targetType":"USER","dataType":"STRING","key":"school","label":"\u5b66\u6821","options":null},{"targetType":"USER","dataType":"STRING","key":"age","label":"\u5e74\u9f84","options":null},{"targetType":"USER","dataType":"STRING","key":"6082607a3d19e39ae3b8ea7e","label":"test set user udf","options":null}]

// 获取自定义字段数据列表
// UdfManagementClient->listUdv(string $targetType, string $targetId)
// use Authing\Types\UDFTargetType;

$res = $udfsManagementClient->listUdv(UDFTargetType::USER, '6082607a3d19e39ae3b8ea7e');

// [{"key":"key","dataType":"STRING","value":"","label":"key"},{"key":"test","dataType":"STRING","value":"","label":"test"},{"key":"school","dataType":"STRING","value":"","label":"\u5b66\u6821"},{"key":"age","dataType":"STRING","value":"","label":"\u5e74\u9f84"},{"key":"6082607a3d19e39ae3b8ea7e","dataType":"STRING","value":"","label":"test set user udf"}]

// 批量添加自定义数据
// UdfManagementClient->setUdvBatch(string $targetType, string $targetId, array $udvList)
// use Authing\Types\UDFTargetType;

$res = $udfsManagementClient->setUdvBatch(UDFTargetType::USER, '6082607a3d19e39ae3b8ea7e', [
    (object) [
        'key' => 'test',
        'value' => 'this is value',
    ],
]);

// [{"key":"key","dataType":"STRING","value":"","label":"key"},{"key":"test","dataType":"STRING","value":"this is value","label":"test"},{"key":"school","dataType":"STRING","value":"","label":"\u5b66\u6821"},{"key":"age","dataType":"STRING","value":"","label":"\u5e74\u9f84"},{"key":"6082607a3d19e39ae3b8ea7e","dataType":"STRING","value":"","label":"test set user udf"}]


echo json_encode($res);


echo '';