<?php
/* @var $directoryAsset */
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'User', 'url' => ['/user'], 'active' => $this->context->id === 'user'],
                    ['label' => 'Shop', 'icon' => 'folder',
                        'items' => [
                            ['label' => 'Brand', 'icon' => 'file-o', 'url' => ['/shop/brand'], 'active' => $this->context->id === 'shop/brand'],
                            ['label' => 'Tag', 'icon' => 'file-o', 'url' => ['/shop/tag'], 'active' => $this->context->id === 'shop/tag'],
                            ['label' => 'Category', 'icon' => 'file-o', 'url' => ['/shop/category'], 'active' => $this->context->id === 'shop/category'],

                        ]
                    ],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                ],
            ]
        ) ?>

    </section>

</aside>
