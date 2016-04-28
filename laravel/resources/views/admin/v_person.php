<?PHP

$config = [
    "serv_id" => '8',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'تاریخ درج', 'cssClass' => 'medium', "readonly" => "readonly"],
        ['type' => 'textbox', 'id' => 'f2', 'title' => 'تاریخ ویرایش', 'cssClass' => 'medium', "readonly" => "readonly"],
        ['type' => 'textbox', 'id' => 'f3', 'title' => 'نام', 'cssClass' => 'clear', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f4', 'title' => 'نام خانوادگی', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f5', 'title' => 'کد ملی', 'cssClass' => 'medium clear'],
        ['type' => 'textbox', 'id' => 'f6', 'title' => 'تلفن', 'cssClass' => 'medium '],
        ['type' => 'textbox', 'id' => 'f7', 'title' => 'تلفن همراه', 'cssClass' => 'medium ', 'require' => 'require'],
        ['type' => 'autoSelect', 'id' => 'f8', 'title' => 'نقش', 'cssClass' => ' clear', 'require' => 'require', 'gdd' => ['9', '1']],
        ['type' => 'textbox', 'id' => 'f9', 'title' => 'ایمیل'],
        ['type' => 'textarea', 'id' => 'f10', 'title' => 'آدرس', 'cssClass' => ' clear'],
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

