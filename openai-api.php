<?php
header('Access-Control-Allow-Origin: *');
//Based on tutorials and scripts at:
// https://github.com/karamusluk/OpenAI-GPT-3-API-Wrapper-for-PHP-8/blob/master/OpenAI.php
// https://githubhelp.com/karamusluk/OpenAI-GPT-3-API-Wrapper-for-PHP-8
//Thanks to this for hints about connecting PHP and JavaScript:
// https://stackoverflow.com/questions/15757750/how-can-i-call-php-functions-by-javascript
require_once "OpenAI-PHP-library-as-used.php";
$apikey = $_POST['apikey'];
$instance = new OpenAIownapikey($apikey);
$prompt = $_POST["prompt"];
$instance->setDefaultEngine("text-davinci-002"); // by default it is davinci
$res = $instance->complete(
 $prompt,
 100,
 [
 "stop" => ["\n"],
 "temperature" => 0,
 "frequency_penalty" => 0,
 "presence_penalty" => 0,
 "max_tokens" => 100,
 "top_p" => 1
 ]
);
echo $res; 
?>
