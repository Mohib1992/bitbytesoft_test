<?php

namespace App\Http\Controllers;


use App\JobListing;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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

    public function getData(Request $request)
    {
        return $this->parseData($request);
    }

    private function parseData($params)
    {
        $jobs = JobListing::query();

        if ($params->get('query')) {
            $jobs->where('title', 'like', '%'.$params->get('query').'%');
        }

        if (!$params->get('field') && !$params->get('orderBy')) {
            $jobs->orderBy('title', 'desc');
        } else {
            $jobs->orderBy($params->get('field'), $params->get('orderBy'));
        }

        if (!$jobs)
            return response(404);

        $result = $jobs->paginate(20, ['*'], 'page', (int) $params->get('page') ?: 1);

        if ($result->total() <= 20) {
            $result = $jobs->paginate(20, ['*'], 'page', 1);
        }

        return response($result , 200);
    }
}
