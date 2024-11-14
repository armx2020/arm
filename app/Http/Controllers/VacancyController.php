<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('pages.vacancy.vacancies', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function show_vacancy(Request $request, $id)
    {
        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('vacancies.index')->with('alert', 'Вакансия не найдена');
        }
        return view('pages.vacancy.vacancy', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'vacancy' => $vacancy,
        ]);
    }

    public function show_resume(Request $request, $id)
    {
        $resume = Resume::with('user')->find($id);

        if (empty($resume)) {
            return redirect()->route('vacancies.index')->with('alert', 'Резюме не найдено');
        } else {
            return view('pages.vacancy.resume', [
                'region'   => $request->session()->get('region'),
                'regions' => $this->regions,
                'resume' => $resume,
            ]);
        }
    }
}
