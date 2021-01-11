<?php
// 学校id
const SchoolId = '10614';
// 题目列表
const GetHomeworkUrl = 'https://homeworkapi.open.com.cn/getHomework';
// 错题本详情
const GetQuestionDetailUrl = 'http://learn.open.com.cn/StudentCenter/OnlineJob/GetQuestionDetail';
// 题目ID (studentHomeworkId)
const HomeworkId = '5a4fe534-f92f-47e0-a2b9-e12225b6fef5';
// cookie 注意:此sessionId可能会跟登陆后所获取的不同,需要到答题页面获取
const Cookie = 'ASP.NET_SessionId=mntaeua3fwmsfuct5z3ss0il';
// getHistoryDetail 接口请求头中 auth token
const Authorization = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiMTYxMDM1NDk3OCIsImlhdCI6MTYxMDM1NDk3N30.1J7GTPmzw25V4NXEo3kRCAZQMVIE6kkFIA8V0VDwYuI';
// getHistoryDetail 接口请求头中 签名token
const Token = '618E5BAC4F2C3C269B2EC9AC862981B53B8170CB8952400A536529BCF7B8493C4A870A3950AEF747E7C5C89C327E8DFC4C692ED17929E400D30549F3BFBBAE14579CC6E2FF24ABF0B4A57517B90F9AFD0B280162790BF5D389165539F38A029C1151D8E37A1BBB6318240D6277AD14827DEDCFBC6A4759B20D29D274A1B8F4EC1BBCDACA93A2C7757E6414DCC4B09BF4D451A146A6CB3075E0A5B345B79D0A278F29DDC5A7F08DAC';