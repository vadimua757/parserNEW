<?php

namespace common\components\parserSettings;

use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;



class Settings
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $image;
    /**
     * @var string
     */
    public $price;
    /**
     * @var string
     */
    public $currency;
    /**
     * @var array
     */
    public $sites;

    public static function prepare($url){

         $sites =
            [
                'rozetka.com.ua',
                'foxtrot.com.ua',
            ];

        $result = [];

//        $html = file_get_contents($url);
        $html = $client->request('GET', $url);
        var_dump($html);
        die();
        $crawler = new Crawler($html);

        foreach ($sites as $site) {
            if(strpos($url, $site) !== false){
                switch ($site):
                    case 'rozetka.com.ua':
                        $result = [
                            'name' => $crawler->filter('h1')->first()->text(),
                            'image' => $crawler->filter('.owl-item .active img')->eq(0)->attr('src'),
                            'price' => (float)$crawler->filter('.price__relevant')->children()->text(),
                            'currency' => $crawler->filter('.detail-price-uah-sign')->first()->text()
                        ];
                        break;
                    case 'foxtrot.com.ua':
                        $result = [
                            'name' => $crawler->filter('h1')->first()->text(),
                            'image' => $crawler->filter('.detail-main-img-container img')->eq(0)->attr('src'),
                            'price' => (float)$crawler->filter('.price__relevant')->children('.numb')->text(),
                            'currency' => $crawler->filter('.price__relevant')->children('.currency')->text()
                        ];
                        break;

                endswitch;
            }
        }
        return $result;
    }
}
