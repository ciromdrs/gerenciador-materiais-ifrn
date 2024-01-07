<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class ValidacaoMaterial extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'max:50'],
            // TODO: Colocar validações da foto numa entrada só
            'foto' => ['image'],
            // TODO: Reduzir tamanho da imagem antes de salvar
            'foto' => File::image()->max('10mb'),
            // 'categorias[]' => ['required']
        ];
    }
    public function messages(): array
    {
        return [
            // 'categorias[].required' => 'É preciso informar pelo menos uma categoria',
        ];
    }
}
