<?php

namespace App\Livewire\AdminPanel;

use App\Models\Form;
use App\Models\Ward;
use Livewire\Component;
use App\Models\District;

class CreateForm extends Component
{
    public $form, $form_attribute_id, $scanning_name, $district_id, $ward_id, $address, $created_by, $rc_name;

    public function mount($form_attributes_id) {
        $this->form_attribute_id = $form_attributes_id;

    }

    protected function rules() {

        return [
            'scanning_name' => ['required', 'string'],
            'district_id' => ['required', 'string'],
            'ward_id' => ['required', 'string'],
            'address' => ['required', 'string'],
            'created_by' => ['required', 'string']
        ];

    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveForm() {
        $validatedData = $this->validate();

        $checkFormExists = Form::where('scanning_name', $validatedData['scanning_name'])->exists();

        if ($checkFormExists) {
            session()->flash('already_exist', 'The Attribute already exists.');

        } else {
        
            $form = Form::create([
                'form_attribute_id' => $this->form_attribute_id,
                'scanning_name' => $validatedData['scanning_name'],
                'ward_id' => $validatedData['ward_id'],
                'address' => $validatedData['address'],
                'created_by' => $validatedData['created_by'],
            ]);

            if ($form) {
                $form_id = Form::latest()->first()->id;
                $this->clearForm();

                return redirect(route('admin.form_data', ['form_id' => $form_id]));

            } else {
                session()->flash('error', 'An error occurred. Try again later.');
            }

        }

    }

    public function clearForm()
    {
        $this->form_attribute_id = '';

        $this->reset(
            'scanning_name',
            'scanning_name',
            'district_id',
            'ward_id',
            'address'
        );

    }

    public function render()
    {
        $this->created_by = auth()->user()->id;
        $this->rc_name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        
        $districts = District::all();
        $wards = Ward::when(!empty($this->district_id), function ($query) {
            $query->where('district_id', 'like', '%'. $this->district_id . '%');
            })->get();

        return view('livewire.admin-panel.create-form', [
            'districts' => $districts,
            'wards' => $wards,
        ]);
    }
}
