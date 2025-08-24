<?php

namespace App\Services\CronJob;

use App\Libraries\Exceptions\Exceptions;
use App\Libraries\HttpClient\HttpClient;
use App\Services\CronJob\Entities\Job;

class CronJobService
{
    private string $url;
    private string $accessToken;

    public function __construct()
    {
        $this->url = \getenv('private.cronjob.api');
        $this->accessToken = \getenv('private.cronjob.access_key');
    }

    public function store(Job $job)
    {
        if (empty($job->getUrl()))
            $job->setUrl(base_url("/api/webhook/tasks/dispatcher"));

        $httpResponse =  HttpClient::request("PUT", "{$this->url}/jobs", [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
        ], [
            "job" => $job->getAttributes()
        ]);

        return $httpResponse['response'];
    }

    public function search()
    {
        $response = HttpClient::request("GET", "{$this->url}/jobs", [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
        ]);

        return !empty($response['response']) ? \json_decode($response['response']) : [];
    }

    public function delete(string $jobId)
    {
        if (empty($jobId))
            throw new Exceptions("Api.cronjob.invalid_field", \BAD_BUSINESS_RULES);

        $response = HttpClient::request("DELETE", "{$this->url}/jobs/{$jobId}", [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken
        ]);

        return $response['status'] === 204;
    }
}
