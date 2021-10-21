<?php

declare(strict_types=1);
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;

// 初始化资源与权限客户端
// 通过用户池 id 与 用户池密码进行初始化
// 通过回调函数进行初始化

$management = new ManagementClient(function ($options) {
    $options->userPoolId = 'userPoolId';
    $options->secret = 'secret';
    // $options->host = 'http://localhost:3000';
});

// $management->setHost('http://localhost:3000');

$orgManagementClient = $management->orgs();


# 创建组织机构
// $orgManagementClient->create(string $name, string $description = null, string $code = null)
/* $res = $orgManagementClient->create('test-code', '新建的组织结构', '这是 code');
{
    "id": "617019aa0c95ff54d8733707",
    "rootNode": {
        "id": "617019aa70d6f911f0b9acdf",
        "orgId": "617019aa0c95ff54d8733707",
        "name": "test-code",
        "nameI18n": null,
        "description": "新建的组织结构",
        "descriptionI18n": null,
        "order": null,
        "code": "这是 code",
        "root": true,
        "depth": null,
        "path": [
            "617019aa70d6f911f0b9acdf"
        ],
        "createdAt": "2021-10-20T13:29:14+00:00",
        "updatedAt": "2021-10-20T13:29:14+00:00",
        "children": []
    },
    "nodes": [
        {
            "id": "617019aa70d6f911f0b9acdf",
            "orgId": "617019aa0c95ff54d8733707",
            "name": "test-code",
            "nameI18n": null,
            "description": "新建的组织结构",
            "descriptionI18n": null,
            "order": null,
            "code": "这是 code",
            "root": true,
            "depth": 0,
            "path": [
                "617019aa70d6f911f0b9acdf"
            ],
            "createdAt": "2021-10-20T13:29:14+00:00",
            "updatedAt": "2021-10-20T13:29:14+00:00",
            "children": []
        }
    ]
} */

# 删除组织机构
// $orgManagementClient->deleteById($id)
/* $res = $orgManagementClient->deleteById('617019aa0c95ff54d8733707');
{
    "message": "delete org succeed",
    "code": 200
} */

# 获取用户池组织机构列表
// $orgManagementClient->paginate(int $page = 1, int $limit = 10)
/* $res = $orgManagementClient->paginate();
{
    "totalCount": 2,
    "list": [
        {
            "id": "6152ed0b98025509e781baac",
            "rootNode": {
                "id": "6152ed0bbd01314a95cb8ef7",
                "name": "test1",
                "nameI18n": null,
                "path": [
                    "6152ed0bbd01314a95cb8ef7"
                ],
                "description": "a s d ",
                "descriptionI18n": null,
                "order": null,
                "code": "aasd",
                "root": true,
                "depth": null,
                "createdAt": "2021-09-28T10:23:07+00:00",
                "updatedAt": "2021-09-28T10:23:07+00:00",
                "children": [
                    "6152ed55bac559fbbc37664c"
                ]
            },
            "nodes": [
                {
                    "id": "6152ed0bbd01314a95cb8ef7",
                    "name": "test1",
                    "path": [
                        "6152ed0bbd01314a95cb8ef7"
                    ],
                    "nameI18n": null,
                    "description": "a s d ",
                    "descriptionI18n": null,
                    "order": null,
                    "code": "aasd",
                    "root": true,
                    "depth": 0,
                    "createdAt": "2021-09-28T10:23:07+00:00",
                    "updatedAt": "2021-09-28T10:23:07+00:00",
                    "children": [
                        {
                            "id": "6152ed55bac559fbbc37664c",
                            "name": "撒大声的唱去问问",
                            "path": [
                                "6152ed0bbd01314a95cb8ef7",
                                "6152ed55bac559fbbc37664c"
                            ],
                            "nameI18n": null,
                            "description": null,
                            "descriptionI18n": null,
                            "order": null,
                            "code": "qwe",
                            "root": false,
                            "depth": 1,
                            "createdAt": "2021-09-28T10:24:21+00:00",
                            "updatedAt": "2021-09-28T10:24:21+00:00",
                            "children": []
                        }
                    ]
                },
                {
                    "id": "6152ed55bac559fbbc37664c",
                    "name": "撒大声的唱去问问",
                    "path": [
                        "6152ed0bbd01314a95cb8ef7",
                        "6152ed55bac559fbbc37664c"
                    ],
                    "nameI18n": null,
                    "description": null,
                    "descriptionI18n": null,
                    "order": null,
                    "code": "qwe",
                    "root": false,
                    "depth": 1,
                    "createdAt": "2021-09-28T10:24:21+00:00",
                    "updatedAt": "2021-09-28T10:24:21+00:00",
                    "children": []
                }
            ],
            "tree": {
                "id": "6152ed0bbd01314a95cb8ef7",
                "name": "test1",
                "path": [
                    "6152ed0bbd01314a95cb8ef7"
                ],
                "nameI18n": null,
                "description": "a s d ",
                "descriptionI18n": null,
                "order": null,
                "code": "aasd",
                "root": true,
                "depth": 0,
                "createdAt": "2021-09-28T10:23:07+00:00",
                "updatedAt": "2021-09-28T10:23:07+00:00",
                "children": [
                    {
                        "id": "6152ed55bac559fbbc37664c",
                        "name": "撒大声的唱去问问",
                        "path": [
                            "6152ed0bbd01314a95cb8ef7",
                            "6152ed55bac559fbbc37664c"
                        ],
                        "nameI18n": null,
                        "description": null,
                        "descriptionI18n": null,
                        "order": null,
                        "code": "qwe",
                        "root": false,
                        "depth": 1,
                        "createdAt": "2021-09-28T10:24:21+00:00",
                        "updatedAt": "2021-09-28T10:24:21+00:00",
                        "children": []
                    }
                ]
            }
        },
        {
            "id": "611b62c23b89a13537af7120",
            "rootNode": {
                "id": "611b62c2795bcf478b5e7263",
                "name": "Users",
                "nameI18n": null,
                "path": [
                    "611b62c2795bcf478b5e7263"
                ],
                "description": "这是根组织",
                "descriptionI18n": null,
                "order": null,
                "code": "asdasdasd",
                "root": true,
                "depth": null,
                "createdAt": "2021-08-17T07:18:26+00:00",
                "updatedAt": "2021-08-17T07:18:26+00:00",
                "children": [
                    "611b702c4c48958c4f9d2113"
                ]
            },
            "nodes": [
                {
                    "id": "611b62c2795bcf478b5e7263",
                    "name": "Users",
                    "path": [
                        "611b62c2795bcf478b5e7263"
                    ],
                    "nameI18n": null,
                    "description": "这是根组织",
                    "descriptionI18n": null,
                    "order": null,
                    "code": "asdasdasd",
                    "root": true,
                    "depth": 0,
                    "createdAt": "2021-08-17T07:18:26+00:00",
                    "updatedAt": "2021-08-17T07:18:26+00:00",
                    "children": [
                        {
                            "id": "611b702c4c48958c4f9d2113",
                            "name": "李新涛111",
                            "path": [
                                "611b62c2795bcf478b5e7263",
                                "611b702c4c48958c4f9d2113"
                            ],
                            "nameI18n": null,
                            "description": null,
                            "descriptionI18n": null,
                            "order": null,
                            "code": "111110",
                            "root": false,
                            "depth": 1,
                            "createdAt": "2021-08-17T08:15:40+00:00",
                            "updatedAt": "2021-08-17T08:15:40+00:00",
                            "children": []
                        }
                    ]
                },
                {
                    "id": "611b702c4c48958c4f9d2113",
                    "name": "李新涛111",
                    "path": [
                        "611b62c2795bcf478b5e7263",
                        "611b702c4c48958c4f9d2113"
                    ],
                    "nameI18n": null,
                    "description": null,
                    "descriptionI18n": null,
                    "order": null,
                    "code": "111110",
                    "root": false,
                    "depth": 1,
                    "createdAt": "2021-08-17T08:15:40+00:00",
                    "updatedAt": "2021-08-17T08:15:40+00:00",
                    "children": []
                }
            ],
            "tree": {
                "id": "611b62c2795bcf478b5e7263",
                "name": "Users",
                "path": [
                    "611b62c2795bcf478b5e7263"
                ],
                "nameI18n": null,
                "description": "这是根组织",
                "descriptionI18n": null,
                "order": null,
                "code": "asdasdasd",
                "root": true,
                "depth": 0,
                "createdAt": "2021-08-17T07:18:26+00:00",
                "updatedAt": "2021-08-17T07:18:26+00:00",
                "children": [
                    {
                        "id": "611b702c4c48958c4f9d2113",
                        "name": "李新涛111",
                        "path": [
                            "611b62c2795bcf478b5e7263",
                            "611b702c4c48958c4f9d2113"
                        ],
                        "nameI18n": null,
                        "description": null,
                        "descriptionI18n": null,
                        "order": null,
                        "code": "111110",
                        "root": false,
                        "depth": 1,
                        "createdAt": "2021-08-17T08:15:40+00:00",
                        "updatedAt": "2021-08-17T08:15:40+00:00",
                        "children": []
                    }
                ]
            }
        }
    ]
} */

