<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class InsightController extends Controller
{
    /**
     * Generate strategic insight using Gemini API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(Request $request)
    {
        try {
            // Validate the request with custom error messages
            $validated = $request->validate([
                'problem' => 'required|string|min:10|max:1000',
            ], [
                'problem.required' => 'Please provide a problem to analyze.',
                'problem.min' => 'Your problem description is too short. Please provide at least 10 characters.',
                'problem.max' => 'Your problem description is too long. Please keep it under 1000 characters.'
            ]);

            $problem = $request->input('problem');

            // Construct the prompt for Gemini API
            $chatHistory = [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "You are an AI assistant designed to generate strategic insights. Your persona is that of Tim Empringham, a business and technology executive who excels in driving transformative value through strategic innovation and creative problem-solving. Tim is known for his 'good-weird' approaches (like using Lego for design or competitive guilds for AI adoption), his passion for leveraging AI to augment human potential, and his ability to unblock complex situations. He always seeks to find simple, effective answers to complicated questions. His experience spans banking, CPG, aerospace, and supply chain. Use a slightly informal, engaging, and confident tone, and include relevant emojis.
                        A client presents the following 'weird problem': " . $problem . "
                        Based on Tim's approach, what's a strategic insight or initial thought process to tackle this? Keep it concise (1-2 sentences)."]
                    ]
                ]
            ];

            $payload = [
                "contents" => $chatHistory,
                // Add any specific generationConfig if needed for structured output
            ];

            // Check if API key is configured
            if (empty(env('GEMINI_API_KEY'))) {
                Log::error('Gemini API key not configured');
                return response()->json(['error' => 'API configuration error. Please contact the administrator.'], 500);
            }
            
            try {
                $client = new Client();
                $response = $client->post(env('GEMINI_API_URL'), [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $payload,
                    'query' => [
                        'key' => env('GEMINI_API_KEY')
                    ],
                    'verify' => false, // Set to true in production if SSL is configured
                ]);

                $result = json_decode($response->getBody()->getContents(), true);

                // Process the result to extract the generated text
                if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                    $insight = $result['candidates'][0]['content']['parts'][0]['text'];
                    return response()->json(['insight' => $insight]);
                } else {
                    Log::error('Unexpected Gemini API response structure', ['response' => $result]);
                    return response()->json(['error' => 'Failed to generate insight: Unexpected API response.'], 500);
                }

            } catch (ClientException $e) {
                // Handle 4xx errors (like invalid API key)
                Log::error('Gemini API client error', ['error' => $e->getMessage(), 'status' => $e->getCode()]);
                
                if ($e->getCode() == 401 || $e->getCode() == 403) {
                    return response()->json(['error' => 'Authentication error with AI service. Please check API key configuration.'], 500);
                }
                
                return response()->json(['error' => 'Error communicating with AI service. Please try again later.'], 500);
                
            } catch (ServerException $e) {
                // Handle 5xx errors
                Log::error('Gemini API server error', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'The AI service is currently unavailable. Please try again later.'], 503);
                
            } catch (ConnectException $e) {
                // Handle connection errors
                Log::error('Gemini API connection error', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Could not connect to the AI service. Please check your internet connection and try again.'], 503);
                
            } catch (\Exception $e) {
                // Handle any other exceptions
                Log::error('Error calling Gemini API', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
                return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
            }
            
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }
    }
}
