// contao/dca/tl_xippo_maps_marker.php
$GLOBALS['TL_DCA']['tl_xippo_maps_marker'] = [
    'config' => [
        'dataContainer' => 'Table',
		'ptable' => 'tl_xippo_maps',
		'ctable' => ['tl_content'],
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['title'],
            'flag' => 1,
            'panelLayout' => 'search,limit'
        ],
        'label' => [
            'fields' => ['title'],
        ],
        'operations' => [
			'edit' => [
                'href' => 'table=tl_content',
                'icon' => 'edit.svg',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ],
			'copy' => [
				'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['copy'],
				'href' => 'act=page&amp;mode=copy',
				'icon' => 'copy.gif'
			],
			'cut' => [
				'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['cut'],
				'href' => 'act=paste&amp;mode=cut',
				'icon' => 'cut.gif'
			],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg'
            ],
        ],
    ],
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
		'pid' => [
            'foreignKey' => 'tl_xippo_maps.title',
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
            'relation' => ['type'=>'belongsTo', 'load'=>'lazy'],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
        ],
        'title' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['title'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
            ],
            'sql' => ['type' => 'string', 'length' => 255, 'notnull' => true, 'default' => ''],
        ],
		'addImage' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['addImage'],
			'exclude' => true,
			'inputType' => 'checkbox',
			'eval' => ['submitOnChange'=>true],
			'sql' => ['type' => 'string', 'length' => 1, 'fixed' => true, 'notnull' => true, 'default' => ''],
		],
		'singleSRC' => [
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType' => 'radio',
                'files' => true,
                'filesOnly' => true,
                'extensions' => \Config::get('validImageTypes'),
                'mandatory' => false,
            ],
            'sql' => [ 'type' => 'binary', 'length' => 16, 'notnull' => false ],
            'save_callback' => [
                ['xippogmbh_contao_maps_bundle.dca_helper', 'storeFileMetaInformation'],
            ],
        ],
		'size' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['size'],
			'exclude' => true,
			'inputType' => 'imageSize',
			'reference' => &$GLOBALS['TL_LANG']['MSC'],
			'eval' => ['rgxp'=>'natural', 'includeBlankOption'=>true, 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'],
			'options_callback' => static function ()
			{
				return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
			},
			'sql' => [ 'type' => 'string', 'length' => 64, 'notnull' => true, 'default' => '' ],
		],
		'geox' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['geox'],
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 20, 'tl_class' => 'w50 wizard', 'require_input' => true ],
			'sql' => [ 'type' => 'string', 'length' => 20, 'notnull' => true, 'default' => '' ],
		],
		'geoy' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_maps_marker']['geoy'],
			'exclude' => true,
			'inputType' => 'text',
			'eval' => ['maxlength' => 20, 'tl_class' => 'w50 wizard', 'require_input' => true ],
			'sql' => [ 'type' => 'string', 'length' => 20, 'notnull' => true, 'default' => '' ],
		],
        'cssID' => [
			'label' => &$GLOBALS['TL_LANG']['tl_xippo_bs_slide']['cssID'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [ 'multiple' => true, 'size' => 2, 'tl_class' => 'w50 clr' ],
            'sql' => [ 'type' => 'string', 'length' => 255, 'notnull' => true, 'default' => '' ],
        ],
    ],
    'palettes' => [
        'default' => '{maps_legend},title,geox,geoy;{image_legend},addImage;{expert_legend:hide},cssID;',
		'__selector__' => [ 'addImage' ]
    ],
	'subpalettes' => [
		'addImage' => 'singleSRC,size;'
	],
];