# 添加节点
// $orgManagementClient->addNode($orgId, $parentNodeId, $data)
/* $res = $orgManagementClient->addNode('6152ed0b98025509e781baac', '6152ed55bac559fbbc37664c', [
    'name' => '测试节点',
    'code' => 'test-code',
    'description' => '测试描述',
]);
{
    "id": "61701d7f45eeab12fd9eee37",
    "orgId": "6152ed0b98025509e781baac",
    "name": "测试节点",
    "nameI18n": null,
    "description": "测试描述",
    "descriptionI18n": null,
    "order": null,
    "code": "test-code",
    "root": false,
    "depth": null,
    "path": [
        "6152ed0bbd01314a95cb8ef7",
        "6152ed55bac559fbbc37664c",
        "61701d7f45eeab12fd9eee37"
    ],
    "createdAt": "2021-10-20T13:45:35+00:00",
    "updatedAt": "2021-10-20T13:45:35+00:00",
    "children": []
} */

# 修改节点
// $orgManagementClient->updateNode($id, $updates)
/* $res = $orgManagementClient->updateNode('6152ed55bac559fbbc37664c', [
    'code' => 'new_code'
]);
{
    "id": "6152ed55bac559fbbc37664c",
    "orgId": "6152ed0b98025509e781baac",
    "name": "撒大声的唱去问问",
    "nameI18n": null,
    "description": null,
    "descriptionI18n": null,
    "order": null,
    "code": "new_code",
    "root": false,
    "depth": null,
    "path": [
        "6152ed0bbd01314a95cb8ef7",
        "6152ed55bac559fbbc37664c"
    ],
    "createdAt": "2021-09-28T10:24:21+00:00",
    "updatedAt": "2021-10-20T13:47:47+00:00",
    "children": [
        "61701d7f45eeab12fd9eee37"
    ],
    "users": {
        "totalCount": 0
    }
} */

