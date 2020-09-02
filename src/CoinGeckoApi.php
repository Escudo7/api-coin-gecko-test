<?php
namespace Escudo;

use GuzzleHttp\Client;

class CoinGeckoApi
{
    private $client;
    private $baseUrl;
    private $coin;

    public function __construct($coin, $baseUrl = 'https://api.coingecko.com/api/v3/coins/')
    {
        $this->coin = strtolower($coin);
        $this->baseUrl = $baseUrl;
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    public function getCoin()
    {
        return $this->coin;
    }

    public function setCoin($newCoin)
    {
        $this->coin = $newCoin;
    }

    public function getCoinsList()
    {
        $response = $this->client->request('GET', 'list');
        return $response->getBody();
    }

    public function getData($options = [])
    {
        $newOptions = $this->setOptionsToString($options);

        $response = $this->client->request('GET', $this->coin, ['query' => $newOptions]);
        return $response->getBody();
    }

    public function getTickers($options = [])
    {
        $newOptions = $this->setOptionsToString($options);

        $response = $this->client->request('GET', "{$this->coin}/tickers", ['query' => $newOptions]);
        return $response->getBody();
    }

    public function getHistory($date, $options = [])
    {
        $newOptions = $this->setOptionsToString($options);
        $newOptions['date'] = $date;

        $response = $this->client->request('GET', "{$this->coin}/history", ['query' => $newOptions]);
        return $response->getBody();
    }

    public function getMarketChart($vsCur, $days)
    {
        $options = [];
        $options['vs_currency'] = $vsCur;
        $options['days'] = $days;

        $response = $this->client->request('GET', "{$this->coin}/market_chart", ['query' => $options]);
        return $response->getBody();
    }

    public function getMarketChartRange($vsCur, $from, $to)
    {
        $options = [];
        $options['vs_currency'] = $vsCur;
        $options['from'] = $from;
        $options['to'] = $to;

        $response = $this->client->request('GET', "{$this->coin}/market_chart/range", ['query' => $options]);
        return $response->getBody();
    }

    public function getStatusUpdates($options = [])
    {
        $response = $this->client->request('GET', "{$this->coin}/status_updates", ['query' => $options]);
        return $response->getBody();
    }

    public function getOhls($vsCur, $days)
    {
        $options = [];
        $options['vs_currency'] = $vsCur;
        $options['days'] = $days;

        $response = $this->client->request('GET', "{$this->coin}/ohls", ['query' => $options]);
        return $response->getBody();
    }

    private function setOptionsToString($options)
    {
        $newOptions = array_map(function($item) {
            return json_encode($item);
        }, $options);

        return $newOptions;
    }
}