<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Forum;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ForumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Forum(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('forum_name');
            $grid->column('description');
            $grid->column('created_at');
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
        return Show::make($id, new Forum(), function (Show $show) {
            $show->field('id');
            $show->field('forum_name');
            $show->field('description');
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
        return Form::make(new Forum(), function (Form $form) {
            $form->display('id');
            $form->text('forum_name');
            $form->text('description');

        });
    }
}
