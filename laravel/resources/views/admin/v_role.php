<?PHP

$config = [
    "serv_id" => '9',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'نقش فرد', 'cssClass' => 'large', 'require' => 'require'],
    ],
    'list_colums' => [
        ['title' => 'شناسه'],
        ['title' => 'عنوان']
    ],
    'search_elements' => [
        ['type' => 'textbox', 'id' => 's1', 'label' => 'شناسه', 'cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 's2', 'label' => 'عنوان'],
    ]
];

