<?php

namespace App\Livewire;
use App\Models\Form;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ReportLive extends Component
{
    public $quartiles = [];
    public $currentDateTime;
    public $quartRange = [];

    public function __construct(){
        $this->currentDateTime = Carbon::now()->toDateTimeString();
        $this->quartRange = ['2022-12-07 10:20:34', $this->currentDateTime];

    }
    

    public function submit()
    {
       
      

        //when 2025 change year or use getyear to keep it automatic
        foreach($this->quartiles as $quartile => $key){
            if ($key) {
                switch ($quartile) {
                    case 'all':
                        $this->quartRange = ['2022-01-07 10:20:34', '2028-12-07 10:20:37'];
                        break;
                    case 'q1':
                        $this->quartRange = ['2024-01-01 10:20:01', '2024-03-01 10:20:00'];
                        break;
                    case 'q2':
                        $this->quartRange = ['2024-03-01 10:20:01', '2024-06-01 10:20:00'];
                        break;
                    case 'q3':
                        $this->quartRange = ['2024-06-01 10:20:01', '2024-09-01 10:20:00'];
                        break;
                    case 'q4':
                        $this->quartRange = ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
                        break;
                }
            }

        }

      
      
     
       
    }


    public function render()
    {   
        $formdata =  FormData::all();
            
        $res =  Form::all();
            // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
            //     return $group->sortBy('age_group.min')->unique('age_group.min');
            // });

        
        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
        ->select('attribute_id', 'age_group_id', 
                DB::raw('SUM(male) as male'), 
                DB::raw('SUM(female) as female')
        )->whereBetween('created_at', $this->quartRange)
        ->get();

        $users = User::all();
        return view('livewire.report-live',[
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users
        ]);
    }

}
