<?PHP

$config = [
    "serv_id" => '6',
    'add' => true,
    'edit' => true,
    'delete' => false,
    'form_elements' => [
        ['type' => 'textbox', 'id' => 'f1', 'title' => 'تکسن معمولی', 'cssClass' => 'large', 'require' => 'require'],
        ['type' => 'checkbox', 'id' => 'f2', 'title' => 'چک باکس', "jsEvent" => "onload=alert('srgh')"],
         ['type' => 'checkbox', 'id' => 'f2', 'title' => 'چک باکس', "jsEvent" => "onload=alert('srgh')"],
        ['type' => 'autoComplete', 'id' => 'f3', 'title' => 'اتوکامپلیت', 'cssClass' => 'clear', "jsEvent" => "onkeypress=related(this,3,1)"],
        ['type' => 'comboSelect', 'id' => 'f11', 'title' => 'اتوکامپلیت', 'cssClass' => 'small clear', 'gdd' => ['3', '1']],
        ['type' => 'datePicker', 'id' => 'f4', 'title' => 'تاریخ'],
        ['type' => 'textarea', 'id' => 'f5', 'title' => 'تاریخ', 'cssClass' => 'clear'],
        ['type' => 'select', 'id' => 'f6', 'title' => 'تاریخ', 'value' => ["1" => "mard", "2" => "zan"]],
        ['type' => 'fileUploader', 'id' => 'f7', 'title' => 'uplodaer'],
        ['type' => 'multiSelect', 'id' => 'f16', 'title' => 'مولتی سلکت ', 'cssClass' => 'large clear', 'gdd' => ['3', '1']],
        ['type' => 'editor', 'id' => 'f9', 'title' => 'کلمات کلیدی', 'cssClass' => 'clear' /* 'width'=>'300','height'=>'300' */],
    ],
    'details' => [
        'd1' => [
            ['type' => 'textbox', 'title' => 'tttی', 'cssClass' => 'large'],
            ['type' => 'textbox', 'title' => 'faega', 'cssClass' => 'large']
        ],
        'd2' => [
            ['type' => 'autoComplete', 'title' => 'نام'],
            ['type' => 'textbox', 'title' => 'عدد'],
            ['type' => 'datePicker', 'title' => 'تاریخ'],
            ['type' => 'fileUploader', 'title' => 'editor']
        ]
    ],
    'list_colums' => [
        ['title' => 'شناسه'],
        ['title' => 'عنوان']
    ],
    'search_elements' => [
        ['type' => 'textbox', 'id' => 's1', 'label' => 'شناسه', 'cssClass' => 'small'],
        ['type' => 'textbox', 'id' => 's2', 'label' => 'label_1', 'cssClass' => 'large'],
        ['type' => 'textbox', 'id' => 's3', 'label' => 'label_1'],
        ['type' => 'textbox', 'id' => 's4', 'label' => 'label_1'],
        ['type' => 'autoComplete', 'id' => 's5', 'label' => 'اتوکامپلیت'],
        ['type' => 'datePicker', 'id' => 's6', 'label' => 'تاریخ'],
        ['type' => 'comboSelect', 'id' => 'f11', 'label' => 'اتوکامپلیت', 'gdd' => ['3', '1']],
    ]
];

