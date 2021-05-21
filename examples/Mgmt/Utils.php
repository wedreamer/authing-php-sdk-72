<?php

declare(strict_types=1);
namespace Authing\Mgmt;

use stdClass;

use Firebase\JWT\JWT;
use Authing\Types\UDFDataType;

class Utils
{
    public static function convertUdv($data)
    {
        $data = (array)$data;
        foreach ($data as $item) {
            $dataType = $item->dataType;
            $value = $item->value;
            if ($dataType === UDFDataType::NUMBER) {
                $item->value = json_encode($value);
            } elseif ($dataType === UDFDataType::BOOLEAN) {
                $item->value = json_encode($value);
            } elseif ($dataType === UDFDataType::DATETIME) {
                // set data time
                // $item->value = intval($value);
            } elseif ($dataType === UDFDataType::OBJECT) {
                $item->value = json_encode($value);
            }
        }
        return $data;
    }

    public static function getTokenPlayloadData(string $jwt)
    {
        $tks = explode('.', $jwt);
        [$headb64, $bodyb64, $cryptob64] = $tks;
        $playLoadData = JWT::jsonDecode(JWT::urlsafeB64Decode($bodyb64));
        return $playLoadData;
    }

    public static function convertUdvToKeyValuePair(array $data)
    {
        foreach ($data as $item) {
            $dataType = $item->dataType;
            $value = $item->value;
            if ($dataType === UDFDataType::NUMBER) {
                $item->value = json_encode($value);
            } elseif ($dataType === UDFDataType::BOOLEAN) {
                $item->value = json_encode($value);
            } elseif ($dataType === UDFDataType::DATETIME) {
                // set data time
            // $item->value = intval($value);
            } elseif ($dataType === UDFDataType::OBJECT) {
                $item->value = json_encode($value);
            }
        }

        $ret = new stdClass();
        foreach ($data as $item) {
            $key = $item->key;
            $ret->$key = $item->value;
        }
        return $ret;
    }

    /**
     * @param int $randomLenth
     */
    public static function randomString(int $randomLenth = 32)
    {
        $randomLenth = $randomLenth ?? 32;
        $t = 'abcdefhijkmnprstwxyz2345678';
        $a = strlen($t);
        $n = '';

        for ($i = 0; $i < $randomLenth; $i++) {
            $n .= $t[random_int(0, $a - 1)];
        }
        return $n;
    }

    public static function formatAuthorizedResources(object $obj)
    {
        $list = $obj->list;
        $total = $obj->totalCount;
        array_map(function ($_) {
            foreach ($_ as $key => $value) {
                if (!$_[$key]) {
                    unset($_[$key]);
                }
            }
            return $_;
        }, (array) $list);
        $res = new stdClass();
        $res->list = $list;
        $res->totalCount = $total;
        return $res;
    }
}
