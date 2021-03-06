<?php

declare(strict_types=1);
namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class NamespaceManagementClient {
    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * @param \Authing\Mgmt\ManagementClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->options = $client->options;
    }

    public function list(array $params = [])
    {
        $userPoolId = $this->client->options->userPoolId;
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $data = $this->client->httpGet("/api/v2/resource-namespace/$userPoolId/?page=$page&limit=$limit");
        return $data;
    }


    public function create(string $code, string $name, string $description = "")
    {
        $res = $this->client->httpPost("/api/v2/resource-namespace/{$this->client->options->userPoolId}", (object)[
            'name' => $name,
            'code' => $code,
            'description' => $description
        ]);
        return $res;
    }

    public function delete(string $code)
    {
        $this->client->httpDelete("/api/v2/resource-namespace/{$this->client->options->userPoolId}/code/$code");
        return true;
    }

    public function update(string $code, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/resource-namespace/{$this->client->options->userPoolId}/code/{$code}", $updates);
        return $data;
    }
}

