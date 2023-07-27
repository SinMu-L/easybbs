<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Comment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Contracts\Auth\UserProvider;

class   CommentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Comment(['topic','user']), function (Grid $grid) {
            // 禁用编辑按钮
            $grid->disableEditButton();
            $grid->column('id')->sortable();
            $grid->column('content')->display(function ($v){

                return mb_substr(html_entity_decode($v),0,10) . '...';
            });
            $grid->column('topic.title')->setLabel('所属话题');
            $grid->column('user.name')->setLabel('创建人');
            $grid->column('created_at')->sortable();

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
        return Show::make($id, new Comment(['topic','user']), function (Show $show) {
            $show->disableEditButton();

            $show->field('id');
            $show->field('content')->unescape();
            $show->field('topic.title','所属话题');
            $show->field('user.name','创建人');
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
        return Form::make(new Comment(), function (Form $form) {
            $form->display('id');
            $form->editor('content');
            $form->text('topic_id');
            $form->text('user_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
