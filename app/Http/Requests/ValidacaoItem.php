<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
class ValidacaoItem extends FormRequest
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
            'estado_conservacao'=>['required','max:50'],
            'local_id'=>['required'],
            'material_id'=>['required'],
            // TODO: Colocar validações da foto numa entrada só
            'foto' => ['image'],
            // TODO: Reduzir tamanho da imagem antes de salvar
            'foto'=>File::image()->max('10mb'),
        ];
    }
}
