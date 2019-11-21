<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use common\components\parserSettings\Settings;

class ParserController extends Controller
{
    public function actionParse($url)
    {

        $settings = Settings::prepare($url);

        $name = $settings['name'];
        $image =  $settings['image'];
        $price = $settings['price'];
        $cur = $settings['currency'];


        $word = 'rozetka.com.ua';
        if(strpos($url, $word) !== false){
            echo $word;
        }
        var_dump($name);
//        var_dump($img);
        echo Html::img($image);
//        var_dump($image);
        var_dump($price . $cur);
    }


}