# 获取组织机构详情
// $orgManagementClient->findById($id)
/* $res = $orgManagementClient->findById('6152ed0b98025509e781baac');
{
    "id": "6152ed0b98025509e781baac",
    "rootNode": {
        "id": "6152ed0bbd01314a95cb8ef7",
        "orgId": "6152ed0b98025509e781baac",
        "name": "test1",
        "nameI18n": null,
        "description": "a s d ",
        "descriptionI18n": null,
        "order": null,
        "code": "aasd",
        "root": true,
        "depth": null,
        "path": [
            "6152ed0bbd01314a95cb8ef7"
        ],
        "createdAt": "2021-09-28T10:23:07+00:00",
        "updatedAt": "2021-09-28T10:23:07+00:00",
        "children": [
            "6152ed55bac559fbbc37664c"
        ]
    },
    "nodes": [
        {
            "id": "61701d7f45eeab12fd9eee37",
            "orgId": "6152ed0b98025509e781baac",
            "name": "测试节点",
            "nameI18n": null,
            "description": "测试描述",
            "descriptionI18n": null,
            "order": null,
            "code": "test-code",
            "root": false,
            "depth": 2,
            "path": [
                "6152ed0bbd01314a95cb8ef7",
                "6152ed55bac559fbbc37664c",
                "61701d7f45eeab12fd9eee37"
            ],
            "createdAt": "2021-10-20T13:45:35+00:00",
            "updatedAt": "2021-10-20T13:45:35+00:00",
            "children": []
        },
        {
            "id": "6152ed0bbd01314a95cb8ef7",
            "orgId": "6152ed0b98025509e781baac",
            "name": "test1",
            "nameI18n": null,
            "description": "a s d ",
            "descriptionI18n": null,
            "order": null,
            "code": "aasd",
            "root": true,
            "depth": 0,
            "path": [
                "6152ed0bbd01314a95cb8ef7"
            ],
            "createdAt": "2021-09-28T10:23:07+00:00",
            "updatedAt": "2021-09-28T10:23:07+00:00",
            "children": [
                {
                    "id": "6152ed55bac559fbbc37664c",
                    "orgId": "6152ed0b98025509e781baac",
                    "name": "撒大声的唱去问问",
                    "nameI18n": null,
                    "description": null,
                    "descriptionI18n": null,
                    "order": null,
                    "code": "new_code",
                    "root": false,
                    "depth": 1,
                    "path": [
                        "6152ed0bbd01314a95cb8ef7",
                        "6152ed55bac559fbbc37664c"
                    ],
                    "createdAt": "2021-09-28T10:24:21+00:00",
                    "updatedAt": "2021-10-20T13:47:47+00:00",
                    "children": [
                        "61701d7f45eeab12fd9eee37"
                    ]
                }
            ]
        },
        {
            "id": "6152ed55bac559fbbc37664c",
            "orgId": "6152ed0b98025509e781baac",
            "name": "撒大声的唱去问问",
            "nameI18n": null,
            "description": null,
            "descriptionI18n": null,
            "order": null,
            "code": "new_code",
            "root": false,
            "depth": 1,
            "path": [
                "6152ed0bbd01314a95cb8ef7",
                "6152ed55bac559fbbc37664c"
            ],
            "createdAt": "2021-09-28T10:24:21+00:00",
            "updatedAt": "2021-10-20T13:47:47+00:00",
            "children": [
                "61701d7f45eeab12fd9eee37"
            ]
        }
    ],
    "tree": {
        "id": "6152ed0bbd01314a95cb8ef7",
        "orgId": "6152ed0b98025509e781baac",
        "name": "test1",
        "nameI18n": null,
        "description": "a s d ",
        "descriptionI18n": null,
        "order": null,
        "code": "aasd",
        "root": true,
        "depth": 0,
        "path": [
            "6152ed0bbd01314a95cb8ef7"
        ],
        "createdAt": "2021-09-28T10:23:07+00:00",
        "updatedAt": "2021-09-28T10:23:07+00:00",
        "children": [
            {
                "id": "6152ed55bac559fbbc37664c",
                "orgId": "6152ed0b98025509e781baac",
                "name": "撒大声的唱去问问",
                "nameI18n": null,
                "description": null,
                "descriptionI18n": null,
                "order": null,
                "code": "new_code",
                "root": false,
                "depth": 1,
                "path": [
                    "6152ed0bbd01314a95cb8ef7",
                    "6152ed55bac559fbbc37664c"
                ],
                "createdAt": "2021-09-28T10:24:21+00:00",
                "updatedAt": "2021-10-20T13:47:47+00:00",
                "children": [
                    "61701d7f45eeab12fd9eee37"
                ]
            }
        ]
    }
} */

# 删除节点
// $orgManagementClient->deleteNode($orgId, $nodeId)
/* $res = $orgManagementClient->deleteNode('6152ed0b98025509e781baac', '617020a9fdb39ee26b73fd55');
{
    "message": "删除成功",
    "code": 200
} */

