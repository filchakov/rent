<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use GuzzleHttp\Client;
use Cache;

class LogNotifficationSlack extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Log::listen(function($level, $message, $parameters) {

            try {
                $url = env('SLACK_URL', false);
                if ($url) {
                    $slack_loglevel = Logger::toMonologLevel(env('SLACK_LOGLEVEL', 'info'));
                    $level = Logger::toMonologLevel($level);

                    $allowed = true;

                    // Don't send errors or higher more than once a minute to prevent spam if something goes terribly wrong
                    /*if ($level >= Logger::ERROR) {
                        if (Cache::get("slack_integration_error_lock")) {
                            $allowed = false;
                        }
                        else {
                            Cache::put("slack_integration_error_lock", 1, 1);
                        }
                    }*/

                    // Send only if loglevel is higher than specified one
                    if ($level >= $slack_loglevel && $allowed) {
                        $client = new Client(['base_uri' => 'https://hooks.slack.com/services/']);
                        // Get just the first line
                        $message = strtok($message, "\n");
                        // Get the first 600 characters
                        $message = substr($message, 0, 600);

                        $response = $client->request('POST', $url, [
                            'connect_timeout' => 1.5,
                            'timeout' => 1.5,
                            'http_errors' => false,
                            'exceptions' => false,
                            'verify' => false,
                            'json' => ['text'=>$message]
                        ]);

                    }
                }
            }
                // Disable exceptions or we might end up in infinite loop
            catch(\Exception $e) {
                \Log::debug("Slack Log Exception: ".$e->getMessage());
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
