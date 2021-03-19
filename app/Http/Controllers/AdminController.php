<?php

namespace App\Http\Controllers;
use App\User;
use App\Charts\SampleChart;
use App\Charts\SampleChart\color;
use Illuminate\Http\Request;
use App\{Admin,Client,Cabinet,Giac,Actionnaire,Intervenant,DemandeFinancement,
    DemandeRemboursementGiac,DemandeRemboursementOfppt, Domaine, Formation, ActionFormation,MissionIntervenant, Theme};
use DB;
// use Alert;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //duplicated from HomeController
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::orderBy('id', 'desc')->count();
        $cabinet = Cabinet::orderBy('nrc_cab', 'desc')->count();
        $intervenant = Intervenant::orderBy('id_interv', 'desc')->count();
        $client = Client::orderBy('nrc_entrp', 'desc')->count();
        $giac = Giac::orderBy('code_giac', 'desc')->count();
        $actionnaire = Actionnaire::orderBy('id_act', 'desc')->count();
        $df = DemandeFinancement::orderBy('n_df', 'desc')->count();
        $drb1 = DemandeRemboursementGiac::orderBy('n_drb', 'desc')->count();
        $drb2 = DemandeRemboursementOfppt::orderBy('n_drb', 'desc')->count();
        $plan = ActionFormation::orderBy('n_form', 'desc')->count();
        $misinv = MissionIntervenant::orderBy('id', 'desc')->count();
        $theme = Theme::all()->count();
        $domaine = Domaine::all()->count();
        $formation = Formation::all()->count();

        ////////////////////////////////////////////////////////////

        $today_client = Client::whereDate('created_at', today())->count();
        $yesterday_client = Client::whereDate('created_at', today()->subDays(1))->count();
        $client_2_days_ago = Client::whereDate('created_at', today()->subDays(2))->count();

        $chart1 = new SampleChart;
        $chart1->labels(['2 jours avant', 'Hier', "Aujourd'hui"]);
        $chart1->dataset('Clients', 'line', [$client_2_days_ago, $yesterday_client, $today_client])
        ->backgroundcolor(['#38c172','yellow','#e3342f']);

        ///////////////////////////////////////////////////////////

        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

        $chart2 = new SampleChart;
        $chart2->labels(['2 jours avant', 'Hier', "Aujourd'hui"]);
        $chart2->dataset('les utilisateurs', 'line', [$users_2_days_ago, $yesterday_users, $today_users])
        ->backgroundcolor(['#0080ff','yellow','#e3342f']);


        return view('layouts.dashboard',
        [
            'chart1' => $chart1,
            'chart2' => $chart2,
            'user' => $user,
            'client' => $client,
            'cabinet' => $cabinet,
            'giac' => $giac,
            'actionnaire' => $actionnaire,
            'intervenant' => $intervenant,
            'df' => $df,
            'drb1' => $drb1,
            'drb2' => $drb2,
            'plan' => $plan,
            'misinv' => $misinv,
            'domaine' => $domaine,
            'theme' => $theme,
            'formation' => $formation
        ]);

    }

}
