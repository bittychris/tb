<?php

namespace App\Livewire\AdminPanel;

use App\Models\AgeGroup;
use App\Models\Attribute;
use App\Models\District;
use App\Models\Form;
use App\Models\FormAttribute;
use App\Models\FormData as ModelsFormData;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormData extends Component
{
    public $form;
    public $form_id;
    public $scanning_name;
    public $region_id;
    public $districts = [];
    public $district_id;
    public $wards = [];
    public $ward_id;
    public $address;

    public $ageGroups = [];
    public $attributeList = [];

    public $formData = [];


    public function mount(Form $form)
    {
        $this->form = $form;
        $this->scanning_name = $form->scanning_name;
        $this->form_id = $form->form_attribute_id;
        $this->address = $form->address;
        $this->ward_id = $form->ward_id;

        if ($this->form) {
            $this->wards = Ward::all();
            $this->updatedFormId();

            $formData = \App\Models\FormData::where('form_id', $form->id)
                ->get();

            foreach ($formData as $data) {
                $this->formData[$data->age_group_id][$data->attribute_id]['M'] = $data->male;
                $this->formData[$data->age_group_id][$data->attribute_id]['F'] = $data->female;
            }
        }
    }

    protected $rules = [
        'scanning_name' => ['required'],
//        'region_id' => ['required'],
//        'district_id' => ['required'],
        'ward_id' => ['required'],
        'address' => ['required'],
    ];

    public function saveForm()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->form) {
                $formTb = $this->form;
            } else {
                $formTb = new Form();
            }

            $formTb->form_attribute_id = $this->form_id;
            $formTb->created_by = Auth::id();
            $formTb->completed_by = Auth::id();
            $formTb->scanning_name = $this->scanning_name;
            $formTb->ward_id = $this->ward_id;
            $formTb->address = $this->address;
            $formTb->save();

            if ($this->form) {
                foreach ($this->formData as $groupId => $age_group) {
                    foreach ($age_group as $attributeId => $value) {
                        $existingRecord = \App\Models\FormData::where([
                            'form_id' => $formTb->id,
                            'age_group_id' => $groupId,
                            'attribute_id' => $attributeId,
                        ])->first();

                        if ($existingRecord) {

                            $existingRecord->update([
                                'male' => array_key_exists('M', $value) ? $value['M'] : null,
                                'female' => array_key_exists('F', $value) ? $value['F'] : null,
                            ]);
                        } else {
                            \App\Models\FormData::create([
                                'form_id' => $formTb->id,
                                'age_group_id' => $groupId,
                                'attribute_id' => $attributeId,
                                'male' => array_key_exists('M', $value) ? $value['M'] : null,
                                'female' => array_key_exists('F', $value) ? $value['F'] : null,
                            ]);
                        }
                    }
                }
            } else {
                foreach ($this->formData as $groupId => $age_group) {
                    foreach ($age_group as $attributeId => $value) {
                        \App\Models\FormData::create([
                            'form_id' => $formTb->id,
                            'age_group_id' => $groupId,
                            'attribute_id' => $attributeId,
                            'male' => array_key_exists('M', $value) ? $value['M'] : null,
                            'female' => array_key_exists('F', $value) ? $value['F'] : null,
                        ]);
                    }
                }
            }

            DB::commit();
            if ($this->form) {
                $this->dispatch('message_alert', 'Data update.');
            } else {
                return redirect(route('admin.report'))->with('success', 'Data saved.');
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            $this->dispatch('failure_alert', $th->getMessage());
        }
    }

    public function updatedFormId()
    {
        $formsAttributes = FormAttribute::where('id', $this->form_id)->first();

        $this->ageGroups = AgeGroup::whereIn('id', json_decode($formsAttributes->age_group_ids))->get();
        $this->attributeList = Attribute::whereIn('id', json_decode($formsAttributes->attribute_ids))->get();
    }

    public function updatedRegionId()
    {
        $this->districts = District::where('region_id', $this->region_id)->get();
    }

    public function updatedDistrictId()
    {
        $this->wards = Ward::where('district_id', $this->district_id)->get();
    }

    public function render()
    {
        $formsAttributes = FormAttribute::all();
        $regions = Region::all();
        return view('livewire.admin-panel.form-data', [
            'formsAttributes' => $formsAttributes,
            'regions' => $regions
        ]);
    }
}
