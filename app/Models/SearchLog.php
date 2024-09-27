<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function calculatePopularSearches($batchSize = 100)
    {
        $offset = 0;
        $wordCounts = [];
        $stopWords = ['the', 'a', 'will', 'and']; // Add stop words that you want to exclude

        // Process search logs in batches
        do {
            // Fetch a batch of search logs
            $searchLogs = self::select('query')->offset($offset)->limit($batchSize)->get();

            $searchLogs->map(function ($log) {
                return preg_split('/\s+/', strtolower(trim($log->query))); // Split and normalize
            })->reduce(
                function ($carry, $words) use (&$wordCounts, $stopWords) {
                    // Use reduce to accumulate word counts
                    foreach ($words as $word) {
                        if (!empty($word) && !in_array($word, $stopWords) && !preg_match('/^[aeiou]+$/i', $word)) {
                            // Filter out stop words and words that contain only vowels
                            if (isset($wordCounts[$word])) {
                                $wordCounts[$word]++;
                            } else {
                                $wordCounts[$word] = 1; // Initialize the word count if it doesn't exist
                            }
                        }
                    }
                });

            $offset += $batchSize;

        } while ($searchLogs->count() === $batchSize); // Continue until no more records are found

        // Sort words by frequency and get the top $limit popular words
        arsort($wordCounts);
        return array_keys($wordCounts);
    }

    public static function calculateUserPopularSearches($batchSize = 100)
    {
        $offset = 0;
        $wordCounts = [];
        $stopWords = ['the', 'a', 'will', 'and']; // Stop words to exclude

        // Determine the user ID or IP address to fetch search logs
        $identifier = auth()->check() ? auth()->id() : request()->ip();

        // Process search logs in batches
        do {
            // Fetch a batch of search logs based on the identifier
            $searchLogs = self::where(auth()->check() ? 'user_id' : 'ip_address', $identifier)
                ->select('query')
                ->offset($offset)
                ->limit($batchSize)
                ->get();

            // Process the fetched search logs only if not empty
            if ($searchLogs->isNotEmpty()) {
                $searchLogs->map(function ($log) {
                    return preg_split('/\s+/', strtolower(trim($log->query))); // Split and normalize
                })->reduce(function ($carry, $words) use (&$wordCounts, $stopWords) {
                    foreach ($words as $word) {
                        if (!empty($word) && !in_array($word, $stopWords) && !preg_match('/^[aeiou]+$/i', $word)) {
                            // Filter out stop words and words that contain only vowels
                            $wordCounts[$word] = ($wordCounts[$word] ?? 0) + 1; // Increment the word count
                        }
                    }
                });
            }

            $offset += $batchSize;

        } while ($searchLogs->count() === $batchSize); // Continue until no more records are found

        // If no logs found, return an empty array
        if ($offset === 0) {
            return [];
        }

        // Sort words by frequency and return the top popular words
        arsort($wordCounts);
        return array_keys($wordCounts);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