# 移动节点
// $orgManagementClient->moveNode($orgId, $nodeId, $targetParentId)
/* $res = $orgManagementClient->moveNode('6152ed0b98025509e781baac', '61701d7f45eeab12fd9eee37', '6152ed0bbd01314a95cb8ef7');
{
    "id": "6152ed0b98025509e781baac",
    "rootNode": {
        "id": "6152ed0bbd01314a95cb8ef7",
        "orgId": "6152ed0b98025509e781baac",
        "name": "test1",
        "nameI18n": null,
        "description": "a s d ",
        "descriptionI18n": null,
        "order": null,
        "code": "aasd",
        "root": true,
        "depth": null,
        "path": [
            "6152ed0bbd01314a95cb8ef7"
        ],
        "createdAt": "2021-09-28T10:23:07+00:00",
        "updatedAt": "2021-09-28T10:23:07+00:00",
        "children": [
            "61701d7f45eeab12fd9eee37",
            "6152ed55bac559fbbc37664c"
        ]
    },
    "nodes": [
        {
            "id": "61701d7f45eeab12fd9eee37",
            "orgId": "6152ed0b98025509e781baac",
            "name": "测试节点",
            "nameI18n": null,
            "description": "测试描述",
            "descriptionI18n": null,
            "order": null,
            "code": "test-code",
            "root": false,
            "depth": 1,
            "path": [
                "6152ed0bbd01314a95cb8ef7",
                "61701d7f45eeab12fd9eee37"
            ],
            "createdAt": "2021-10-20T13:45:35+00:00",
            "updatedAt": "2021-10-20T13:45:35+00:00",
            "children": []
        },
        {
            "id": "6152ed0bbd01314a95cb8ef7",
            "orgId": "6152ed0b98025509e781baac",
            "name": "test1",
            "nameI18n": null,
            "description": "a s d ",
            "descriptionI18n": null,
            "order": null,
            "code": "aasd",
            "root": true,
            "depth": 0,
            "path": [
                "6152ed0bbd01314a95cb8ef7"
            ],
            "createdAt": "2021-09-28T10:23:07+00:00",
            "updatedAt": "2021-09-28T10:23:07+00:00",
            "children": [
                {
                    "id": "61701d7f45eeab12fd9eee37",
                    "orgId": "6152ed0b98025509e781baac",
                    "name": "测试节点",
                    "nameI18n": null,
                    "description": "测试描述",
                    "descriptionI18n": null,
                    "order": null,
                    "code": "test-code",
                    "root": false,
                    "depth": 1,
                    "path": [
                        "6152ed0bbd01314a95cb8ef7",
                        "61701d7f45eeab12fd9eee37"
                    ],
                    "createdAt": "2021-10-20T13:45:35+00:00",
                    "updatedAt": "2021-10-20T13:45:35+00:00",
                    "children": []
                },
                {
                    "id": "6152ed55bac559fbbc37664c",
                    "orgId": "6152ed0b98025509e781baac",
                    "name": "撒大声的唱去问问",
                    "nameI18n": null,
                    "description": null,
                    "descriptionI18n": null,
                    "order": null,
                    "code": "new_code",
                    "root": false,
                    "depth": 1,
                    "path": [
                        "6152ed0bbd01314a95cb8ef7",
                        "6152ed55bac559fbbc37664c"
                    ],
                    "createdAt": "2021-09-28T10:24:21+00:00",
                    "updatedAt": "2021-10-20T13:47:47+00:00",
                    "children": []
                }
            ]
        },
        {
            "id": "6152ed55bac559fbbc37664c",
            "orgId": "6152ed0b98025509e781baac",
            "name": "撒大声的唱去问问",
            "nameI18n": null,
            "description": null,
            "descriptionI18n": null,
            "order": null,
            "code": "new_code",
            "root": false,
            "depth": 1,
            "path": [
                "6152ed0bbd01314a95cb8ef7",
                "6152ed55bac559fbbc37664c"
            ],
            "createdAt": "2021-09-28T10:24:21+00:00",
            "updatedAt": "2021-10-20T13:47:47+00:00",
            "children": []
        }
    ],
    "tree": {
        "id": "6152ed0bbd01314a95cb8ef7",
        "orgId": "6152ed0b98025509e781baac",
        "name": "test1",
        "nameI18n": null,
        "description": "a s d ",
        "descriptionI18n": null,
        "order": null,
        "code": "aasd",
        "root": true,
        "depth": 0,
        "path": [
            "6152ed0bbd01314a95cb8ef7"
        ],
        "createdAt": "2021-09-28T10:23:07+00:00",
        "updatedAt": "2021-09-28T10:23:07+00:00",
        "children": [
            {
                "id": "61701d7f45eeab12fd9eee37",
                "orgId": "6152ed0b98025509e781baac",
                "name": "测试节点",
                "nameI18n": null,
                "description": "测试描述",
                "descriptionI18n": null,
                "order": null,
                "code": "test-code",
                "root": false,
                "depth": 1,
                "path": [
                    "6152ed0bbd01314a95cb8ef7",
                    "61701d7f45eeab12fd9eee37"
                ],
                "createdAt": "2021-10-20T13:45:35+00:00",
                "updatedAt": "2021-10-20T13:45:35+00:00",
                "children": []
            },
            {
                "id": "6152ed55bac559fbbc37664c",
                "orgId": "6152ed0b98025509e781baac",
                "name": "撒大声的唱去问问",
                "nameI18n": null,
                "description": null,
                "descriptionI18n": null,
                "order": null,
                "code": "new_code",
                "root": false,
                "depth": 1,
                "path": [
                    "6152ed0bbd01314a95cb8ef7",
                    "6152ed55bac559fbbc37664c"
                ],
                "createdAt": "2021-09-28T10:24:21+00:00",
                "updatedAt": "2021-10-20T13:47:47+00:00",
                "children": []
            }
        ]
    }
} */

# 判断是否为根节点
// $orgManagementClient->isRootNode($orgId, $nodeId)
/* $res = $orgManagementClient->isRootNode('6152ed0b98025509e781baac', '6152ed0bbd01314a95cb8ef7');
true */

# 获取子节点列表
// $orgManagementClient->listChildren($nodeId)
/* $res = $orgManagementClient->listChildren('6152ed0bbd01314a95cb8ef7');
[
    {
        "id": "61701d7f45eeab12fd9eee37",
        "orgId": "6152ed0b98025509e781baac",
        "name": "测试节点",
        "nameI18n": null,
        "description": "测试描述",
        "descriptionI18n": null,
        "order": null,
        "code": "test-code",
        "root": false,
        "depth": 1,
        "path": [
            "6152ed0bbd01314a95cb8ef7",
            "61701d7f45eeab12fd9eee37"
        ],
        "createdAt": "2021-10-20T13:45:35+00:00",
        "updatedAt": "2021-10-20T13:45:35+00:00",
        "children": []
    },
    {
        "id": "6152ed55bac559fbbc37664c",
        "orgId": "6152ed0b98025509e781baac",
        "name": "撒大声的唱去问问",
        "nameI18n": null,
        "description": null,
        "descriptionI18n": null,
        "order": null,
        "code": "new_code",
        "root": false,
        "depth": 1,
        "path": [
            "6152ed0bbd01314a95cb8ef7",
            "6152ed55bac559fbbc37664c"
        ],
        "createdAt": "2021-09-28T10:24:21+00:00",
        "updatedAt": "2021-10-20T13:47:47+00:00",
        "children": []
    }
] */

# 获取根节点
// $orgManagementClient->rootNode($orgId)
/* $res = $orgManagementClient->rootNode('6152ed0b98025509e781baac');
{
    "id": "6152ed0bbd01314a95cb8ef7",
    "orgId": "6152ed0b98025509e781baac",
    "name": "test1",
    "nameI18n": null,
    "description": "a s d ",
    "descriptionI18n": null,
    "order": null,
    "code": "aasd",
    "root": true,
    "depth": null,
    "path": [
        "6152ed0bbd01314a95cb8ef7"
    ],
    "codePath": [
        "aasd"
    ],
    "namePath": [
        "test1"
    ],
    "createdAt": "2021-09-28T10:23:07+00:00",
    "updatedAt": "2021-09-28T10:23:07+00:00",
    "children": [
        "61701d7f45eeab12fd9eee37",
        "6152ed55bac559fbbc37664c"
    ]
} */

