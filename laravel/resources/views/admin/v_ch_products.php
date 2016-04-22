<?PHP

$config = [
    "serv_id" => '11',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'تاریخ درج', 'cssClass' => 'medium',"readonly"=>"readonly"],
         ['type' => 'textbox', 'id' => 'f2', 'title' => 'تاریخ ویرایش', 'cssClass' => 'medium',"readonly"=>"readonly"],
        ['type' => 'textbox', 'id' => 'f3', 'title' => 'نام محصول', 'cssClass' => 'clear large', 'require' => 'require'],
        ['type' => 'textbox', 'id' => 'f4', 'title' => 'کدمحصول','cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 'f5', 'title' => 'قیمت (ریال)','cssClass' => 'clear medium'],
        ['type' => 'textbox', 'id' => 'f6', 'title' => 'قیمت (یوآن)','cssClass' => 'medium'],
        ['type' => 'textbox', 'id' => 'f7', 'title' => 'قیمت (دلار)','cssClass' => 'medium'],
        ['type' => 'textbox', 'id' => 'f8', 'title' => 'موجودی','cssClass' => 'clear small'],
        ['type' => 'autoSelect', 'id' => 'f9', 'title' => 'نوع محصول', 'cssClass' => '', 'gdd' => ['10', '1']],
        ['type' => 'textarea', 'id' => 'f10', 'title' => 'توضیحات', 'cssClass' => 'clear'],
    ],
    'details' => [
        'd1' => [
   
            ['type' => 'fileUploader', 'title' => 'تصویر', 'cssClass' => 'small'],
             ['type' => 'checkbox', 'title' => 'نصویر اصلی', 'cssClass' => 'small'],
        ]
 
    ],
    'list_colums' => [
        ['title' => 'شناسه'],
        ['title' => 'عنوان']
    ],
    'search_elements' => [
        ['type' => 'textbox', 'id' => 's1', 'label' => 'شناسه', 'cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 's2', 'label' => 'کد', 'cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 's3', 'label' => 'نام محصول', 'cssClass' => 'medium'],
        ['type' => 'autoSelect', 'id' => 's4', 'label' => 'نوع محصول','gdd' => ['10', '1']],

    ]
];

