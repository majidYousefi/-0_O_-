<?PHP

$config = [
    "serv_id" => '10',
    'add' => true,
    'edit' => true,
    'delete' => true,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'تاریخ درج', 'cssClass' => 'medium',"readonly"=>"readonly"],
         ['type' => 'textbox', 'id' => 'f2', 'title' => 'تاریخ ویرایش', 'cssClass' => 'medium',"readonly"=>"readonly"],
        ['type' => 'textbox', 'id' => 'f3', 'title' => 'شماره فاکتور', 'cssClass' => 'clear medium', 'require' => 'require'],
        ['type' => 'autoComplete', 'id' => 'f4', 'title' => 'نام خریدار','cssClass' => 'large','gdd' => ['8', '1']],
    ],
    'details' => [
        'd1' => [
   
            ['type' => 'autoComplete', 'title' => 'کالا','gdd' => ['5', '1']],
             ['type' => 'textbox', 'title' => 'تعداد', 'cssClass' => 'small'],
               ['type' => 'textbox', 'title' => 'قیمت', 'cssClass' => 'small'],
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
        ['type' => 'autoSelect', 'id' => 's4', 'label' => 'نوع محصول','gdd' => ['7', '1']],

    ]
];

