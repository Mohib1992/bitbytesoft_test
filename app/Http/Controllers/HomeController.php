<?php

namespace App\Http\Controllers;


use App\JobListing;
use GuzzleHttp\Client;
use http\Env\Request;
use Illuminate\Queue\Jobs\Job;

class HomeController extends Controller
{
    public function index()
    {
        $client = new Client();

        try {
            $response = $client->request('GET', env('BASE_URL'));
            $data = json_decode($response->getBody()->getContents());
        } catch (\Exception $exception) {
            return response(['error' => $exception->getTrace()], 403);
        }

        if (count($data->response->docs) <= count(JobListing::all())) {
            return response(['message' =>'All data synced'], 200);
        }

        foreach (array_chunk($data->response->docs, 10) as $rows) {

            if (JobListing::whereIn('reference_id', array_column($rows, 'id'))->get()) {
                continue;
            }

            array_walk($rows, function ($job) {
                $data = JobListing::firstOrCreate(['reference_id' => $job->id], [
                    'title' => $job->otsikko,
                    'description' => $job->kuvausteksti,
                    'company' => $job->tyonantajanNimi,
                    'posted_at' => $job->ilmoituspaivamaara,
                    'reference_id' => $job->id
                ]);
            });
        }

        return response(['message' => count(JobListing::all()).' Records created'], 200);
    }

    public function search(Request $request)
    {

    }

    public function sort(Request $request)
    {

    }
}
