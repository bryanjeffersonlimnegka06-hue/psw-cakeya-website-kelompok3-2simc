<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DummyPaymentController extends Controller
{
    public function processCheckout(Request $request)
    {
        // 1. Validate incoming checkout details
        $validated = $request->validate([
            'customer_name'   => 'required|string|max:255',
            'customer_phone'  => 'required|string',
            'delivery_address'=> 'required|string',
            'cart_items'      => 'required|array',
            'total_amount'    => 'required|numeric',
        ]);

        $orderId = 'INV-' . strtoupper(uniqid());

        // 2. Format item listing string for the Discord embed field
        $itemsList = "";
        foreach ($validated['cart_items'] as $item) {
            $itemsList .= "• " . $item['name'] . " (x" . $item['quantity'] . ") - Rp " . number_format($item['price'], 0, ',', '.') . "\n";
        }

        // 3. Assemble the Discord Rich Embed payload
        $payload = [
            'username'   => 'Dummy Payment Gateway',
            'avatar_url' => 'https://i.imgur.com/wSTFkRM.png', // Optional bot icon
            'embeds'     => [
                [
                    'title'       => '🔔 New Order Received! (Paid via Dummy Gateway)',
                    'color'       => 3066993, // Green hex integer code
                    'description' => "An order has successfully skipped real processing and cleared mock payment authentication.",
                    'fields'      => [
                        [
                            'name'   => '📦 Order Reference',
                            'value'  => "`" . $orderId . "`",
                            'inline' => false
                        ],
                        [
                            'name'   => '👤 Customer Details',
                            'value'  => "**Name:** " . $validated['customer_name'] . "\n**Phone:** " . $validated['customer_phone'],
                            'inline' => true
                        ],
                        [
                            'name'   => '📍 Shipping Address',
                            'value'  => $validated['delivery_address'],
                            'inline' => false
                        ],
                        [
                            'name'   => '🛒 Items Ordered',
                            'value'  => $itemsList ?: 'No parsed items text found.',
                            'inline' => false
                        ],
                        [
                            'name'   => '💰 Transaction Summary',
                            'value'  => "**Total Charged:** Rp " . number_format($validated['total_amount'], 0, ',', '.') . "\n**Status:** `MOCK_SUCCESS` ",
                            'inline' => false
                        ],
                    ],
                    'timestamp' => now()->toIso8601String(),
                    'footer'    => [
                        'text' => 'Dev Sandbox Environment Logging'
                    ]
                ]
            ]
        ];

        // 4. Send JSON via POST request directly to Discord
        try {
            $response = Http::post(env('DISCORD_WEBHOOK_URL'), $payload);

            if ($response->successful()) {
                Log::info("Discord alert dispatched successfully for item collection order: " . $orderId);
            } else {
                Log::error("Discord payload transmission rejected: " . $response->body());
            }

        } catch (\Exception $e) {
            Log::error("Critical error while communicating with Discord endpoint: " . $e->getMessage());
        }

        // 5. Respond back to front-end handler
        return response()->json([
            'success'  => true,
            'message'  => 'Dummy checkout simulation complete. Details dispatched to your Discord target channel.',
            'order_id' => $orderId
        ]);
    }
}