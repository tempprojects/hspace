<?php 
    use yii\helpers\Html;
    use yii\widgets\Menu;
?>

 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <?php 
                    echo Yii::$app->user->identity->avatar? Html::img(Yii::$app->urlManagerFrontEnd->createUrl('media/profile/avatar/'. Yii::$app->user->identity->avatar),[
                    'alt'=>'User Avatar',
                    'class'=> 'img-circle'
                ]): '<img src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
                ?>
                </div>
            <div class="pull-left info">
                <p>
                    <?php 
                        echo Yii::$app->user->identity->first_name; 
                        echo " ";
                        echo Yii::$app->user->identity->last_name;
                    ?>
                </p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->

            <?php
                echo Menu::widget([
                    'activeCssClass'=>'active',
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [['label' => 'DASHBOARD', 'url' => ['/']],
//                                ['label' => 'Управління правами', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-dashboard"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
//                                    'items' => [['label' => 'Керування ролями', 'url' => ['/permit/access/role'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
//                                                ['label' => 'Керування правами доступу', 'url' => ['/permit/access/permission'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-yellow"></i>{label}</a>']
//                                               ]
//                                ],
                                ['label' => 'Користувачі', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-user"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Користувачі', 'url' => ['/users/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Створити користувача', 'url' => ['/users/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Не активовані користувачі', 'url' => ['/users/inactive'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                                ['label' => 'Кошик', 'url' => ['/users/recyclebin'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                                ['label' => 'Спеціалізації', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-list-alt"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                                    'items' => [
                                                        ['label' => 'Всі Спеціалізації', 'url' => ['/specialization/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                    ]
                                                ],
                                                ['label' => 'Колекції', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-list-alt"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                                    'items' => [
                                                        ['label' => 'Всі Колекції', 'url' => ['/portfolio-collections/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                    ]
                                                ],
                                               ]
                                ],
                                ['label' => 'Роботи', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-gavel"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі тоботи', 'url' => ['/portfolio/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Нові роботи', 'url' => ['/portfolio/newworks'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Create new work', 'url' => ['/portfolio/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Нагороди', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-trophy"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі нагороди', 'url' => ['/user-honours/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Нові наороди', 'url' => ['/user-honours/newhonours'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Create new honour', 'url' => ['/user-honours/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Відео', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-video-camera"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі відео', 'url' => ['/user-videos/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Create new video', 'url' => ['/user-videos/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Ліцензії', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-list"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі ліцензії', 'url' => ['/user-licenses/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Нові Ліцензії', 'url' => ['/user-licenses/newlicenses'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Create new license', 'url' => ['/user-licenses/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Реклама', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-buysellads"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Вся Реклама', 'url' => ['/publicity/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                                ['label' => 'Нова реклама', 'url' => ['/publicity/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Продукти', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-tag"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                                    'items' => [['label' => 'Всi продукти', 'url' => ['/products-list/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                        ['label' => 'Новий продукт', 'url' => ['/products-list/create'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                    ]
                                ],
                                ['label' => 'Коментарі Профайла', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-commenting"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі Коментарі', 'url' => ['/profile-reviews/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Переклади', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-file-text"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>', 
                                    'items' => [['label' => 'Всі Переклади', 'url' => ['/translation/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-aqua"></i>{label}</a>'],
                                               ]
                                ],
                                ['label' => 'Конфiгурацiї ', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-dashboard"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                                    'items' => [['label' => 'Всі конфігурації', 'url' => ['configs/config'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],

                                    ]
                                ],
                                ['label' => 'Права доступу ', 'url' => ['#'],'options' => ['class' => 'treeview'], 'template' =>'<a href="{url}" ><i class="fa fa-dashboard"></i> <span>{label}</span> <i class="fa fa-angle-left pull-right"></i></a>',
                                    'items' => [//['label' => 'Всі дії', 'url' => ['action/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                                ['label' => 'Всі ролі', 'url' => ['auth-item/index'], 'template' => '<a href="{url}" ><i class="fa fa-circle-o text-red"></i>{label}</a>'],
                                    ],

                                ],
                            ],
                    'submenuTemplate' => '<ul class="treeview-menu">{items}</ul>',
                    'activateParents' => true,
                    'activateItems' => true,
                    ]);
            ?>

            <!--
            <ul class="sidebar-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
          -->
        </section>

        <!-- /.sidebar -->
      </aside>