<?php

require_once 'libs.php';
require_once 'config.php';

function getQuestionList($studentHomeworkId)
{
    $url = GetHomeworkUrl . '?' . http_build_query([
            'studentHomeworkId' => $studentHomeworkId,
        ]);

    $resp = curl_request($url, null, '', [
        'Authorization:' . Authorization,
        'appType:OES',
        'schoolId:' . SchoolId,
        'token:' . Token
    ]);

    $resp = json_decode($resp, true);
    if (!is_array($resp)) {
        exit('获取题目列表失败');
    }
    if (!$resp['data'] && $resp['message']) {
        exit($resp['message']);
    }

    $items = $resp['data']['paperInfo']['Items'];

    $arr = [];
    foreach ($items as $item) {
        $q = $item['I2'];
        $c = '选项:' . PHP_EOL;
        $choices = $item['Choices'];
        if (count($choices) > 0) {
            foreach ($choices as $choice) {
                $c .= $choice['I1'] . '.' . $choice['I2'] . PHP_EOL;
            }
        }
        $questionId = $item['I1'];
        $itemBankId = $item['I4'];
        $arr[] = [
            'q' => $q,
            'c' => $c,
            'qid' => $questionId,
            'bid' => $itemBankId
        ];
    }

    return $arr;
}

function getWrongQuestionAnswer()
{
    $questionList = getQuestionList(HomeworkId);

    foreach ($questionList as $index => $question) {
        $questionId = $question['qid'];
        $itemBankId = $question['bid'];
        $q = $question['q'];
        $c = $question['c'];
        $res = getWrongQuestionInfo($itemBankId, $questionId);
        // 题目 + 正确答案
        echo $index + 1 . ':' . $q . PHP_EOL . $res . PHP_EOL;
        // 待选选项
//        echo $c . PHP_EOL;
        if (($index + 1) % 5 == 0) {
            echo PHP_EOL;
        }
    }
}

function getWrongQuestionInfo($itemBankId, $questionId)
{
    $msNow = time() * 1000;
    $url = GetQuestionDetailUrl . '?' . http_build_query([
            'bust' => $msNow,
            'ItemBankId' => $itemBankId, // ?
            'questionId' => $questionId,
            '_' => $msNow
        ]);

    $resp = curl_request($url, null, Cookie);

    $resp = json_decode($resp, true);

    if (!$resp || $resp['status'] != 0) {
        echo '获取错题本详情失败' . PHP_EOL;
        return '';
    }

    $choices = $resp['data']['Choices'];

    $res = '';
    foreach ($choices as $choice) {
        if ($choice['IsCorrect'] == true) {
            $res .= $choice['I1'];
        }
    }

    return $res;
}
