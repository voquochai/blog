<?php

return [
	'general' => [
		'language' => 'vi',
		'google_coordinates' => '10.8537862, 106.62834440000006',
	],
	'languages' => [
		'vi' => 'Tiếng Việt'
	],
	'social' => [
		'vi' => 'vi_VN',
		'en' => 'en_US'
	],
	'payment_method' => [
		'1'	=>	'Thanh toán tại cửa hàng',
		'2'	=>	'Thanh toán khi nhận hàng',
		'3'	=>	'Chuyển khoản ngân hàng',
	],
	'order_site_status' => [
		'1'	=>	'Đơn hàng mới',
		'2'	=>	'Đang giao hàng',
		'3'	=>	'Đã nhận tiền',
		'4'	=>	'Hủy đơn hàng',
	],
	'order_site_labels' => [
		'1'	=>	'warning',
		'2'	=>	'success',
		'3'	=>	'primary',
		'4'	=>	'danger',
	],
	'payment_method_thuexe' => [
		'1'	=>	'Thanh toán tại cửa hàng',
		'2'	=>	'Chuyển khoản ngân hàng',
	],
	'order_thuexe_status' => [
		'1'	=>	'Đang thuê xe',
		'2'	=>	'Đã hoàn thành',
		'3'	=>	'Hủy phiếu',
	],
	'order_thuexe_labels' => [
		'1'	=>	'warning',
		'2'	=>	'success',
		'3'	=>	'danger',
	],
	'order' => [
		'san-pham' 	=>	[
			'page-title'	=>	'Đơn hàng',
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
		'thue-xe' 	=>	[
			'page-title'	=>	'Phiếu thuê xe',
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
		'default' 	=>	[
			'page-title'	=>	'Đơn hàng',
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
	],
	'supplier' => [
		'default' 	=>	[
			'page-title'	=>	'Nhà cung cấp',
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
	],
	'wms' => [
		'store'	=>	[
			'default' 	=>	[
				'page-title'	=>	'Kho hàng',
				'status'      => [
					'publish'     => 'Hiển thị'
				]
			],
		],
		'import'	=>	[
			'default' 	=>	[
				'page-title'	=>	'Nhập hàng',
				'status'      => [
					'publish'     => 'Hoàn thành',
					'cancel'     => 'Hủy phiếu',
				]
			],
		],
		'export'	=>	[
			'default' 	=>	[
				'page-title'	=>	'Xuất hàng',
				'status'      => [
					'publish'     => 'Hoàn thành',
					'cancel'     => 'Hủy phiếu',
				]
			],
		],
	],
	'category' => [
		'thue-xe'	=>	[
			'page-title'	=>	'Danh mục xe',
			'level' =>	1,
			'icon'	=>	false,
			'description' =>	false,
			'contents'    =>	false,
			'image'       =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				],
			],
			'status' => [
				'publish' => 'Hiển thị',
			]
		],
		'khach-san'	=>	[
			'page-title'	=>	'Danh mục khách sạn',
			'level' =>	1,
			'icon'	=>	false,
			'description' =>	false,
			'contents'    =>	false,
			'image'       =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				],
			],
			'status' => [
				'publish' => 'Hiển thị',
			]
		],
		'default'	=>	[
			'page-title'	=>	'Danh mục',
			'level' =>	1,
			'icon'	=>	false,
			'description' =>	false,
			'contents'    =>	false,
			'image'       =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status' => [
				'publish' => 'Hiển thị'
			]
		],
		'path'	=>	'uploads/categories'
	],
	'product' => [
		'thue-xe' 	=>	[
			'page-title'	=>	'Xe',
			'category'    =>	true,
			'supplier'    =>	false,
			'description' =>	true,
			'contents'    =>	false,
			'link'    =>	false,
			'attributes'    =>	true,
			'image'       =>	true,
			'images'      =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	300,
				],'_medium' => [
					'width'  =>	600,
					'height' =>	600,
				],'_large' => [
					'width'  =>	1000,
					'height' =>	1000,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			],
		],
		'khach-san' 	=>	[
			'page-title'	=>	'Khách sạn',
			'category'    =>	true,
			'supplier'    =>	false,
			'description' =>	true,
			'contents'    =>	false,
			'link'    =>	false,
			'attributes'    =>	true,
			'image'       =>	true,
			'images'      =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	300,
				],'_medium' => [
					'width'  =>	600,
					'height' =>	600,
				],'_large' => [
					'width'  =>	1000,
					'height' =>	1000,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			],
		],
		'default' 	=>	[
			'page-title'	=>	'Sản phẩm',
			'category'    =>	false,
			'supplier'    =>	false,
			'description' =>	false,
			'contents'    =>	false,
			'link'    =>	false,
			'attributes'    =>	false,
			'image'       =>	false,
			'images'      =>	false,
			'seo'	=>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			],
		],
		'path'    =>	'uploads/products'
	],
	'post' => [
		'tin-tuc' 	=>	[
			'page-title'	=>	'Tin tức',
			'category'    =>	true,
			'description' =>	true,
			'contents'    =>	true,
			'link'    =>	true,
			'seo'	=>	true,
			'attributes'    =>	false,
			'image'       =>	true,
			'images'      =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	360,
					'height' =>	240,
				],
			],
			'status'      => [
				'new'     => 'Mới',
				'publish'     => 'Hiển thị',
			],
			'post_tags'	=>	true,
		],
		'dich-vu' 	=>	[
			'page-title'	=>	'Dịch vụ',
			'category'    =>	false,
			'description' =>	true,
			'contents'    =>	true,
			'link'    =>	true,
			'seo'	=>	true,
			'attributes'    =>	false,
			'image'       =>	true,
			'images'      =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	360,
					'height' =>	240,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			],
			'post_tags'	=>	true,
		],
		'bo-suu-tap' 	=>	[
			'page-title'	=>	'Bộ sưu tập',
			'category'    =>	false,
			'description' =>	true,
			'contents'    =>	true,
			'link'    =>	true,
			'seo'	=>	true,
			'attributes'    =>	false,
			'image'       =>	true,
			'images'      =>	true,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	500,
					'height' =>	500,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			],
			'post_tags'	=>	true,
		],
		'chinh-sach-quy-dinh' 	=>	[
			'page-title'	=>	'Chính sách & Quy định',
			'category'    =>	false,
			'description' =>	false,
			'contents'    =>	true,
			'link'    =>	false,
			'seo'	=>	false,
			'attributes'    =>	false,
			'image'       =>	false,
			'images'      =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	130,
					'height' =>	130,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			],
			'post_tags'	=>	false,
		],
		'ho-tro-khach-hang' 	=>	[
			'page-title'	=>	'Hỗ trợ khách hàng',
			'category'    =>	false,
			'description' =>	false,
			'contents'    =>	true,
			'link'    =>	false,
			'seo'	=>	false,
			'attributes'    =>	false,
			'image'       =>	false,
			'images'      =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	130,
					'height' =>	130,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			],
			'post_tags'	=>	false,
		],
		'default' 	=>	[
			'page-title'	=>	'Bài viết',
			'category'    =>	false,
			'description' =>	false,
			'contents'    =>	false,
			'link'    =>	false,
			'seo'	=>	false,
			'attributes'    =>	false,
			'image'       =>	false,
			'images'      =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			],
			'post_tags'	=>	false,
		],
		'path'    =>	'uploads/posts'
	],
	'attribute' => [
		'san-pham' 	=>	[
			'product_hosting'	=>	false,
			'product_colors'	=>	true,
			'product_sizes'	=>	true,
			'product_tags'	=>	false,
		],
		'product_hosting' 	=>	[
			'page-title'	=>	'Hosting',
			'price'			=>	true,
			'colorpicker'	=>	false,
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'product_colors' 	=>	[
			'page-title'	=>	'Màu sắc',
			'price'			=>	false,
			'colorpicker'	=>	true,
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'product_sizes' 	=>	[
			'page-title'	=>	'Kích cỡ',
			'price'			=>	false,
			'colorpicker'	=>	false,
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'product_tags' 	=>	[
			'page-title'	=>	'Thẻ',
			'price'			=>	false,
			'colorpicker'	=>	false,
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'post_tags' 	=>	[
			'page-title'	=>	'Thẻ',
			'price'			=>	false,
			'colorpicker'	=>	false,
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'default' 	=>	[
			'page-title'	=>	'Thuộc tính',
			'price'			=>	false,
			'colorpicker'	=>	false,
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		]
	],
	'page' => [
		'san-pham-moi' 	=>	[
			'page-title'	=>	'Sản phẩm mới',
			'description' =>	true,
			'contents'    =>	false,
			'link'    =>	false,
			'seo'	=>	false,
			'image'       =>	true,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	370,
					'height' =>	230,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
		'gioi-thieu' 	=>	[
			'page-title'	=>	'Giới thiệu',
			'description' =>	false,
			'contents'    =>	true,
			'link'    =>	false,
			'seo'	=>	true,
			'image'       =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				],
			],
			'status'      => [
				'publish'     => 'Hiển thị',
			]
		],
        'tuyen-dung' 	=>	[
            'page-title'	=>	'Tuyển dụng',
            'description' =>	false,
            'contents'    =>	true,
            'link'    =>	false,
            'seo'	=>	true,
            'image'       =>	false,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	300,
                    'height' =>	200,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'lien-he' 	=>	[
            'page-title'	=>	'Liên hệ',
            'description' =>	false,
            'contents'    =>	true,
            'link'    =>	false,
            'seo'	=>	true,
            'image'       =>	false,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	300,
                    'height' =>	200,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'footer' 	=>	[
            'page-title'	=>	'Footer',
            'description' =>	false,
            'contents'    =>	true,
            'link'    =>	false,
            'seo'	=>	false,
            'image'       =>	false,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	300,
                    'height' =>	200,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
		'default' 	=>	[
			'page-title'	=>	'Trang tĩnh',
			'description' =>	false,
			'contents'    =>	false,
			'link'    =>	false,
			'seo'	=>	false,
			'image'       =>	false,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
		'path'    =>	'uploads/pages'
	],
	'photo' => [
        'slideshow' 	=>	[
            'page-title'	=>	'Slideshow',
            'description' =>	true,
            'link'    =>	true,
            'image'       =>	true,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	1920,
                    'height' =>	900,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'banner' 	=>	[
            'page-title'	=>	'Banner',
            'description' =>	false,
            'link'    =>	true,
            'image'       =>	true,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	585,
                    'height' =>	580,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'partners' 	=>	[
            'page-title'	=>	'Đối tác',
            'description' =>	false,
            'link'    =>	false,
            'image'       =>	true,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	200,
                    'height' =>	100,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'background' 	=>	[
            'page-title'	=>	'Background',
            'description' =>	false,
            'link'    =>	true,
            'image'       =>	true,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	1920,
                    'height' =>	450,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
		'default' 	=>	[
			'page-title'	=>	'Hình ảnh',
			'description' =>	false,
			'link'    =>	true,
			'image'       =>	true,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
		'path'    =>	'uploads/photos'
	],
	'link' => [
        'social' 	=>	[
            'page-title'	=>	'Mạng xã hội',
            'description' =>	false,
            'support' =>	false,
			'icon' =>	true,
			'youtube' =>	false,
            'link'    =>	true,
            'image'       =>	false,
            'thumbs'	=>	[
                '_small' => [
                    'width'  =>	300,
                    'height' =>	200,
                ],
            ],
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
		'default' 	=>	[
			'page-title'	=>	'Liên kết',
			'description' =>	false,
			'support' =>	false,
			'icon' =>	false,
			'youtube' =>	false,
			'link'    =>	true,
			'image'       =>	true,
			'thumbs'	=>	[
				'_small' => [
					'width'  =>	300,
					'height' =>	200,
				]
			],
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
		'path'    =>	'uploads/photos'
	],
	'register' => [
        'newsletter' 	=>	[
            'page-title'	=>	'Bản tin',
            'description' =>	false,
			'contents'    =>	false,
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
        'contact' 	=>	[
            'page-title'	=>	'Liên hệ',
            'description' =>	true,
			'contents'    =>	false,
            'status'      => [
                'publish'     => 'Hiển thị',
            ]
        ],
		'default' 	=>	[
			'page-title'	=>	'Đăng ký',
			'description' =>	false,
			'contents'    =>	false,
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
	],
	'comment' => [
		'default' 	=>	[
			'page-title'	=>	'Bình luận',
			'description' =>	true,
			'contents'    =>	false,
			'status'      => [
				'publish'     => 'Hiển thị'
			]
		],
	],
];