# 通过 JSON 导入
// $orgManagementClient->importByJson($json)

# 添加成员
// TODO:: Error: 应该是接口错误
// $orgManagementClient->addMembers($nodeId, $userIds)
/* $res = $orgManagementClient->addMembers('61701d7f45eeab12fd9eee37', [
    '611b62a5937a49c2320cffe9',
    '611b62949fc80c485862ee94'
]); */

# 移动成员
// $orgManagementClient->moveMembers($options)
/* $res = $orgManagementClient->moveMembers([
    'userIds' => ['6165374a420f42805d1ca784'],
    'sourceNodeId' => '611b62c2795bcf478b5e7263',
    'targetNodeId' => '611b702c4c48958c4f9d2113'
]);
true */

# 获取节点成员
// $orgManagementClient->listMembers($nodeId, $options)
/* $res = $orgManagementClient->listMembers('611b62c2795bcf478b5e7263', [
    'includeChildrenNodes' => true
]);
{
    "totalCount": 4,
    "list": [
        {
            "id": "6165374a420f42805d1ca784",
            "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:6165374a420f42805d1ca784",
            "userPoolId": "611b62944c0d199eee1d98d2",
            "status": "Activated",
            "username": "test-ldap",
            "email": "test@test.com",
            "emailVerified": false,
            "phone": null,
            "phoneVerified": false,
            "unionid": null,
            "openid": null,
            "nickname": "测试用户",
            "registerSource": [
                "import:manual"
            ],
            "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
            "password": "3a4151238f9efd5f410dbc3e5e8eadda",
            "oauth": null,
            "token": null,
            "tokenExpiredAt": "1970-01-01T00:00:00+00:00",
            "loginsCount": 0,
            "lastLogin": null,
            "lastIP": null,
            "signedUp": "2021-10-12T07:20:42+00:00",
            "blocked": false,
            "isDeleted": false,
            "device": null,
            "browser": null,
            "company": null,
            "name": "测试用户",
            "givenName": "名字",
            "familyName": "姓",
            "middleName": null,
            "profile": null,
            "preferredUsername": null,
            "website": null,
            "gender": "U",
            "birthdate": null,
            "zoneinfo": null,
            "locale": null,
            "address": null,
            "formatted": null,
            "streetAddress": null,
            "locality": null,
            "region": null,
            "postalCode": null,
            "city": null,
            "province": null,
            "country": null,
            "createdAt": "2021-10-12T07:20:42+00:00",
            "updatedAt": "2021-10-15T08:15:57+00:00",
            "externalId": null
        },
        {
            "id": "611b62b44e26429f43b9da21",
            "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62b44e26429f43b9da21",
            "userPoolId": "611b62944c0d199eee1d98d2",
            "status": "Activated",
            "username": "222",
            "email": "222@test.com",
            "emailVerified": false,
            "phone": null,
            "phoneVerified": false,
            "unionid": null,
            "openid": null,
            "nickname": null,
            "registerSource": [
                "import:manual"
            ],
            "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
            "password": "16657a9792b0a0dee5d112c1380f791c",
            "oauth": null,
            "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cGRhdGVkX2F0IjoiMjAyMS0xMC0wOVQwODowOTowNy4yMjVaIiwiYWRkcmVzcyI6eyJjb3VudHJ5IjpudWxsLCJwb3N0YWxfY29kZSI6bnVsbCwicmVnaW9uIjpudWxsLCJmb3JtYXR0ZWQiOm51bGx9LCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJwaG9uZV9udW1iZXIiOm51bGwsImxvY2FsZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImJpcnRoZGF0ZSI6bnVsbCwiZ2VuZGVyIjoiVSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZW1haWwiOiIyMjJAdGVzdC5jb20iLCJ3ZWJzaXRlIjpudWxsLCJwaWN0dXJlIjoiaHR0cHM6Ly9maWxlcy5hdXRoaW5nLmNvL2F1dGhpbmctY29uc29sZS9kZWZhdWx0LXVzZXItYXZhdGFyLnBuZyIsInByb2ZpbGUiOm51bGwsInByZWZlcnJlZF91c2VybmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsIm1pZGRsZV9uYW1lIjpudWxsLCJmYW1pbHlfbmFtZSI6bnVsbCwiZ2l2ZW5fbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwic3ViIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwiZXh0ZXJuYWxfaWQiOm51bGwsInVuaW9uaWQiOm51bGwsInVzZXJuYW1lIjoiMjIyIiwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIiLCJhcHBJZCI6IjYxNjEyZDVlZWY4MzFmZGIxOWRjZWVlNSIsImlkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwidXNlcklkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwiX2lkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwicGhvbmUiOm51bGwsImVtYWlsIjoiMjIyQHRlc3QuY29tIiwidXNlcm5hbWUiOiIyMjIiLCJ1bmlvbmlkIjpudWxsLCJvcGVuaWQiOm51bGwsImNsaWVudElkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIn0sInVzZXJwb29sX2lkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIiwiYXVkIjoiNjE2MTJkNWVlZjgzMWZkYjE5ZGNlZWU1IiwiZXhwIjoxNjM1NDgwMDA2LCJpYXQiOjE2MzQyNzA0MDYsImlzcyI6Imh0dHBzOi8vc2h1YnV6dW8td3BzLmF1dGhpbmcuY24vb2lkYyJ9.mtv-lVoMAQs1lX8kV6iIrw4cO9CY5GI3ePwibbrE_90",
            "tokenExpiredAt": "2021-10-29T04:00:06+00:00",
            "loginsCount": 1,
            "lastLogin": "2021-10-15T04:00:06+00:00",
            "lastIP": "180.88.96.10",
            "signedUp": "2021-08-17T07:18:12+00:00",
            "blocked": false,
            "isDeleted": false,
            "device": null,
            "browser": null,
            "company": null,
            "name": null,
            "givenName": null,
            "familyName": null,
            "middleName": null,
            "profile": null,
            "preferredUsername": null,
            "website": null,
            "gender": "U",
            "birthdate": null,
            "zoneinfo": null,
            "locale": null,
            "address": null,
            "formatted": null,
            "streetAddress": null,
            "locality": null,
            "region": null,
            "postalCode": null,
            "city": null,
            "province": null,
            "country": null,
            "createdAt": "2021-08-17T07:18:12+00:00",
            "updatedAt": "2021-10-15T04:00:06+00:00",
            "externalId": null
        },
        {
            "id": "611b62a5937a49c2320cffe9",
            "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62a5937a49c2320cffe9",
            "userPoolId": "611b62944c0d199eee1d98d2",
            "status": "Activated",
            "username": "1111",
            "email": "1111@authing.cn",
            "emailVerified": false,
            "phone": null,
            "phoneVerified": false,
            "unionid": null,
            "openid": null,
            "nickname": null,
            "registerSource": [
                "import:manual"
            ],
            "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
            "password": "93092d3717b65043d59bc3e88455636d",
            "oauth": null,
            "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cGRhdGVkX2F0IjoiMjAyMS0xMC0yMFQxNDozNzoxNC4yMTBaIiwiYWRkcmVzcyI6eyJjb3VudHJ5IjpudWxsLCJwb3N0YWxfY29kZSI6bnVsbCwicmVnaW9uIjpudWxsLCJmb3JtYXR0ZWQiOm51bGx9LCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJwaG9uZV9udW1iZXIiOm51bGwsImxvY2FsZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImJpcnRoZGF0ZSI6bnVsbCwiZ2VuZGVyIjoiVSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZW1haWwiOiIxMTExQGF1dGhpbmcuY24iLCJ3ZWJzaXRlIjpudWxsLCJwaWN0dXJlIjoiaHR0cHM6Ly9maWxlcy5hdXRoaW5nLmNvL2F1dGhpbmctY29uc29sZS9kZWZhdWx0LXVzZXItYXZhdGFyLnBuZyIsInByb2ZpbGUiOm51bGwsInByZWZlcnJlZF91c2VybmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsIm1pZGRsZV9uYW1lIjpudWxsLCJmYW1pbHlfbmFtZSI6bnVsbCwiZ2l2ZW5fbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwic3ViIjoiNjExYjYyYTU5MzdhNDljMjMyMGNmZmU5IiwiZXh0ZXJuYWxfaWQiOm51bGwsInVuaW9uaWQiOm51bGwsInVzZXJuYW1lIjoiMTExMSIsImRhdGEiOnsidHlwZSI6InVzZXIiLCJ1c2VyUG9vbElkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIiwiYXBwSWQiOiI2MTYxMmQ1ZWVmODMxZmRiMTlkY2VlZTUiLCJpZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsInVzZXJJZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsIl9pZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsInBob25lIjpudWxsLCJlbWFpbCI6IjExMTFAYXV0aGluZy5jbiIsInVzZXJuYW1lIjoiMTExMSIsInVuaW9uaWQiOm51bGwsIm9wZW5pZCI6bnVsbCwiY2xpZW50SWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIifSwidXNlcnBvb2xfaWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIiLCJhdWQiOiI2MTYxMmQ1ZWVmODMxZmRiMTlkY2VlZTUiLCJleHAiOjE2MzU5NTA0NTYsImlhdCI6MTYzNDc0MDg1NiwiaXNzIjoiaHR0cHM6Ly9zaHVidXp1by13cHMuYXV0aGluZy5jbi9vaWRjIn0.-HPVAyCinmoguDtJ3H-zQH215joAfDDAoO-m8OvQ2gM",
            "tokenExpiredAt": "2021-11-03T14:40:56+00:00",
            "loginsCount": 77,
            "lastLogin": "2021-10-20T14:40:56+00:00",
            "lastIP": "113.106.106.3",
            "signedUp": "2021-08-17T07:17:57+00:00",
            "blocked": false,
            "isDeleted": false,
            "device": null,
            "browser": null,
            "company": null,
            "name": null,
            "givenName": null,
            "familyName": null,
            "middleName": null,
            "profile": null,
            "preferredUsername": null,
            "website": null,
            "gender": "U",
            "birthdate": null,
            "zoneinfo": null,
            "locale": null,
            "address": null,
            "formatted": null,
            "streetAddress": null,
            "locality": null,
            "region": null,
            "postalCode": null,
            "city": null,
            "province": null,
            "country": null,
            "createdAt": "2021-08-17T07:17:57+00:00",
            "updatedAt": "2021-10-20T14:40:56+00:00",
            "externalId": null
        },
        {
            "id": "611b62949fc80c485862ee94",
            "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62949fc80c485862ee94",
            "userPoolId": "611b62944c0d199eee1d98d2",
            "status": "Activated",
            "username": "test",
            "email": "5@authing.cn",
            "emailVerified": false,
            "phone": null,
            "phoneVerified": false,
            "unionid": null,
            "openid": null,
            "nickname": null,
            "registerSource": [
                "unknown"
            ],
            "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
            "password": null,
            "oauth": null,
            "token": null,
            "tokenExpiredAt": "1970-01-01T00:00:00+00:00",
            "loginsCount": 0,
            "lastLogin": null,
            "lastIP": null,
            "signedUp": "2021-08-17T07:17:40+00:00",
            "blocked": false,
            "isDeleted": false,
            "device": null,
            "browser": null,
            "company": null,
            "name": null,
            "givenName": null,
            "familyName": null,
            "middleName": null,
            "profile": null,
            "preferredUsername": null,
            "website": null,
            "gender": "U",
            "birthdate": null,
            "zoneinfo": null,
            "locale": null,
            "address": null,
            "formatted": null,
            "streetAddress": null,
            "locality": null,
            "region": null,
            "postalCode": null,
            "city": null,
            "province": null,
            "country": null,
            "createdAt": "2021-08-17T07:17:40+00:00",
            "updatedAt": "2021-09-27T03:57:57+00:00",
            "externalId": null
        }
    ]
} */

