<?php

namespace ICMeter\API\PHP\Api;

class Helper
{
    public $client;
    public $devices = array();

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function api($method, $action = 'GET', $params = array())
    {
        return isset($this->client)
            ? $this->client->api($method, $action, $params)
            : null;
    }

    public function measurements($fr = null, $to = null, $boxQR = 'efde07df')
    {
        return $this->api("/measurements/{$this->client->apiVersion()}/days/range/{$boxQR}", 'GET', array(
            'fromDate' => date_format(new \DateTime($fr), 'Y-m-d\TH:i:s\Z'),
            'toDate'   => date_format(new \DateTime($to), 'Y-m-d\TH:i:s\Z'),
        ));
    }

    public function weatherMeasurements($fr = null, $to = null, $boxQR = 'efde07df')
    {
        return $this->api("/weather/{$this->client->apiVersion()}/days/range/{$boxQR}", 'GET', array(
            'fromDate' => date_format(new \DateTime($fr), 'Y-m-d\TH:i:s\Z'),
            'toDate'   => date_format(new \DateTime($to), 'Y-m-d\TH:i:s\Z'),
        ));
    }

    public function idToLabelMap($measurements)
    {
        $map = array();
        foreach ($measurements['cols'] as $config) {
            $map[$config['id']] = $config['label'];
        }
        return $map;
    }

    public function normalize($measurements)
    {
        $normalized = array();
        foreach ($measurements['rows'] as $rowNum => $row) {
            foreach ($row['c'] as $colNum => $col) {
                $id = $measurements['cols'][$colNum]['id'];
                $normalized[$rowNum][$id] = $col['v'];
            }
        }

        return $normalized;
    }

    public function measurementIdToLabel($id, $measurements)
    {
        $map = $this->idToLabelMap($measurements);
        return isset($map[$id]) ? $map[$id] : null;
    }
}
