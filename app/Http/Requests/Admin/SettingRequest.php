<?php

namespace BBCMS\Http\Requests\Admin;

use Gate;

use BBCMS\Http\Requests\Request;

class SettingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.settings.modify');
    }

    public function sanitize()
    {
        $input = $this->except(['_token', '_method', 'submit']);

        // Do not change, save as is: $input['section_lang'] and $input['legend_lang'].

        // Set default attributes.
        $input['action'] = $input['action'] ?? 'setting';
        $input['section'] = $input['section'] ?? 'main';
        $input['fieldset'] = $input['fieldset'] ?? 'general';

        // By default type as string with delimiter `-`. Ex.: datetime-local.
        $input['type'] = string_slug($input['type'], '-');
        $input['name'] = string_slug($input['name'], '_');

        if ('select' == $input['type'] and ! empty($input['params'])) {
            $params = explode("\n", str_replace("\r\n", "\n", $input['params']));
            $input['params'] = array_combine($params, $params);
        }

        return $this->replace($input)->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module_name' => ['required', 'string', 'max:30', 'regex:/[a-z_]/'],
            'action' => ['required', 'string', 'max:20', 'in:creat,edit,setting'],
            'section' => ['required', 'string', 'max:20', 'alpha_dash'],
            'fieldset' => ['required', 'string', 'max:20', 'alpha_dash'],

            'name' => ['required', 'string', 'max:30', 'regex:/[a-z_]/'], // unique !!!
            'type' => ['required', 'string', 'max:20', 'regex:/[a-z-]/'],
            'value' => ['required', 'string', 'max:255'],
            'params' => ['nullable', 'array', 'required_if:type,select'],
            'params.*' => ['required', 'string', 'max:255'],
            'class' => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'html_flags' => ['nullable', 'string', 'max:500'],

            'title' => ['required', 'string', 'max:125', 'regex:/[\w\s-_]/'],
            'descr' => ['nullable', 'string', 'max:500'],

            // Not fillable attributes. Saved in language file through request() helper.
            'section_lang' => ['required', 'string', 'max:255'],
            'legend_lang' => ['required', 'string', 'max:255'],
        ];
    }

}
