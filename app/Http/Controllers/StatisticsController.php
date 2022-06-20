<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate') ?? Carbon::now()->subMonth()->format('Y-m-d');
        $endDate = $request->input('endDate') ?? Carbon::now()->format('Y-m-d');

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        if ($startDate->gt($endDate)) {
            return redirect()->route('admin.statistics.index')
                ->with('alert-msg', 'A data inicial deve ser menor que a data final.')
                ->with('alert-color', 'red')
                ->with('alert-icon', 'error');
        }

        $dataset = cache()->remember('dataset' . $startDate . $endDate, 60, function () use ($startDate, $endDate) {
            return Film::with('screenings')->get()->filter(function ($film) use ($startDate, $endDate) {
                return $film->screenings
                    ->where('data', '>=', $startDate)
                    ->where('data', '<=', $endDate)
                    ->count() > 0;
            })->sortByDesc(function ($film) {
                return $film->screenings->map(function ($screening) {
                    return $screening->tickets->count();
                })->sum();
            })->mapWithKeys(function ($film) {
                return [$film->titulo => $film->screenings->map(function ($screening) {
                    return $screening->tickets->count();
                })->sum()];
            })->take(10);
        });

        $films = $dataset->keys()->toArray();

        $dataset = [
            [
                "label" => "Bilhetes",
                "backgroundColor" => "#0694a2",
                "borderWidth" => 1,
                "data" => $dataset->values()->toArray(),
            ],
        ];

        return view('admin.statistics.index', compact('films', 'dataset', 'startDate', 'endDate'));
    }
}
