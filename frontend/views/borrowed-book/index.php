<?php

use yii\bootstrap\modal;
use frontend\models\Books;
use frontend\models\Students;
use frontend\models\BorrowedBooks;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailsView;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BorrowedBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$totalBooks = Books::find()->asArray()->all();
$totalStudents = Students::find()->asArray()->all();
$totalBorrowedBooks = BorrowedBooks::find()->asArray()->all();
$overdue = BorrowedBooks::find()->where('expected_date >'.date('yy/m/d'))->andWhere(['return_date'=>NULL])->asArray()->all();



$this->title = 'Sample Library';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Books</span>
              <span class="info-box-number"><?= count($totalBooks)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-shopping-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Borrwed Books</span>
              <span class="info-box-number"><?= count($totalBorrowedBooks)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-credit-card-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Overdue Books</span>
              <span class="info-box-number"><?= count($overdue)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Students</span>
              <span class="info-box-number"><?= count($totalStudents) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>


      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Book Assignment</h3>
              <div class="box-tools">
                <?php if(Yii::$app->user->can('librarian')){ ?>
                <button type="button" class="btn btn-primary assignbook" aria-controls="example1"><span class="fa fa-plus"> Assign a Book</span></button>
              <?php }?>
              <?php if(Yii::$app->user->can('student')){ ?>
                <button type="button" class="btn btn-primary" aria-controls="example1"><span class="fa fa-plus"> Request a Book</span></button>
              <?php }?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length">
                      <label>Show
                        <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> entries
                    </label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div id="example1_filter" class="dataTables_filter pull-right">
                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </div>
              </div>
              </div>
              <!-- Table start -->
              <div class="row table-responsive no-padding">
                <div class="col-sm-12">
                  <?= GridView::widget([
                      'dataProvider' => $dataProvider,
                      'filterModel' => $searchModel,
                      'columns' => [
                          ['class' => 'yii\grid\SerialColumn'],

                          // 'bbook_id',
                          // student_id,
                          [
                          'attribute' => 'student_id',
                          'value' => function ($dataProvider) {
                              $studentName = Students::find()->where(['student_id'=>$dataProvider->student_id])->One();
                              return $studentName->full_name;
                          },
                      ],
                          // 'book_id',
                          [
                          'attribute' => 'book_id',
                          'value' => function ($dataProvider) {
                              $bookName = Books::find()->where(['book_id'=>$dataProvider->book_id])->One();
                              return $bookName->book_name;
                          },
                      ],
                      // 'borrow_date',
                      [
                      'attribute' => 'borrow_date',
                      'value' => function ($dataProvider) {
                        $date = new DateTime($dataProvider->borrow_date);
                        return $date->format('F j, Y,');
                      },
                  ],
                  // 'expected_date',
                  [
                  'attribute' => 'expected_date',
                  'value' => function ($dataProvider) {
                    $date = new DateTime($dataProvider->expected_date);
                    return $date->format('F j, Y,');
                  },
              ],
              'return_date',
              [
                'label'=>'Return Book',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                return '<span val='.$dataProvider->bbook_id.' class="btn btn-danger returnbook">Return</span>';
                  },
              ],
              [
                'label'=>'Book Status',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                  $bookstatus = Books::find()->where(['book_id'=>$dataProvider->book_id])->one();
                  if($bookstatus->status == 0){
                    $status = 'Available';
                  }elseif ($bookstatus->status == 1) {
                    $status = 'Issued';
                  }elseif ($bookstatus->status == 2) {
                    $status = 'Pending';
                  }
                return '<span class="btn btn-info">'.$status.'</span>';
                  },
              ],
                          ['class' => 'yii\grid\ActionColumn'],
                      ],
                  ]); ?>
            </div>

            </div>
            <div class="row">
                <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
            </div>
            <div class="col-sm-7">
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                <ul class="pagination">
                <li class="paginate_button previous disabled" id="example1_previous">
                  <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                </li><li class="paginate_button active">
                  <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                </li><li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                </li>
                <li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                </li><li class="paginate_button ">
                  <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                  </li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li>
                </ul></div></div></div></div>
            </div>
            <!-- /.box-body -->
          </div>
<?php
Modal::begin([
  'header'=>'<h4>Assign A Book</h4>',
  'id'=>'assignbook',
  'size'=>'modal-lg'
  ]);
echo "<div id='assignbookContent'></div>";
Modal::end();
?>

<?php
Modal::begin([
  'header'=>'<h4>Return Book confirmation</h4>',
  'id'=>'returnbook',
  'size'=>'modal-md'
  ]);
echo "<div id='returnbookContent'></div>";
Modal::end();
?>
