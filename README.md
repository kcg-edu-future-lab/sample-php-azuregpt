# sample-php-azuregpt

htmlディレクトリに以下の内容でconfig.phpファイルを作成してください。

```php
<?php
$AZURE_API_KEY = "APIキー";
?>
```

次に、dockerを使用して起動してください。

```bash
> docker compose up
```

http://localhost:8080 にブラウザでアクセスすると、Azure GPTからの応答が表示されます。
