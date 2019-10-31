<?php

return [
    'page' => [
        'title' => 'Форма обратной связи',
    ],

    'form' => [
        'attributes' => [
            'name' => 'Имя',
            'contact' => 'Контактные данные',
            'content' => 'Текст сообщения',
            'file' => 'Прикрепляемый файл',
            'politics' => 'Согласие на обработку персональных данных',
        ],

        'labels' => [
            'name' => 'Имя',
            'contact' => 'Контактные данные',
            'content' => 'Текст сообщения',
            'politics' => 'Я согласен на обработку персональных данных',
            'file' => 'Прикрепить архив с дополнительной информацией:',
            'submit' => 'Отправить сообщение',
        ],

        /**
         * Чтобы указать пользовательское сообщение об ошибке только для определенного поля,
         * нужно использовать «dot» нотацию: сначала имя атрибута, а затем правило:
         */
        'validation' => [
            'name.required' => 'Вам необходимо представиться.',
            'contact.required' => 'Укажите контактные данные.',
            'content.required' => 'Введите текст вашего сообщения, пожалуйста.',
            'politics.accepted' => 'Для отправки сообщения необходимо согласие на обработку персональных данных.',
            'file.mimetypes' => 'Прикрепляемый файл может быть только архивом в формате: zip.',
            'file.max' => 'Прикрепляемый файл не может быть более :max Кб.',
        ],
    ],

    'messages' => [
        'subject' => 'Письмо с сайта '.env('APP_NAME'),
        'success' => 'Спасибо за сообщение!<br>Вы получите ответ в ближайшее время.',
        'failure' => 'Не удалось отправить письмо.',
    ],
];
