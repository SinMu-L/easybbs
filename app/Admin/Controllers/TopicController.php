<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Topic;
use App\Models\Forum;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TopicController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Topic::with(['forum','user']), function (Grid $grid) {
            // 禁用新建按钮
            $grid->disableCreateButton();
            $grid->column('id')->sortable();
            $grid->column('title');
            // setLabel 设置列名
            $grid->column('user.name')->setLabel('创建人');
            $grid->column('comment_count');
            $grid->column('forum.forum_name')->setLabel('所属板块');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, Topic::with(['forum','user']), function (Show $show) {
            $show->field('id');
            $show->field('title');
            // 转移html
            $show->field('content')->unescape();
            $show->field('user.name','创建人');
            $show->field('comment_count');
            $show->field('forum.forum_name','所属板块');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Topic::with(['forum']), function (Form $form) {
            $form->display('id');
            $form->select('forum_id')
                ->options(Forum::class,'id', 'forum_name')->ajax('/api/forum');
            $form->text('title');
            $form->editor('content');

        });
    }
}