# 删除成员
// $orgManagementClient->removeMembers($nodeId, $userIds)
/* $res = $orgManagementClient->removeMembers('611b702c4c48958c4f9d2113', ['6165374a420f42805d1ca784']);
{
    "id": "611b702c4c48958c4f9d2113",
    "name": "李新涛111",
    "nameI18n": null,
    "description": null,
    "descriptionI18n": null,
    "order": null,
    "code": "111110",
    "root": false,
    "depth": null,
    "createdAt": "2021-08-17T08:15:40+00:00",
    "updatedAt": "2021-08-17T08:15:40+00:00",
    "children": [],
    "users": {
        "totalCount": 3,
        "list": [
            {
                "id": "611b62b44e26429f43b9da21",
                "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62b44e26429f43b9da21",
                "userPoolId": "611b62944c0d199eee1d98d2",
                "status": "Activated",
                "username": "222",
                "email": "222@test.com",
                "emailVerified": false,
                "phone": null,
                "phoneVerified": false,
                "unionid": null,
                "openid": null,
                "nickname": null,
                "registerSource": [
                    "import:manual"
                ],
                "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
                "password": "16657a9792b0a0dee5d112c1380f791c",
                "oauth": null,
                "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cGRhdGVkX2F0IjoiMjAyMS0xMC0wOVQwODowOTowNy4yMjVaIiwiYWRkcmVzcyI6eyJjb3VudHJ5IjpudWxsLCJwb3N0YWxfY29kZSI6bnVsbCwicmVnaW9uIjpudWxsLCJmb3JtYXR0ZWQiOm51bGx9LCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJwaG9uZV9udW1iZXIiOm51bGwsImxvY2FsZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImJpcnRoZGF0ZSI6bnVsbCwiZ2VuZGVyIjoiVSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZW1haWwiOiIyMjJAdGVzdC5jb20iLCJ3ZWJzaXRlIjpudWxsLCJwaWN0dXJlIjoiaHR0cHM6Ly9maWxlcy5hdXRoaW5nLmNvL2F1dGhpbmctY29uc29sZS9kZWZhdWx0LXVzZXItYXZhdGFyLnBuZyIsInByb2ZpbGUiOm51bGwsInByZWZlcnJlZF91c2VybmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsIm1pZGRsZV9uYW1lIjpudWxsLCJmYW1pbHlfbmFtZSI6bnVsbCwiZ2l2ZW5fbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwic3ViIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwiZXh0ZXJuYWxfaWQiOm51bGwsInVuaW9uaWQiOm51bGwsInVzZXJuYW1lIjoiMjIyIiwiZGF0YSI6eyJ0eXBlIjoidXNlciIsInVzZXJQb29sSWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIiLCJhcHBJZCI6IjYxNjEyZDVlZWY4MzFmZGIxOWRjZWVlNSIsImlkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwidXNlcklkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwiX2lkIjoiNjExYjYyYjQ0ZTI2NDI5ZjQzYjlkYTIxIiwicGhvbmUiOm51bGwsImVtYWlsIjoiMjIyQHRlc3QuY29tIiwidXNlcm5hbWUiOiIyMjIiLCJ1bmlvbmlkIjpudWxsLCJvcGVuaWQiOm51bGwsImNsaWVudElkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIn0sInVzZXJwb29sX2lkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIiwiYXVkIjoiNjE2MTJkNWVlZjgzMWZkYjE5ZGNlZWU1IiwiZXhwIjoxNjM1NDgwMDA2LCJpYXQiOjE2MzQyNzA0MDYsImlzcyI6Imh0dHBzOi8vc2h1YnV6dW8td3BzLmF1dGhpbmcuY24vb2lkYyJ9.mtv-lVoMAQs1lX8kV6iIrw4cO9CY5GI3ePwibbrE_90",
                "tokenExpiredAt": "2021-10-29T04:00:06+00:00",
                "loginsCount": 1,
                "lastLogin": "2021-10-15T04:00:06+00:00",
                "lastIP": "180.88.96.10",
                "signedUp": "2021-08-17T07:18:12+00:00",
                "blocked": false,
                "isDeleted": false,
                "device": null,
                "browser": null,
                "company": null,
                "name": null,
                "givenName": null,
                "familyName": null,
                "middleName": null,
                "profile": null,
                "preferredUsername": null,
                "website": null,
                "gender": "U",
                "birthdate": null,
                "zoneinfo": null,
                "locale": null,
                "address": null,
                "formatted": null,
                "streetAddress": null,
                "locality": null,
                "region": null,
                "postalCode": null,
                "city": null,
                "province": null,
                "country": null,
                "createdAt": "2021-08-17T07:18:12+00:00",
                "updatedAt": "2021-10-15T04:00:06+00:00"
            },
            {
                "id": "611b62a5937a49c2320cffe9",
                "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62a5937a49c2320cffe9",
                "userPoolId": "611b62944c0d199eee1d98d2",
                "status": "Activated",
                "username": "1111",
                "email": "1111@authing.cn",
                "emailVerified": false,
                "phone": null,
                "phoneVerified": false,
                "unionid": null,
                "openid": null,
                "nickname": null,
                "registerSource": [
                    "import:manual"
                ],
                "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
                "password": "93092d3717b65043d59bc3e88455636d",
                "oauth": null,
                "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1cGRhdGVkX2F0IjoiMjAyMS0xMC0yMFQxNDozNzoxNC4yMTBaIiwiYWRkcmVzcyI6eyJjb3VudHJ5IjpudWxsLCJwb3N0YWxfY29kZSI6bnVsbCwicmVnaW9uIjpudWxsLCJmb3JtYXR0ZWQiOm51bGx9LCJwaG9uZV9udW1iZXJfdmVyaWZpZWQiOmZhbHNlLCJwaG9uZV9udW1iZXIiOm51bGwsImxvY2FsZSI6bnVsbCwiem9uZWluZm8iOm51bGwsImJpcnRoZGF0ZSI6bnVsbCwiZ2VuZGVyIjoiVSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZW1haWwiOiIxMTExQGF1dGhpbmcuY24iLCJ3ZWJzaXRlIjpudWxsLCJwaWN0dXJlIjoiaHR0cHM6Ly9maWxlcy5hdXRoaW5nLmNvL2F1dGhpbmctY29uc29sZS9kZWZhdWx0LXVzZXItYXZhdGFyLnBuZyIsInByb2ZpbGUiOm51bGwsInByZWZlcnJlZF91c2VybmFtZSI6bnVsbCwibmlja25hbWUiOm51bGwsIm1pZGRsZV9uYW1lIjpudWxsLCJmYW1pbHlfbmFtZSI6bnVsbCwiZ2l2ZW5fbmFtZSI6bnVsbCwibmFtZSI6bnVsbCwic3ViIjoiNjExYjYyYTU5MzdhNDljMjMyMGNmZmU5IiwiZXh0ZXJuYWxfaWQiOm51bGwsInVuaW9uaWQiOm51bGwsInVzZXJuYW1lIjoiMTExMSIsImRhdGEiOnsidHlwZSI6InVzZXIiLCJ1c2VyUG9vbElkIjoiNjExYjYyOTQ0YzBkMTk5ZWVlMWQ5OGQyIiwiYXBwSWQiOiI2MTYxMmQ1ZWVmODMxZmRiMTlkY2VlZTUiLCJpZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsInVzZXJJZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsIl9pZCI6IjYxMWI2MmE1OTM3YTQ5YzIzMjBjZmZlOSIsInBob25lIjpudWxsLCJlbWFpbCI6IjExMTFAYXV0aGluZy5jbiIsInVzZXJuYW1lIjoiMTExMSIsInVuaW9uaWQiOm51bGwsIm9wZW5pZCI6bnVsbCwiY2xpZW50SWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIifSwidXNlcnBvb2xfaWQiOiI2MTFiNjI5NDRjMGQxOTllZWUxZDk4ZDIiLCJhdWQiOiI2MTYxMmQ1ZWVmODMxZmRiMTlkY2VlZTUiLCJleHAiOjE2MzU5NTA0NTYsImlhdCI6MTYzNDc0MDg1NiwiaXNzIjoiaHR0cHM6Ly9zaHVidXp1by13cHMuYXV0aGluZy5jbi9vaWRjIn0.-HPVAyCinmoguDtJ3H-zQH215joAfDDAoO-m8OvQ2gM",
                "tokenExpiredAt": "2021-11-03T14:40:56+00:00",
                "loginsCount": 77,
                "lastLogin": "2021-10-20T14:40:56+00:00",
                "lastIP": "113.106.106.3",
                "signedUp": "2021-08-17T07:17:57+00:00",
                "blocked": false,
                "isDeleted": false,
                "device": null,
                "browser": null,
                "company": null,
                "name": null,
                "givenName": null,
                "familyName": null,
                "middleName": null,
                "profile": null,
                "preferredUsername": null,
                "website": null,
                "gender": "U",
                "birthdate": null,
                "zoneinfo": null,
                "locale": null,
                "address": null,
                "formatted": null,
                "streetAddress": null,
                "locality": null,
                "region": null,
                "postalCode": null,
                "city": null,
                "province": null,
                "country": null,
                "createdAt": "2021-08-17T07:17:57+00:00",
                "updatedAt": "2021-10-20T14:40:56+00:00"
            },
            {
                "id": "611b62949fc80c485862ee94",
                "arn": "arn:cn:authing:611b62944c0d199eee1d98d2:user:611b62949fc80c485862ee94",
                "userPoolId": "611b62944c0d199eee1d98d2",
                "status": "Activated",
                "username": "test",
                "email": "5@authing.cn",
                "emailVerified": false,
                "phone": null,
                "phoneVerified": false,
                "unionid": null,
                "openid": null,
                "nickname": null,
                "registerSource": [
                    "unknown"
                ],
                "photo": "https:\/\/files.authing.co\/authing-console\/default-user-avatar.png",
                "password": null,
                "oauth": null,
                "token": null,
                "tokenExpiredAt": "1970-01-01T00:00:00+00:00",
                "loginsCount": 0,
                "lastLogin": null,
                "lastIP": null,
                "signedUp": "2021-08-17T07:17:40+00:00",
                "blocked": false,
                "isDeleted": false,
                "device": null,
                "browser": null,
                "company": null,
                "name": null,
                "givenName": null,
                "familyName": null,
                "middleName": null,
                "profile": null,
                "preferredUsername": null,
                "website": null,
                "gender": "U",
                "birthdate": null,
                "zoneinfo": null,
                "locale": null,
                "address": null,
                "formatted": null,
                "streetAddress": null,
                "locality": null,
                "region": null,
                "postalCode": null,
                "city": null,
                "province": null,
                "country": null,
                "createdAt": "2021-08-17T07:17:40+00:00",
                "updatedAt": "2021-09-27T03:57:57+00:00"
            }
        ]
    }
} */

