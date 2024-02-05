<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FieldDataExport implements FromView, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     //
    // }

    public $keywords, $submission_status, $startDate, $endDate;

    public function view() : view
    {
        $this->keywords = request()->keywords;
        $this->startDate = request()->startDate;
        $this->endDate = request()->endDate;
        $this->submission_status = request()->submission_status;

        if($this->keywords == 0) {
            $this->keywords = '';
        }

        if($this->endDate == 0) {
            $this->endDate = '';
        }

        if($this->startDate == 0) {
            $this->startDate = '';
        }

        $reports = Form::query()
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
                ->when($this->submission_status, function ($query) {

                    $query->where(function ($query) {

                        if ($this->submission_status == 'submitted') {

                            $query->where('status', 1);

                        } elseif ($this->submission_status == 'not_submitted') {

                            $query->where('status', 0);

                        } elseif ($this->submission_status == 'all') {

                            $query->whereIn('status', [0, 1]);

                        } else {

                            $query->where('status', [0, 1]);

                        }

                    });

                    // $query->where('status', $this->submission_status == 'submitted' ? 1 : ($this->submission_status == 'not_submitted' ? 0 : ($this->submission_status == 'all' ? [0, 1] : 0)))
                    // $query->where('status', $this->submission_status == 'submitted' ? 1 : ($this->submission_status == 'not_submitted' ? 0 : [0, 1]));

                })
                ->when($this->startDate && $this->endDate, function ($query) {

                    $query->whereBetween('created_at', [$this->startDate, $this->endDate]);

                })
                ->with(['added_by', 'form_attribute', 'ward' => function($query){
                    $query->with(['district' => function($district){
                                    $district->with('region');
                                }]);
                }])
                ->where('created_by', Auth::user()->id)
                ->latest()
                ->get();

        // $user = Auth::user();
        // $userforms = $user->forms;
        // $res =  $userforms;
        // $users = User::all();
       return view('exports.rc_form_export', [
        'reports' =>  $reports,
        // 'users' => $users
       ]);
    }

}