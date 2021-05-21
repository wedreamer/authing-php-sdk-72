<?php

declare(strict_types=1);

require_once __DIR__ . '../../../vendor/autoload.php';
namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class AgreementManagementClient {
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
    }

    /**
     * @param string $appId
     */
    public function list(array $appId)
    {
        $data = $this->client->httpGet("/api/v2/applications/$appId/agreements");
        return $data;
    }

    /**
     * @param string $appId
     */
    public function create(array $appId, array $agreement)
    {
        $data = [
            'lang' => 'zh-CN',
            'required' => true,
        ];
        foreach($agreement as $key => $value) {
            $data[$key] = $value;
        }
        $res = $this->client->httpPost("/api/v2/applications/$appId/agreements", $data);
        return $res;
    }

    /**
     * @param string $appId
     */
    public function delete(array $appId, int $agreementId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId/agreements/$agreementId");
        return true;
    }

    /**
     * @param string $appId
     */
    public function modify(array $appId, int $agreementId, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/applications/$appId/agreements/$agreementId", $updates);
        return $data;
    }

    /**
     * @param string $appId
     */
    public function sort(array $appId, array $order)
    {
        $this->client->httpPost("/api/v2/applications/$appId/agreements/sort", [
            'ids' => $order
        ]);
        return true;
    }
}

