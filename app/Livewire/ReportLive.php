<?php

namespace App\Livewire;
use App\Models\Form;
use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Livewire\Component;

class ReportLive extends Component
{
    public $keywords, $date, $from_date, $to_date;
    
    public $quartiles = [];
    public $quartRange = ['2023-12-07 10:20:34', '2023-12-07 10:20:37'];

    

    public function submit()
    {
       
        $quartiles = $this->quartiles;

        //when 2025 change year or use getyear to keep it automatic
        foreach($quartiles as $quartile => $key){
            if($quartile == 'all'){
                // $this->from_date = date('Y-m-d', strtotime($this->date));
                            
                $this->quartRange = ['2022-12-07 10:20:34', '2027-12-07 10:20:37'];
                
                $this->from_date = date('Y-m-d', strtotime($this->quartRange[0]));
                $this->to_date = date('Y-m-d', strtotime($this->quartRange[1]));
            }
            if($quartile == 'q1'){
                $this->quartRange = ['2024-01-01 10:20:01', '2024-03-01 10:20:00'];
                
            }
            if($quartile == 'q2'){
                $this->quartRange = ['2024-03-01 10:20:01', '2024-06-01 10:20:00'];
            }
            if($quartile == 'q3'){
                $this->quartRange = ['2024-06-01 10:20:01', '2024-09-01 10:20:00'];
            }
            if($quartile == 'q4'){
                $this->quartRange = ['2024-09-01 10:20:01', '2024-12-01 10:20:00'];
            }

        }

      
      
     
       
    }


    public function render()
    {   
        $formdata =  FormData::all();
            
        // $res =  Form::all();
            // $formdata = $formdata->groupBy('attribute_id','form_id')->map(function ($group) {
            //     return $group->sortBy('age_group.min')->unique('age_group.min');
            // });

        $res = Form::query()
            ->when($this->keywords, function ($query) {
                return $query->where(function ($query) {
                    $query->where('scanning_name', 'like', '%' . $this->keywords . '%')
                        // ->orWhere('created_at', $this->date)
                        ->orWhereHas('ward', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        })
                        ->orWhereHas('added_by', function ($query) {
                            $query->where('first_name', 'like', '%' . $this->keywords . '%')
                                ->orWhere('last_name', 'like', '%' . $this->keywords . '%');
                        });
                });
            })
            ->when($this->date, function ($query) {

                $query->whereBetween('created_at', $this->date);
        
            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])
            ->latest()
            ->paginate(10);
            
            
        $quartiles = $this->quartiles;

        //when 2025 change year or use getyear to keep it automatic
        foreach($quartiles as $quartile => $key){
            if($quartile == 'all'){
                // $this->from_date = date('Y-m-d', strtotime($this->date));
                            
                $this->quartRange = ['2022-12-07 10:20:34', '2027-12-07 10:20:37'];
                
                $this->from_date = $this->quartRange[0];
                $this->to_date = $this->quartRange[1];
            }
        }

        
        $formdata = FormData::groupBy(['attribute_id', 'age_group_id'])
        ->select('attribute_id', 'age_group_id', 
                DB::raw('SUM(male) as male'), 
                DB::raw('SUM(female) as female')
        )
        ->when($this->from_date, $this->to_date, function ($query) {

            $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
    
        })
        // ->whereBetween('created_at', $this->quartRange)
        ->get();

        $users = User::all();
        return view('livewire.report-live',[
            'forms' => $res,
            'formDatas' => $formdata,
            'users' => $users
        ]);
    }

}