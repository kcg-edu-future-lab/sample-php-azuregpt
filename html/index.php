<?php
require_once 'config.php';

// 参考: https://goke.work/programing/1278
function call_gpt($messages, $api_key) {
    // OpenAI API URL
    $url = "https://kcg-openai-instance-japan-east.openai.azure.com/openai/deployments/gpt-35-turbo/chat/completions?api-version=2024-02-15-preview";

    // リクエストヘッダー
    $headers = array(
        "Content-Type: application/json",
        "api-key: " . $api_key
    );

    // リクエストボディ
    $data = array(
        "messages" => $messages,
        "max_tokens" => 800, // 応答の最大トークン数（≒文字数）を設定
        "temperature" => 0.7,
        "frequency_penalty" => 0,
        "presence_penalty" => 0,
        "top_p" => 0.95,
        "stop" => null
    );

    // cURLを初期化
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // APIにリクエストを送信し、応答を取得
    $response = curl_exec($ch);

    // cURLを閉じる
    curl_close($ch);

    return $response;
}

$messages = array(
    array("role" => "system", "content" => "You are a helpful assistant."),
    array("role" => "user", "content" => "コーヒーの美味しい淹れ方を教えて")
);

$response = call_gpt($messages, $AZURE_API_KEY);
$response_decoded = json_decode($response, true);

// 応答を表示
echo "Prompt: " . $messages[1]["content"] . "\n";
echo "Response: " . $response_decoded["choices"][0]["message"]["content"] . "\n";
?>
