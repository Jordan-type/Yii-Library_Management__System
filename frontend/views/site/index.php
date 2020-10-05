<?php
use yii\bootstrap\modal;
use frontend\models\Books;
use frontend\models\Students;
use frontend\models\BorrowedBooks;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailsView;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
$totalBooks = Books::find()->asArray()->all();
$totalBorrowedBooks = BorrowedBooks::find()->asArray()->all();
$totalOverdueBooks = BorrowedBooks::find()->asArray()->all();
$totalStudents = Students::find()->asArray()->all();

$borrow_list = BorrowedBooks::find()->all();

// $query = new BorrowedBooks::find()->all();
// $query	->select(['students.full_name AS Student_Name', 'books.book_name as Book_Name'])
//         ->from('students')
//         ->leftJoin('books', 'books.createdby = students.student_id')
//         ->limit(2);
//
// $command = $query->createCommand();
// $data = $command->queryAll();




$students = ArrayHelper::map(Students::find()->all(), 'student_id', 'full_name');


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
              <span class="info-box-number"><?= count($totalBorrowedBooks) ?></span>
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
              <span class="info-box-number"><?= count($totalOverdueBooks) ?></span>
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
                <button type="button" class="btn btn-primary assignbook" aria-controls="example1"><span class="fa fa-plus"> Assign a Book</span></button>
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
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </div>
              </div>
              </div>
              <!-- Table start -->
              <div class="row">

                <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 231px;">Student</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 282px;">Book Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 251px;">Date Taken</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 251px;">Return Date</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 145px;">Returned Book</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 198px;">Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($borrow_list as $borrowed_books){?>

                <tr role="row" class="odd">
                  <td class="sorting_1"><?= $borrowed_books['student_id']?></td>
                  <td><?= $borrowed_books['book_id']?></td>
                  <td><?= $borrowed_books['borrow_date']?></td>
                  <td><?= $borrowed_books['return_date']?></td>
                  <td><span class="btn btn-warning">Overdue Waring</span></td>
                  <td><span class="btn btn-success">Approved</span></td>
                  <?php } ?>
                </tr>
              </table>
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
