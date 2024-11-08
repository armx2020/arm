<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.vacancy.vacancies', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }

    public function show_vacancy(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('vacancies.index')->with('alert', 'Вакансия не найдена');
        }
        return view('pages.vacancy.vacancy', [
            'city'   => $request->session()->get('city'),
            'vacancy' => $vacancy,
            'cities' => $cities
        ]);
    }

    public function show_resume(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

            $resume = Resume::with('user')->find($id);

            if (empty($resume)) {
                return redirect()->route('vacancies.index')->with('alert', 'Резюме не найдено');
            } else {
                return view('pages.vacancy.resume', [
                    'city'   => $request->session()->get('city'),
                    'resume' => $resume,
                    'cities' => $cities
                ]);
            }
    }
}
