<?php

declare(strict_types=1);
namespace Authing\Mgmt;



use Authing\Mgmt\ManagementClient;

$manageClient = new ManagementClient('YOUR_USERPOOL_ID', 'YOUR_USERPOOL_SECRET');

$udfsManagementClient = $managementClient->udfs();
// $udfsManagementClient->paginate // 获取自定义字段定义
// $udfsManagementClient->set   // 设置自定义字段元数据
// $udfsManagementClient->remove // 删除自定义字段

// 设置自定义字段元数据
// UdfManagementClient->set(string $targetType, string $key, string $dataType, string $label)
// use Authing\Types\UDFTargetType;

// $udf = $managementClient->udf()->set(
//     UDFTargetType::USER,
//     "key",
//     UDFDataType::STRING,
//     "label"
// );


// 删除自定义字段
// UdfManagementClient->remove(string $targetType, string $key)
// $message = $managementClient->udf()->remove(
//     UDFTargetType::USER, 
//     "key"
// );

// 获取自定义字段定义
// UdfManagementClient->paginate(string $targetType)
// $udfs = $managementClient->udf()->paginate(UDFTargetType::USER);

// 获取自定义字段数据列表
// UdfManagementClient->listUdv(string $targetType, string $targetId)
// use Authing\Types\UDFTargetType;

// $res = $udfManageClient->listUdv(UDFTargetType::USER, 'targetId');


// 批量添加自定义数据
// UdfManagementClient->setUdvBatch(string $targetType, string $targetId, array $udvList)
// use Authing\Types\UDFTargetType;

// $res = $udfManageClient->setUdvBatch(UDFTargetType::USER, 'userId', [
//     (object) [
//         'key' => '好家伙',
//         'value' => 'this is value',
//     ],
// ]);