# 获取某个节点详情
// $orgManagementClient->getNodeById(string $nodeId)
/* $res = $orgManagementClient->getNodeById('611b702c4c48958c4f9d2113');
{
    "id": "611b702c4c48958c4f9d2113",
    "orgId": "611b62c23b89a13537af7120",
    "name": "李新涛111",
    "nameI18n": null,
    "description": null,
    "descriptionI18n": null,
    "order": null,
    "code": "111110",
    "root": false,
    "depth": null,
    "path": [
        "611b62c2795bcf478b5e7263",
        "611b702c4c48958c4f9d2113"
    ],
    "createdAt": "2021-08-17T08:15:40+00:00",
    "updatedAt": "2021-08-17T08:15:40+00:00",
    "children": []
} */

# 导出所有组织机构数据
// $orgManagementClient->exportAll()
/* $res = $orgManagementClient->exportAll(); */

# 设置用户主部门
// $orgManagementClient->setMainDepartment(string $userId, string $departmentId)

# 导入某个组织机构数据
// $orgManagementClient->exportByOrgId(string $orgId)

# 获取组织机构节点被授权的所有资源
// $orgManagementClient->listAuthorizedResourcesByNodeId(string $nodeId, string $namespace, string $resourceType = '')

# 获取组织机构节点被授权的所有资源
// $orgManagementClient->listAuthorizedResourcesByNodeCode(string $orgId, string $code, string $namespace, array $options = [])

// $orgManagementClient->startSync($options)

// $orgManagementClient->searchNodes($keyword)

var_dump(json_encode($res, JSON_UNESCAPED_UNICODE));
echo 'ok';