<?php

namespace App\Livewire;

use App\Models\Form;
use App\Models\FormData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReportLive extends Component
{
    public $keywords, $quartiles = [];
    public $currentDateTime;
    public $quartRange;
    public $selectedYear = '2024';
    public $startdate = "";
    public $enddate = "";

    public function mount()
    {
        $this->currentDateTime = now()->toDateTimeString();
        $this->quartRange = ['2022-12-07 10:20:34', $this->currentDateTime];
    }

    public function submit()
    {   
        
        foreach ($this->quartiles as $quartile => $isSelected) {
            if ($isSelected) {
                $this->quartRange = $this->getQuartileRange($quartile);
            }
        }
        
    }

    private function getQuartileRange($quartile)
    {
        switch ($quartile) {
            case 'all':
                return ['2022-01-07 10:20:34', $this->currentDateTime];
            case 'q1':
                return [$this->selectedYear.'-01-01 10:20:01', $this->selectedYear.'-03-01 10:20:00'];
            case 'q2':
                return [$this->selectedYear.'-03-01 10:20:01', $this->selectedYear.'-06-01 10:20:00'];
            case 'q3':
                return [$this->selectedYear.'-06-01 10:20:01', $this->selectedYear.'-09-01 10:20:00'];
            case 'q4':
                return ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
            case 'range':
                return ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
            default:
                return null;
        }
    }

    public function updateStartDate()
    {
        $this->quartRange = [$this->startdate, $this->enddate];
    }

    public function updateEndDate()
    {
        $this->quartRange = [$this->startdate, $this->enddate];
    }

    public function render()
    {
        $res = Form::where('status', true)
            ->latest()
            ->paginate(10);

        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
            ->select('attribute_id', 'age_group_id', 
                    DB::raw('SUM(male) as male'), 
                    DB::raw('SUM(female) as female')
            )->whereBetween('created_at', $this->quartRange)
            ->get();
        $this->quartiles = [];
        $users = User::all();

        return view('livewire.report-live', [
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users,
        ]);
    }
}
