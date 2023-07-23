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
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('content');
            $grid->column('user.name');
            $grid->column('comment_count');
            $grid->column('forum.forum_name');
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
            $show->field('content');
            $show->field('user.name');
            $show->field('comment_count');
            $show->field('forum.forum_name');
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
            // TODO 这里修改之后会修改 forum 中的 froum_name 字段值 待检查
            $form->select('forum_id')
                ->options(Forum::class,'id','forum_name')->ajax('/api/forum');
            $form->text('title');
            $form->text('content');

        });
    }
}
