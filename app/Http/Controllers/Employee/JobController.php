<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth;

class JobController extends Controller
{
    public function share(Request $request, Job $job)
    {
        $user = Auth::user();

        $client = new Client([
            'base_uri' => env('LINKEDIN_API_BASE_URI'),
            'timeout' => 5.0,
            'headers' => [
                'Authorization' => 'Bearer ' . $user->linkedin_token,
                'Accept' => 'application/json',
            ],
        ]);

        // Call linkedin post article API' POST 
        try {
            $response = $client->post('/v2/ugcPosts', [
                'body' => json_encode([
                    "author" => "urn:li:person:" . $user->linkedin_id,
                    "lifecycleState" => "PUBLISHED",
                    "specificContent" => [
                        "com.linkedin.ugc.ShareContent" => [
                            "shareCommentary"=> [
                                "text" => "New Job Post! " . $job->title
                            ],
                            "shareMediaCategory" => "ARTICLE",
                            "media" => [
                                [
                                    "status" => "READY",
                                    "description" => [
                                        "text" => $job->description
                                    ],
                                    "originalUrl" => route('jobs.show', ['job' => $job]),
                                    "title" => [
                                        "text" => $job->title
                                    ]
                                ]
                            ]
                        ]
                    ],
                    "visibility" => [
                            "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
                    ]
    
                ])
            ]);
        } catch (RequestException $exception) {
            toastr()->error('Fail to post on LinkedIn. Error ');
            return redirect()->route('jobs.show', ['job' => $job]);
        }

        toastr()->success('Share successfully', $job->title, ['timeOut' => 3000]);

        return redirect()->route('jobs.show', ['job' => $job]);
    }
}
