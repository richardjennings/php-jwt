--TEST--
Check for jwt aud claim name
--SKIPIF--
<?php if (!extension_loaded("jwt")) print "skip"; ?>
--FILE--
<?php
$hmackey = "example-hmac-key";
$payload = ['data' => 'data', 'aud' => ['Young', 'Old']];

$token = jwt_encode($payload, $hmackey, 'HS256');

try {
    $decoded_token = jwt_decode($token, $hmackey, ['aud' => ['Young', 'Old'], 'algorithm' => 'HS256']);
    echo "SUCCESS\n";
} catch (Exception $e) {
     // Handle invalid token
}

try {
    $decoded_token = jwt_decode($token, $hmackey, ['aud' => ['Young'], 'algorithm' => 'HS256']);
} catch (Exception $e) {
     // Handle invalid token
     echo "FAIL\n";
}
?>
--EXPECT--
SUCCESS
FAIL
