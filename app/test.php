<?php

/*
 * Copyright (C) 2016 SINA Corporation
 *  
 *  
 * 
 * This script is firstly created at 2016-09-06.
 * 
 * To see more infomation,
 *    visit our official website http://app.finance.sina.com.cn/.
 */

error_reporting(E_ALL);
ini_set("display_errors", true);
require "../vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

//$crawlUrl = "http://www.uniqlo.cn/search.htm";
//$httpClient = new Client();
//$response = $httpClient->get($crawlUrl);
//$html = $response->getBody();

$html = file_get_contents("/tmp/search.htm");

$crawler = new Crawler(strval($html));

$crawler = $crawler->filter(".shop-list");
$crawler = $crawler->filter("li");

foreach($crawler as $node) {
    $child = new Crawler($node);
    $desc = $child->filter(".desc");
    $desc = $desc->filter("a");
    foreach($desc as $v) {
        var_dump($v->getAttribute("href"));
        var_dump(trim($v->nodeValue));
    }
    $price = $child->filter(".price");
    foreach($price as $v) {
        var_dump(trim($v->nodeValue));
    }
    $pic = $child->filter(".pic");
    $pic = $pic->filter("img");
    foreach($pic as $v) {
        var_dump($v->getAttribute("data-ks-lazyload"));
    }
}

exit;

$desc = $crawler->filter(".desc");
$price = $crawler->filter(".price");
$pic = $crawler->filter("img");


