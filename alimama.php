<?php
require 'lib/http.php';

$http = new lib\http\Http();
/**
 *  用户基本信息json地址
 *  https://pub.alimama.com/common/getUnionPubContextInfo.json
 *
 *  商品列表
 *  https://pub.alimama.com/items/search.json?spm=a219t.7900221%2F1.1998910419.de727cf05.615775a5coMecc&toPage=1&queryType=2&auctionTag=&perPageSize=50&shopTag=&t=1560238322710&_tb_token_=3eebe37666353&pvid=10_113.68.139.209_9076_1560238322561
 *
 *  商品价格
 *  https://pub.alimama.com/pubauc/searchPromotionInfo.json?oriMemberId=2231111757&blockId=&t=1560238506412&_tb_token_=3eebe37666353&pvid=10_113.68.139.209_637_1560238322750
 *
 */
$alimama = $http->get_http('https://pub.alimama.com/common/getUnionPubContextInfo.json');

print_r($alimama);