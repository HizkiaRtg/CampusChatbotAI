<?php

namespace App\Http\Controllers;

use App\Models\TrainingData;
use App\Models\ChatHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();

        if (auth()->check()) {
            $chatHistories = ChatHistory::where('user_id', auth()->id())
                ->latest()
                ->take(20)
                ->get()
                ->reverse()
                ->values();
        } else {
            $chatHistories = ChatHistory::where('session_id', $sessionId)
                ->latest()
                ->take(20)
                ->get()
                ->reverse()
                ->values();
        }

        return view('chatbot.index', compact('chatHistories'));
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $question = $request->question;
        $sessionId = session()->getId();

        // Advanced matching algorithm
        $result = $this->findBestMatch($question);

        // Save to history
        $chatHistory = ChatHistory::create([
            'user_id' => auth()->id(),
            'session_id' => $sessionId,
            'question' => $question,
            'answer' => $result['answer'],
            'matched_training_id' => $result['training_id'],
            'confidence_score' => $result['confidence'],
        ]);

        return response()->json([
            'success' => true,
            'answer' => $result['answer'],
            'confidence' => $result['confidence'],
            'matched' => $result['training_id'] !== null,
        ]);
    }

    public function clearChat(Request $request)
    {
        $sessionId = session()->getId();

        // Delete chat history for current session or user
        if (auth()->check()) {
            ChatHistory::where('user_id', auth()->id())->delete();
        } else {
            ChatHistory::where('session_id', $sessionId)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Chat berhasil dihapus!',
        ]);
    }

    private function findBestMatch($question)
    {
        $question = strtolower(trim($question));

        // Normalize text
        $normalizedQuestion = $this->normalizeText($question);
        $questionWords = $this->extractWords($normalizedQuestion);

        if (empty($questionWords)) {
            return [
                'answer' => 'Maaf, saya tidak mengerti pertanyaan Anda. Silakan coba lagi dengan pertanyaan yang lebih jelas.',
                'confidence' => 0,
                'training_id' => null,
            ];
        }

        // Get all active training data with keywords
        $trainingData = TrainingData::where('is_active', 1)
            ->with('keywords')
            ->get();

        $matches = [];

        foreach ($trainingData as $data) {
            $score = $this->calculateMatchScore($questionWords, $data, $normalizedQuestion);

            if ($score > 0) {
                $matches[] = [
                    'data' => $data,
                    'score' => $score,
                ];
            }
        }

        // Sort by score and priority
        usort($matches, function ($a, $b) {
            if ($a['score'] == $b['score']) {
                return $b['data']->priority <=> $a['data']->priority;
            }
            return $b['score'] <=> $a['score'];
        });

        // Get best match
        if (!empty($matches) && $matches[0]['score'] >= 30) {
            $bestMatch = $matches[0];
            $confidence = min(100, $bestMatch['score']);

            return [
                'answer' => $bestMatch['data']->answer,
                'confidence' => $confidence,
                'training_id' => $bestMatch['data']->id,
            ];
        }

        // No good match found
        return [
            'answer' => $this->generateNoMatchResponse($question),
            'confidence' => 0,
            'training_id' => null,
        ];
    }

    private function calculateMatchScore($questionWords, $trainingData, $normalizedQuestion)
    {
        $score = 0;

        // Normalize training question
        $trainingQuestion = $this->normalizeText(strtolower($trainingData->question));
        $trainingWords = $this->extractWords($trainingQuestion);

        // 1. Exact phrase match (highest score)
        if (
            strpos($normalizedQuestion, $trainingQuestion) !== false ||
            strpos($trainingQuestion, $normalizedQuestion) !== false
        ) {
            $score += 100;
        }

        // 2. Keyword matching with weights
        foreach ($trainingData->keywords as $keyword) {
            $normalizedKeyword = $this->normalizeText(strtolower($keyword->keyword));

            // Exact keyword match in question
            if (in_array($normalizedKeyword, $questionWords)) {
                $score += (20 * $keyword->weight);
            }

            // Partial keyword match
            foreach ($questionWords as $word) {
                if (strlen($word) >= 3 && strlen($normalizedKeyword) >= 3) {
                    $similarity = $this->stringSimilarity($word, $normalizedKeyword);
                    if ($similarity > 0.8) {
                        $score += (15 * $keyword->weight * $similarity);
                    }
                }
            }
        }

        // 3. Word overlap between question and training question
        $commonWords = array_intersect($questionWords, $trainingWords);
        $overlapRatio = count($commonWords) / max(count($questionWords), 1);
        $score += ($overlapRatio * 30);

        // 4. Levenshtein distance for similar questions
        $distance = levenshtein(
            substr($normalizedQuestion, 0, 255),
            substr($trainingQuestion, 0, 255)
        );
        $maxLen = max(strlen($normalizedQuestion), strlen($trainingQuestion));
        if ($maxLen > 0) {
            $similarity = 1 - ($distance / $maxLen);
            if ($similarity > 0.7) {
                $score += ($similarity * 25);
            }
        }

        // 5. N-gram matching for phrases
        $questionBigrams = $this->generateNgrams($questionWords, 2);
        $trainingBigrams = $this->generateNgrams($trainingWords, 2);
        $bigramMatches = count(array_intersect($questionBigrams, $trainingBigrams));
        $score += ($bigramMatches * 10);

        // 6. Category boost
        $categoryWords = ['jadwal', 'ruang', 'dosen', 'biaya', 'syarat', 'cara', 'dimana', 'kapan', 'siapa'];
        foreach ($categoryWords as $catWord) {
            if (
                in_array($catWord, $questionWords) &&
                strpos($trainingQuestion, $catWord) !== false
            ) {
                $score += 5;
            }
        }

        return $score;
    }

    private function normalizeText($text)
    {
        // Remove punctuation
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);
        // Remove extra spaces
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    private function extractWords($text)
    {
        // Split into words and remove stopwords
        $words = explode(' ', $text);
        $stopwords = ['apa', 'yang', 'di', 'ke', 'dari', 'untuk', 'pada', 'adalah', 'dan', 'atau', 'ya', 'tidak', 'saya', 'aku', 'kamu', 'anda'];

        $meaningfulWords = array_filter($words, function ($word) use ($stopwords) {
            return strlen($word) >= 2 && !in_array($word, $stopwords);
        });

        return array_values($meaningfulWords);
    }

    private function generateNgrams($words, $n)
    {
        $ngrams = [];
        $count = count($words);

        for ($i = 0; $i <= $count - $n; $i++) {
            $ngram = array_slice($words, $i, $n);
            $ngrams[] = implode(' ', $ngram);
        }

        return $ngrams;
    }

    private function stringSimilarity($str1, $str2)
    {
        similar_text($str1, $str2, $percent);
        return $percent / 100;
    }

    private function generateNoMatchResponse($question)
    {
        $responses = [
            'Maaf, saya belum memiliki informasi tentang pertanyaan Anda. Silakan hubungi bagian akademik kampus untuk informasi lebih lanjut.',
            'Saya tidak menemukan jawaban yang sesuai. Coba tanyakan dengan kata kunci yang berbeda, atau hubungi admin kampus.',
            'Pertanyaan Anda belum ada dalam database saya. Silakan coba pertanyaan lain atau kontak langsung ke kampus.',
        ];

        // Try to suggest based on keywords
        $words = $this->extractWords($this->normalizeText($question));
        if (!empty($words)) {
            $suggestions = $this->getSuggestions($words);
            if (!empty($suggestions)) {
                return 'Maaf, saya tidak menemukan jawaban pasti untuk pertanyaan Anda. Mungkin Anda ingin bertanya tentang: ' . implode(', ', $suggestions) . '?';
            }
        }

        return $responses[array_rand($responses)];
    }

    private function getSuggestions($words)
    {
        $categories = TrainingData::where('is_active', 1)
            ->distinct()
            ->pluck('category')
            ->take(3)
            ->toArray();

        return $categories;
    }
}
