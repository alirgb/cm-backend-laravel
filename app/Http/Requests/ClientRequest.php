<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * another implementation using Rule::when() to differntiate between ruls of create and update methods
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'     => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'regex:/^[\pL\s]+$/u'
            ], //accepts only letters space
            'address' => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'regex:/^[\pL\s\-\,\d]+$/u'
            ], //accepts only letters numbers space comma hyphen
            'telephone' => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'regex:/^20\d{9}$/u'
            ],   //accepts telephone number of 11 digits starting with 20
            'mobile' => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'regex:/^201[0125]\d{8}$/u'
            ], // accepts mobile number starting with 2010 or 2011 or 2012 or 2015 with 12 digits
            'image' => [
                Rule::when(request()->isMethod('POST'), 'required'),
                Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'image'
            ]
        ];
    }

    // 'telephone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
    //             /**
    //              * telephone regex matches the patterns for 10 digits tel no. with or without country code
    //              * 123-456-7890
    //              *(123) 456-7890
    //              *123 456 7890
    //              *123.456.7890
    //              *+91 (123) 456-7890
    //              *+2 202 123 4569
    //              *2021654329
    //              */
}
