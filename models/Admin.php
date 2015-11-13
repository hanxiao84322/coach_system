<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $type
 * @property string $last_login_time
 * @property string $ip_address
 * @property integer $group_id
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property AdminGroup $group
 */
class Admin extends \yii\db\ActiveRecord
{

    //状态
    const GENERAL = 1; // 一般
    const SUPER = 2; // 超级

    static public $typeList = [
        self::GENERAL => '一般管理员',
        self::SUPER => '超级管理员'
    ];

    public $password_repeat;

    const CONFIGURATION = 1;
    const TOOL = 2;
    const NEWS = 3;
    const USERS = 4;
    const TEACHERS = 5;
    const TRAIN = 6;
    const ACTIVITY = 7;
    const ORDER = 8;
    const MESSAGES = 9;

    public static $menuTitle = [
        self::CONFIGURATION => '系统设置',
        self::TOOL => '工具',
        self::NEWS => '信息发布',
        self::USERS => '学员管理',
        self::TEACHERS => '讲师管理',
        self::TRAIN => '班课管理',
        self::ACTIVITY => '活劢管理',
        self::ORDER => '财务管理',
        self::MESSAGES => '站内消息'
    ];

    public static $menu = [
        self::CONFIGURATION => [
        'label' => '系统设置', 'url' => ['/Admin/admin'],
        'items' => [
            [
                'label' => '管理员角色',
                'url' => ['/Admin/admin']
            ],
            [
                'label' => '附件设置',
                'url' => ['/Admin/configuration/update?id=2']
            ],
            [
                'label' => '邮件设置',
                'url' => ['/Admin/configuration/update?id=2']
            ],
            [
                'label' => '全站功能管理',
                'url' => ['/Admin/configuration/all-setting']
            ],
            [
                'label' => '站点设置',
                'url' => ['/Admin/configuration/web-setting']
            ],
            [
                'label' => '内容管理',
                'url' => ['/Admin/pages']
            ],
//                [
//                    'label' => '登陆设置',
//                    'url' => ['/Admin/configuration/update?id=2']
//                ]
            ]
        ],
        self::TOOL => [
            'label' => '工具', 'url' => ['/Admin/tools/clear'],
            'items' => [
                [
                    'label' => '更新缓存',
                    'url' => ['/Admin/tools/clear']
                ],
                [
                    'label' => '数据库备份',
                    'url' => ['/Admin/tools/backup']
                ],
                [
                    'label' => '上传文件管理',
                    'url' => ['/Admin/tools/attachments']
                ],
                [
                    'label' => '运行记录',
                    'url' => ['/Admin/tools/run-log']
                ]
            ]
        ],
        self::NEWS => [
            'label' => '信息发布', 'url' => ['/Admin/news-category'],
            'items' => [
                [
                    'label' => '栏目管理',
                    'url' => ['/Admin/news-category']
                ],
                [
                    'label' => '文章列表操作',
                    'url' => ['/Admin/news']
                ],
                [
                    'label' => '添加文章',
                    'url' => ['/Admin/news/create']
                ]
            ]
        ],
        self::USERS => [
            'label' => '学员管理', 'url' => ['/Admin/users'],
            'items' => [
                [
                    'label' => '学员等级设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '培训报名审核',
                    'url' => ['/Admin/users']
                ],
    //                [
    //                    'label' => '注册资格审核',
    //                    'url' => ['/Admin/users/create']
    //                ],
                [
                    'label' => '添加学员',
                    'url' => ['/Admin/users/create']
                ],
                [
                    'label' => '成绩管理',
                    'url' => ['/Admin/train-users']
                ],
                [
                    'label' => '分值管理',
                    'url' => ['/Admin/activity-users']
                ],
                [
                    'label' => '证书管理',
                    'url' => ['/Admin/users-level/certificate-number']
                ],
                [
                    'label' => '发布信息管理',
                    'url' => ['/Admin/news']
                ],
                [
                    'label' => '教练注册信息管理',
                    'url' => ['/Admin/users-level']
                ],
                [
                    'label' => '暂停学员',
                    'url' => ['/Admin/users/stop?UsersSearch[status]=2']
                ]
            ]
        ],
        self::TEACHERS => [
            'label' => '讲师管理', 'url' => ['/Admin/teachers'],
            'items' => [
                [
                    'label' => '讲师角色设置',
                    'url' => ['/Admin/teachers-level']
                ],
                [
                    'label' => '讲师列表操作',
                    'url' => ['/Admin/teachers']
                ],
    //                [
    //                    'label' => '讲师评分管理',
    //                    'url' => ['/Admin/teachers-score']
    //                ],
                [
                    'label' => '发布信息管理',
                    'url' => ['/Admin/news']
                ],
                [
                    'label' => '暂停讲师',
                    'url' => ['/Admin/teachers/stop?TeachersSearch[status]=2']
                ]
            ]
        ],
        self::TRAIN => [
            'label' => '班课管理', 'url' => ['/Admin/train'],
            'items' => [
                [
                    'label' => '班型级别设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '班型类别设置',
                    'url' => ['/Admin/train-category']
                ],
                [
                    'label' => '培训课程管理',
                    'url' => ['/Admin/train']
                ],
                [
                    'label' => '添加培训课程',
                    'url' => ['/Admin/train/create']
                ],
                [
                    'label' => '培训地管理',
                    'url' => ['/Admin/train-land']
                ],
                [
                    'label' => '成绩管理',
                    'url' => ['/Admin/train-users']
                ],
                [
                    'label' => '考勤管理',
                    'url' => ['/Admin/train-users/attendance']
                ],
            ]
        ],
        self::ACTIVITY => [
            'label' => '活劢管理', 'url' => ['/Admin/activity'],
            'items' => [
                [
                    'label' => '活劢级别设置',
                    'url' => ['/Admin/level']
                ],
                [
                    'label' => '活劢类别设置',
                    'url' => ['/Admin/activity-category']
                ],
                [
                    'label' => '活劢管理',
                    'url' => ['/Admin/activity']
                ],
                [
                    'label' => '添加活劢',
                    'url' => ['/Admin/activity/create']
                ],
                [
                    'label' => '活劢地管理',
                    'url' => ['/Admin/news']
                ],
                [
                    'label' => '分值管理',
                    'url' => ['/Admin/activity-users']
                ],
                [
                    'label' => '完成度管理',
                    'url' => ['/Admin/activity-users/activity-process']
                ],
            ]
        ],
        self::ORDER => [
            'label' => '财务管理', 'url' => ['/Admin/orders'],
            'items' => [
                [
                    'label' => '订单审核',
                    'url' => ['/Admin/orders?OrdersSearch[status]=0']
                ],
                [
                    'label' => '缴费管理',
                    'url' => ['/Admin/orders']
                ],
    //                [
    //                    'label' => '财务汇总',
    //                    'url' => ['/Admin/orders/collect']
    //                ]
            ]
        ],
        self::MESSAGES => [
            'label' => '站内消息', 'url' => ['/Admin/messages'],
            'items' => [
                [
                    'label' => '模板管理',
                    'url' => ['/Admin/messages']
                ],
                [
                    'label' => '最新公告管理',
                    'url' => ['/Admin/messages-users?MessagesUsersSearch[type]=1']
                ],
                [
                    'label' => '系统通知管理',
                    'url' => ['/Admin/messages-users?MessagesUsersSearch[type]=2']
                ]
            ]
        ]
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['username'], 'required'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message'=> '两次输入的密码不一致！'],
            [['username', 'password', 'ip_address', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['email', 'group_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'password_repeat' => '重复密码',
            'email' => '邮箱',
            'type' => '类型',
            'last_login_time' => '最后登录时间',
            'ip_address' => '登陆ip',
            'group_id' => '权限组',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $admin = (new \yii\db\Query())
            ->select(['*'])
            ->from(self::tableName())
            ->where('username=:username', [':username'=>$username])
            ->one();
        return new static($admin);

    }

    /*
     * get sex name
     */
    public static  function getTypeName($type)
    {
        return isset(self::$typeList[$type]) ? self::$typeList[$type] : $type;
    }
    public static function getGroup($group)
    {
        $str = '';
        if (!empty($group)) {
            $groupArray = explode(',', $group);
            foreach($groupArray as $key => $val) {
                $str .= self::$menuTitle[$val] . "&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        }
        return $str;

    }

    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
            if ($this->isNewRecord) {
                $this->create_time = date('Y-m-d H:i:s', time());
                $this->create_user = 'admin';
                $this->update_time = date('Y-m-d H:i:s', time());
                $this->update_user = 'admin';
            } else {
                $this->update_time = date('Y-m-d H:i:s', time());
                $this->update_user = 'admin';
            }
            return true;
        } else {
            return false;
        }
    }
}
