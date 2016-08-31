<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 8/1/2016
   * Time: 4:25 PM
   */
  if (isset($data)) {
    $pages = $pagination;
    $this->widget('CLinkPager', array(
      'pages'                => $pages,
      'maxButtonCount'       => 30,
      //'pageSize'             => 10,
//      'itemCount'            => (int)$data->totalItemCount,
      'htmlOptions'          => array('class' => 'pagination pagination-custom'),
      'hiddenPageCssClass'   => '',
      //'firstPageCssClass' => 'active',
      //'lastPageCssClass' => 'active',
      'selectedPageCssClass' => 'active',
      //'currentPage'       => '1',
      'header'               => '',
      'nextPageLabel'        => 'Berikutnya',
      'prevPageLabel'        => 'Sebelumnya',
      'lastPageLabel'        => 'Akhir',
      'firstPageLabel'       => 'Awal',
    ));
  }
