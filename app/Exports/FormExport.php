<?php

namespace App\Exports;

use App\Models\Form;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormController;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormExport implements FromView, ShouldAutoSize
{

    public $keywords, $startDate, $endDate;

    public function view() : view
    {
        $this->keywords = request()->keywords;
        $this->startDate = request()->startDate;
        $this->endDate = request()->endDate;

        if($this->keywords == 0) {
            $this->keywords = '';
        }

        if($this->endDate == 0) {
            $this->endDate = '';
        }

        if($this->startDate == 0) {
            $this->startDate = '';
        }

        $forms = Form::query()
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
                        })
                        ->orWhereHas('ward.district', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        })
                        ->orWhereHas('ward.district.region', function ($query) {
                            $query->where('name', 'like', '%' . $this->keywords . '%');
                        });
                });
            })
            ->when($this->startDate && $this->endDate, function ($query) {

                $query->whereBetween('created_at', [$this->startDate, $this->endDate]);

            })
            ->with(['added_by', 'form_attribute', 'ward' => function($query){
                $query->with(['district' => function($district){
                                $district->with('region');
                            }]);
            }])->where('status', true)
            ->latest()
            ->get();

        // $user = Auth::user();
        // $userforms = $user->forms;
        // $res =  $userforms;
        // $users = User::all();
       return view('exports.form_export', [
        'forms' =>  $forms,
        // 'users' => $users
       ]);
    }
}
