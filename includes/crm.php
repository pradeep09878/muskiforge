<?php
/**
 * On-premise CRM lead capture integration.
 * Pushes contact form submissions to CRM_API_URL as a best effort — the
 * lead is always saved to contact_submissions first, so a CRM outage or
 * slow response never blocks the visitor's confirmation.
 */

declare(strict_types=1);

/**
 * @param array{name: string, email: string, phone?: ?string, message?: ?string} $lead
 */
function push_lead_to_crm(array $lead): bool
{
    if (!defined('CRM_API_URL') || !defined('CRM_API_KEY') || !function_exists('curl_init')) {
        return false;
    }

    $payload = json_encode([
        'first_name' => $lead['name'],
        'email' => $lead['email'],
        'phone' => $lead['phone'] ?? '',
        'description' => $lead['message'] ?? '',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init(CRM_API_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-Tenant-Key: ' . CRM_API_KEY,
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 8,
        CURLOPT_CONNECTTIMEOUT => 5,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false || $httpCode >= 400) {
        error_log(sprintf(
            '[crm] Lead push failed (HTTP %d): %s',
            $httpCode,
            $curlError ?: (string) $response
        ));

        return false;
    }

    return true;
}
