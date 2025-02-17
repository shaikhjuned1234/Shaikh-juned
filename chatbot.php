<?php
header("Content-Type: application/json");

// Replace with your actual Gemini API Key
define("GEMINI_API_KEY", "AIzaSyBmrlGFb5ABO5hkPS8xtjD-JqnRwUv9Z6U");
// Use the v1beta endpoint and model from the documentation
define("GEMINI_API_URL", "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent");

/**
 * Send a request to the Gemini API.
 *
 * If a system instruction is provided, it uses the dedicated field.
 * Otherwise, it sends a simple text-only payload.
 *
 * @param string $prompt     The user prompt.
 * @param string $systemRole Optional system instruction.
 * @return array             An associative array with either the key "msg" (for a valid response)
 *                           or "error" (if something went wrong).
 */
function sendGeminiRequest($prompt, $systemRole = "") {
    // Build payload following the documentation:
    if (!empty($systemRole)) {
        $payload = [
            "system_instruction" => [
                "parts" => [ "text" => $systemRole ]
            ],
            "contents" => [
                "parts" => [ "text" => $prompt ]
            ]
        ];
    } else {
        $payload = [
            "contents" => [
                [
                    "parts" => [
                        [ "text" => $prompt ]
                    ]
                ]
            ]
        ];
    }

    $ch = curl_init();
    $url = GEMINI_API_URL . "?key=" . GEMINI_API_KEY;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    // --- SSL Settings ---
    // Temporary measure: Disable SSL certificate verification (not recommended for production)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // If you prefer to properly validate SSL, download a CA bundle (cacert.pem) from:
    // https://curl.se/docs/caextract.html and set the path below:
    // curl_setopt($ch, CURLOPT_CAINFO, "/path/to/cacert.pem");

    // Set a timeout (adjust as needed)
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        return ["error" => "cURL Error: " . $error, "status" => 0];
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return ["error" => "Failed to fetch response from Gemini API", "status" => $httpCode];
    }

    $decodedResponse = json_decode($response, true);
    if (
        !$decodedResponse ||
        !isset($decodedResponse["candidates"][0]["content"]["parts"][0]["text"])
    ) {
        return ["error" => "Invalid response from Gemini API"];
    }

    $aiResponse = $decodedResponse["candidates"][0]["content"]["parts"][0]["text"];
    return ["msg" => $aiResponse];
}

// Handle only GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET["prompt"])) {
        echo json_encode(["error" => "Prompt parameter is required"], JSON_PRETTY_PRINT);
        exit;
    }

    $prompt = $_GET["prompt"];
    $systemRole = isset($_GET["system"]) ? $_GET["system"] : "";

    $result = sendGeminiRequest($prompt, $systemRole);
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo json_encode(["error" => "Only GET requests are allowed"], JSON_PRETTY_PRINT);
}
?>
