<?php
  /**
   * Created by PhpStorm.
   * User: hanse
   * Date: 8/1/2016
   * Time: 4:25 PM
   */
  if(isset($data)){
    $pages = $data->getPagination();
    $this->widget('CLinkPager', array(
      'pages' => $data->pagination
    ));
  }
