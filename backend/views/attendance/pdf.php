<?php

use yii\helpers\Url;
use yii2assets\pdfjs\PdfJs;

/* @var $file string */
?>

<?= PdfJs::widget([
    'url'=> $file,
    /*'buttons'=>[
        'presentationMode' => false,
        'openFile' => false,
        'print' => true,
        'download' => true,
        'viewBookmark' => false,
        'secondaryToolbarToggle' => false
    ]*/
    'height'=> '100%',
]);
?>